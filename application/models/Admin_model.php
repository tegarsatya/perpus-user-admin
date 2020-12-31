<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_model
{

    public function countJmlUser()
    {

        $query = $this->db->query(
            "SELECT COUNT(id) as jml_user
                               FROM mst_user"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->jml_user;
        } else {
            return 0;
        }
    }

    public function countUserAktif()
    {

        $query = $this->db->query(
            "SELECT COUNT(id) as user_aktif
                               FROM mst_user
                               WHERE is_active = 1"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->user_aktif;
        } else {
            return 0;
        }
    }

    public function countUserTakAktif()
    {

        $query = $this->db->query(
            "SELECT COUNT(id) as user_tak_aktif
                               FROM mst_user
                               WHERE is_active = 0"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->user_tak_aktif;
        } else {
            return 0;
        }
    }

    public function countUserPerbulan()
    {
        $query = $this->db->query(
            "SELECT CONCAT(YEAR(date_created),'/',MONTH(date_created)) AS tahun_bulan, COUNT(*) AS jumlah_bulanan
                FROM mst_user
                WHERE CONCAT(YEAR(date_created),'/',MONTH(date_created))=CONCAT(YEAR(NOW()),'/',MONTH(NOW()))
                GROUP BY YEAR(date_created),MONTH(date_created);"
        );
        if ($query->num_rows() > 0) {
            return $query->row()->jumlah_bulanan;
        } else {
            return 0;
        }
    }

    public function getAllUserDtables()
    {
        $query =  $this->db->order_by('id', 'DESC')->get('mst_user');
        return $query->result_array();
    }


    public function getAllUser()
    {
        $this->db->select('*');
        $this->db->from('mst_user');
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getUserAktif()
    {
        $this->db->select('*');
        $this->db->from('mst_user');
        $this->db->order_by('id', 'DESC');
        $this->db->where('is_active', 1);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getUserNonAktif()
    {
        $this->db->select('*');
        $this->db->from('mst_user');
        $this->db->order_by('id', 'DESC');
        $this->db->where('is_active', 0);
        $query = $this->db->get()->result_array();
        return $query;
    }

    public function getUserEdit($id)
    {
        $query = $this->db->get_where('mst_user', ['id' => $id])->row_array();
        return $query;
    }

    public function getEditKategori($id_kategori)
    {
        $query = $this->db->get_where('mst_kategori', ['id_kategori' => $id_kategori])->row_array();
        return $query;
    }

    public function getBuku()
    {
        $query = "SELECT *
                  FROM mst_buku JOIN mst_kategori
                  ON mst_buku.kategori_id = mst_kategori.id_kategori";
        return $this->db->query($query)->result_array();
    }

    function getKodeBuku()
    {
        $this->db->select('RIGHT(kode_buku,4) as kode', FALSE);
        $this->db->order_by('id_buku', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('mst_buku');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = 'BOOK-' . date('Y') . '-' . $kodemax;
        return $kodejadi;
    }

    public function getEditBuku($id_buku)
    {
        $query = $this->db->get_where('mst_buku', ['id_buku' => $id_buku])->row_array();
        return $query;
    }

    public function getEditKategoriJurnal($id_kategori_jurnal)
    {
        $query = $this->db->get_where('mst_kategori_jurnal', ['id_kategori_jurnal' => $id_kategori_jurnal])->row_array();
        return $query;
    }

    function getKodeJurnal()
    {
        $this->db->select('RIGHT(kode_jurnal,4) as kode', FALSE);
        $this->db->order_by('id_jurnal', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get('mst_jurnal');
        if ($query->num_rows() <> 0) {
            $data = $query->row();
            $kode = intval($data->kode) + 1;
        } else {
            $kode = 1;
        }
        $kodemax = str_pad($kode, 4, "0", STR_PAD_LEFT);
        $kodejadi = 'JURNAL-' . date('Y') . '-' . $kodemax;
        return $kodejadi;
    }

    public function getJurnal()
    {
        $query = "SELECT *
                  FROM mst_jurnal JOIN mst_kategori_jurnal
                  ON mst_jurnal.kategori_jurnal = mst_kategori_jurnal.id_kategori_jurnal";
        return $this->db->query($query)->result_array();
    }

    public function getEditJurnal($id_jurnal)
    {
        $query = $this->db->get_where('mst_jurnal', ['id_jurnal' => $id_jurnal])->row_array();
        return $query;
    }

    public function getPeminjam()
    {
        $query = "SELECT *
                  FROM tb_pinjam LEFT JOIN mst_buku
                  ON tb_pinjam.pinjaman = mst_buku.kode_buku
                  LEFT JOIN mst_jurnal
                  ON mst_jurnal.kode_jurnal = tb_pinjam.pinjaman
                  LEFT JOIN mst_user
                  ON mst_user.id = tb_pinjam.sess_id";
        return $this->db->query($query)->result_array();
    }

    public function getEditPinjam($id_pinjam)
    {
        $query = $this->db->get_where('tb_pinjam', ['id_pinjam' => $id_pinjam])->row_array();
        return $query;
    }
}
