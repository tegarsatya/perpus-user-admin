<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        is_logged_in();
        is_user();
        $this->load->helper('tglindo');
        $this->load->model('User_model', 'user');
    }


    public function profile()
    {
        $this->form_validation->set_rules('nama', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'My Profile';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['peminjam'] = $this->user->getPeminjam();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_user', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('user/profile', $data);
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
                    redirect('user/profile');
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
            redirect('user/profile');
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
            $data['peminjam'] = $this->user->getPeminjam();
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_user', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('user/profile', $data);
            $this->load->view('templates/footer');
        } else {
            $current_password = $this->input->post('current_password');
            $new_password = $this->input->post('new_password1');
            if ($current_password == $new_password) {
                $this->session->set_flashdata('msg', '<div class="alert alert-danger" role="alert">GAGAL..... Password baru tidak boleh sama dengan password lama</div>');
                redirect('user/profile');
            } else {
                $password_hash = password_hash($new_password, PASSWORD_DEFAULT);
                $this->db->set('password', $password_hash);
                $this->db->where('username', $this->session->userdata('username'));
                $this->db->update('mst_user');
                $this->session->set_flashdata('message', 'Ubah password');
                redirect('user/profile');
            }
        }
    }

    public function index()
    {
        $this->form_validation->set_rules('kode_buku', 'Kode Buku', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Pinjaman Buku';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['mst_buku'] = $this->user->getBuku();

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_user', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('user/index', $data);
            $this->load->view('templates/footer');
        } else {
            $sess_id = $this->session->userdata('id');
            $data = array(
                'pinjaman' => $this->input->post('kode_buku', true),
                'tgl_pinjam' => $this->input->post('tgl_pinjam', true),
                'tgl_kembali' => $this->input->post('tgl_kembali', true),
                'penerima' => $this->input->post('penerima', true),
                'ket_pinjam' => $this->input->post('ket_pinjam', true),
                'sess_id' => $sess_id,
                'status' => 1
            );
            $this->db->insert('tb_pinjam', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('user/list_pinjam');
        }
    }

    public function get_buku()
    {
        echo json_encode($this->user->getEditBuku($_POST['id_buku']));
    }

    public function list_jurnal()
    {
        $this->form_validation->set_rules('kode_jurnal', 'Kode jurnal', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $data['title'] = 'Pinjaman Jurnal';
            $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
            $data['mst_kategori_jurnal'] = $this->db->get('mst_kategori_jurnal')->result_array();
            $data['mst_jurnal'] = $this->user->getJurnal();


            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar_user', $data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('user/list_jurnal', $data);
            $this->load->view('templates/footer');
        } else {
            $sess_id = $this->session->userdata('id');
            $data = array(
                'pinjaman' => $this->input->post('kode_jurnal', true),
                'tgl_pinjam' => $this->input->post('tgl_pinjam', true),
                'tgl_kembali' => $this->input->post('tgl_kembali', true),
                'penerima' => $this->input->post('penerima', true),
                'ket_pinjam' => $this->input->post('ket_pinjam', true),
                'sess_id' => $sess_id,
                'status' => 1
            );
            $this->db->insert('tb_pinjam', $data);
            $this->session->set_flashdata('message', 'Simpan data');
            redirect('user/list_pinjam');
        }
    }

    public function get_jurnal()
    {
        echo json_encode($this->user->getEditJurnal($_POST['id_jurnal']));
    }

    public function list_pinjam()
    {
        $data['title'] = 'Daftar Pinjaman';
        $data['user'] = $this->db->get_where('mst_user', ['username' => $this->session->userdata('username')])->row_array();
        $data['peminjam'] = $this->user->getPeminjam();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar_user', $data);
        $this->load->view('templates/navbar', $data);
        $this->load->view('user/list_pinjam', $data);
        $this->load->view('templates/footer');
    }

    public function del_pinjam($id_pinjam)
    {
        $this->db->where('id_pinjam', $id_pinjam);
        $this->db->delete('tb_pinjam');
        $this->session->set_flashdata('message', 'Hapus pinjaman');
        redirect('user/list_pinjam');
    }
}
