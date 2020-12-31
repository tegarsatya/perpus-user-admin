<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        is_admin();
        $this->load->helper('tglindo');
        $this->load->model('Admin_model', 'admin');
    }

    public function index()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[mst_user.username]', array(
            'is_unique' => 'Username sudah ada'
        ));
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', array(
            'matches' => 'Password tidak sama',
            'min_length' => 'password min 3 karakter'
        ));
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');
        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Dashboard';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();

            $data['user_perbulan'] = $this->admin->countUserPerbulan();
            $data['count_user'] = $this->admin->countJmlUser();
            $data['user_aktif'] = $this->admin->countUserAktif();
            $data['user_tak_aktif'] = $this->admin->countUserTakAktif();
            $data['list_user'] = $this->db->get('mst_user')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/index', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'nama' => $this->input->post('nama', true),
                'email' => $this->input->post('email', true),
                'username' => $this->input->post('username', true),
                'level' => $this->input->post('level', true),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'date_created' => date('Y/m/d'),
                'image' => 'default.jpg',
                'is_active' => 1
            );
            $this->db->insert('mst_user', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/index');
        }
    }


    public function profile()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'My Profile';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['peminjam'] = $this->admin->getPeminjam();
            $data['list_user'] = $this->db->get('mst_user')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/profile', $data);
            $this->load->view('templates/footer');
        } else {
            $upload_image = $_FILES['image']['name'];
            if ($upload_image) {
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size']     = '2048';
                $config['upload_path'] = './assets/img/profile';
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('image')) {
                    $old_image = $data['id']['image'];
                    if ($old_image != 'default.jpg') {
                        unlink(FCPATH . 'assets/img/profile/' . $old_image);
                    }
                    $new_image = $this->upload->data('file_name');
                    $this->db->set('image', $new_image);
                } else {
                    $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">Update Gagal</div>');
                    redirect('admin/profile');
                }
            }
            $id = $this->input->post('id');
            $nama = $this->input->post('nama');
            $email = $this->input->post('email');

            $this->db->set('nama', $nama);
            $this->db->set('email', $email);
            $this->db->where('id', $id);
            $this->db->update('mst_user');

            $this->session->set_flashdata('message', 'Update data');
            redirect('admin/profile');
        }
    }


    public function changePassword()
    {

        $this->form_validation->set_rules('current_password', 'Current Password', 'required|trim');
        $this->form_validation->set_rules('new_password1', 'New Password1', 'required|trim|min_length[3]|matches[new_password2]');
        $this->form_validation->set_rules('new_password2', 'Confirm New Password', 'required|trim|min_length[3]|matches[new_password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Ubah Password';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['peminjam'] = $this->admin->getPeminjam();
            $data['list_user'] = $this->db->get('mst_user')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/profile', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if ($current_password == $new_password) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">GAGAL..... Password baru tidak boleh sama dengan password lama</div>');
                redirect('admin/profile');
            } else {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $this->db->set('password', $password_hash);
                $this->db->where('username', $this->session->userdata('username'));
                $this->db->update('mst_user');
                $this->session->set_flashdata('message', 'Ubah password');
                redirect('admin/profile');
            }
        }
    }

    public function get_edit()
    {
        echo json_encode($this->admin->getUserEdit($_POST['id']));
    }

    public function edit_user()
    {
        $id = $this->input->post('id', true);
        $is_active = $this->input->post('is_active', true);
        $level = $this->input->post('level', true);

        $this->db->set('is_active', $is_active);
        $this->db->set('level', $level);
        $this->db->where('id', $id);
        $this->db->update('mst_user');
        $this->session->set_flashdata('message', 'Update user');
        redirect('admin/index');
    }

    public function del_user($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mst_user');
        $this->session->set_flashdata('message', 'Hapus user');
        redirect('admin/index');
    }

    public function mst_kategori()
    {
        $this->form_validation->set_rules('kategori', 'Nama Kategori', 'required|trim|is_unique[mst_kategori.kategori]', array(
            'is_unique' => 'Simpan Gagal ! .. Nama Kategori sudah ada'
        ));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Master Kategori';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['mst_kategori'] = $this->db->get('mst_kategori')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/perpus/mst_kategori', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'kategori' => $this->input->post('kategori', true),
            );
            $this->db->insert('mst_kategori', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/mst_kategori');
        }
    }

    public function get_kategori()
    {
        echo json_encode($this->admin->getEditKategori($_POST['id_kategori']));
    }

    public function edit_kategori()
    {
        $id_kategori = $this->input->post('id_kategori', true);
        $kategori = $this->input->post('kategori', true);
        $this->db->set('kategori', $kategori);
        $this->db->where('id_kategori', $id_kategori);
        $this->db->update('mst_kategori');
        $this->session->set_flashdata('message', 'Ubah kategori');
        redirect('admin/mst_kategori');
    }

    public function del_kategori($id_kategori)
    {
        $this->db->where('id_kategori', $id_kategori);
        $this->db->delete('mst_kategori');
        $this->session->set_flashdata('message', 'Hapus kategori');
        redirect('admin/mst_kategori');
    }

    public function mst_buku()
    {
        $this->form_validation->set_rules('kode_buku', 'Kode Buku', 'required|trim|is_unique[mst_buku.kode_buku]', array(
            'is_unique' => 'Simpan Gagal ! .. Kode Buku sudah ada'
        ));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Master Buku';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['mst_kategori'] = $this->db->get('mst_kategori')->result_array();
            $data['mst_buku'] = $this->admin->getBuku();
            $data['kode_buku'] = $this->admin->getKodeBuku();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/perpus/mst_buku', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'kode_buku' => $this->input->post('kode_buku', true),
                'kategori_id' => $this->input->post('kategori_id', true),
                'judul_buku' => $this->input->post('judul_buku', true),
                'penulis' => $this->input->post('penulis', true),
                'jml_hal' => $this->input->post('jml_hal', true),
                'tgl_terbit' => $this->input->post('tgl_terbit', true),
                'ket_buku' => $this->input->post('ket_buku', true),
            );
            $this->db->insert('mst_buku', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/mst_buku');
        }
    }

    public function get_buku()
    {
        echo json_encode($this->admin->getEditBuku($_POST['id_buku']));
    }

    public function edit_buku()
    {
        $id_buku = $this->input->post('id_buku', true);
        $kategori_id = $this->input->post('kategori_id', true);
        $judul_buku = $this->input->post('judul_buku', true);
        $penulis = $this->input->post('penulis', true);
        $jml_hal = $this->input->post('jml_hal', true);
        $tgl_terbit = $this->input->post('tgl_terbit', true);
        $ket_buku = $this->input->post('ket_buku', true);
        $this->db->set('kategori_id', $kategori_id);
        $this->db->set('judul_buku', $judul_buku);
        $this->db->set('penulis', $penulis);
        $this->db->set('jml_hal', $jml_hal);
        $this->db->set('tgl_terbit', $tgl_terbit);
        $this->db->set('ket_buku', $ket_buku);
        $this->db->where('id_buku', $id_buku);
        $this->db->update('mst_buku');
        $this->session->set_flashdata('message', 'Ubah buku');
        redirect('admin/mst_buku');
    }

    public function del_buku($id_buku)
    {
        $this->db->where('id_buku', $id_buku);
        $this->db->delete('mst_buku');
        $this->session->set_flashdata('message', 'Hapus buku');
        redirect('admin/mst_buku');
    }

    public function mst_kategori_jurnal()
    {
        $this->form_validation->set_rules('kategori_jurnal', 'Nama Kategori', 'required|trim|is_unique[mst_kategori_jurnal.kategori_jurnal]', array(
            'is_unique' => 'Simpan Gagal ! .. Nama Kategori Jurnal sudah ada'
        ));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Master Kategori Jurnal';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['mst_kategori_jurnal'] = $this->db->get('mst_kategori_jurnal')->result_array();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/perpus/mst_kategori_jurnal', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'kategori_jurnal' => $this->input->post('kategori_jurnal', true),
            );
            $this->db->insert('mst_kategori_jurnal', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/mst_kategori_jurnal');
        }
    }

    public function get_kategori_jurnal()
    {
        echo json_encode($this->admin->getEditKategoriJurnal($_POST['id_kategori_jurnal']));
    }

    public function edit_kategori_jurnal()
    {
        $id_kategori_jurnal = $this->input->post('id_kategori_jurnal', true);
        $kategori_jurnal = $this->input->post('kategori_jurnal', true);
        $this->db->set('kategori_jurnal', $kategori_jurnal);
        $this->db->where('id_kategori_jurnal', $id_kategori_jurnal);
        $this->db->update('mst_kategori_jurnal');
        $this->session->set_flashdata('message', 'Ubah kategori jurnal');
        redirect('admin/mst_kategori_jurnal');
    }

    public function del_kategori_jurnal($id_kategori_jurnal)
    {
        $this->db->where('id_kategori_jurnal', $id_kategori_jurnal);
        $this->db->delete('mst_kategori_jurnal');
        $this->session->set_flashdata('message', 'Hapus kategori_jurnal');
        redirect('admin/mst_kategori_jurnal');
    }

    public function mst_jurnal()
    {
        $this->form_validation->set_rules('kode_jurnal', 'Kode Jurnal', 'required|trim|is_unique[mst_jurnal.kode_jurnal]', array(
            'is_unique' => 'Simpan Gagal ! .. Kode Jurnal sudah ada'
        ));

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Master Jurnal';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['mst_kategori_jurnal'] = $this->db->get('mst_kategori_jurnal')->result_array();
            $data['mst_jurnal'] = $this->admin->getJurnal();
            $data['kode_jurnal'] = $this->admin->getKodeJurnal();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/perpus/mst_jurnal', $data);
            $this->load->view('templates/footer');
        } else {
            $data = array(
                'kode_jurnal' => $this->input->post('kode_jurnal', true),
                'kategori_jurnal' => $this->input->post('kategori_jurnal', true),
                'judul_jurnal' => $this->input->post('judul_jurnal', true),
                'penulis' => $this->input->post('penulis', true),
                'tgl_terbit' => $this->input->post('tgl_terbit', true),
                'ket_jurnal' => $this->input->post('ket_jurnal', true)
            );
            $this->db->insert('mst_jurnal', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('admin/mst_jurnal');
        }
    }

    public function get_jurnal()
    {
        echo json_encode($this->admin->getEditJurnal($_POST['id_jurnal']));
    }

    public function edit_jurnal()
    {
        $id_jurnal = $this->input->post('id_jurnal', true);
        $kategori_jurnal = $this->input->post('kategori_jurnal', true);
        $judul_jurnal = $this->input->post('judul_jurnal', true);
        $penulis = $this->input->post('penulis', true);
        $tgl_terbit = $this->input->post('tgl_terbit', true);
        $ket_jurnal = $this->input->post('ket_jurnal', true);
        $this->db->set('kategori_jurnal', $kategori_jurnal);
        $this->db->set('judul_jurnal', $judul_jurnal);
        $this->db->set('penulis', $penulis);
        $this->db->set('tgl_terbit', $tgl_terbit);
        $this->db->set('ket_jurnal', $ket_jurnal);
        $this->db->where('id_jurnal', $id_jurnal);
        $this->db->update('mst_jurnal');
        $this->session->set_flashdata('message', 'Ubah jurnal');
        redirect('admin/mst_jurnal');
    }

    public function del_jurnal($id_jurnal)
    {
        $this->db->where('id_jurnal', $id_jurnal);
        $this->db->delete('mst_jurnal');
        $this->session->set_flashdata('message', 'Hapus jurnal');
        redirect('admin/mst_jurnal');
    }

    public function list_pinjam()
    {
        $this->form_validation->set_rules('id_pinjam', 'ID Pinjaman', 'required|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Daftar Pinjaman';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['peminjam'] = $this->admin->getPeminjam();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_admin', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('admin/perpus/list_pinjam', $data);
            $this->load->view('templates/footer');
        } else {
            $id_pinjam = $this->input->post('id_pinjam', true);
            $tgl_kembali = $this->input->post('tgl_kembali', true);
            $ket_pinjam = $this->input->post('ket_pinjam', true);
            $status = $this->input->post('status', true);

            $this->db->set('tgl_kembali', $tgl_kembali);
            $this->db->set('ket_pinjam', $ket_pinjam);
            $this->db->set('status', $status);

            $this->db->where('id_pinjam', $id_pinjam);
            $this->db->update('tb_pinjam');
            $this->session->set_flashdata('message', 'Ubah Status');
            redirect('admin/list_pinjam');
        }
    }

    public function get_pinjam()
    {
        echo json_encode($this->admin->getEditPinjam($_POST['id_pinjam']));
    }
}
