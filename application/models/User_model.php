<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_model extends CI_model
{
    public function getBuku()
    {
        $query = "SELECT *
                  FROM mst_buku JOIN mst_kategori
                  ON mst_buku.kategori_id = mst_kategori.id_kategori";
        return $this->db->query($query)->result_array();
    }

    public function getEditBuku($id_buku)
    {
        $query = $this->db->get_where('mst_buku', ['id_buku' => $id_buku])->row_array();
        return $query;
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
        $sess_id = $this->session->userdata('id');
        $query = "SELECT *
                  FROM tb_pinjam LEFT JOIN mst_buku
                  ON tb_pinjam.pinjaman = mst_buku.kode_buku
                  LEFT JOIN mst_jurnal
                  ON mst_jurnal.kode_jurnal = tb_pinjam.pinjaman
                  LEFT JOIN mst_user
                  ON mst_user.id = tb_pinjam.sess_id
                  WHERE tb_pinjam.sess_id = '$sess_id'";
        return $this->db->query($query)->result_array();
    }
}
