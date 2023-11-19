<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian_model extends CI_Model
{

    public function tambah_penilaian($id_pelanggan, $id_kriteria, $nilai, $is_updated)
    {
        $is_updated = '0';
        $query = $this->db->query("INSERT INTO penilaian VALUES (NULL,'$id_pelanggan','$id_kriteria','$nilai', '$is_updated');");
        return $query;
    }

    public function edit_penilaian($id_alternatif, $id_kriteria, $nilai)
    {
        
        if ($this->session->id_user_level == '3') {
            $query = $this->db->simple_query("UPDATE penilaian SET nilai=$nilai, is_updated = '1' WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
            // update status alternatif untuk perhitungan
            $this->db->simple_query("UPDATE alternatif SET is_updated='0' WHERE id_alternatif='$id_alternatif';");

        } else {
            $query = $this->db->simple_query("UPDATE penilaian SET nilai=$nilai WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
        }
        return $query;
    }

    public function get_kriteria()
    {
        $query = $this->db->get('kriteria');
        return $query->result();
    }
 
    public function get_alternatif()
    {
        $query = $this->db->query("SELECT * FROM alternatif WHERE is_submited = 1 ");
        return $query->result();
    }

    public function data_penilaian($id_alternatif, $id_kriteria)
    {
        $query = $this->db->query("SELECT * FROM penilaian WHERE id_alternatif='$id_alternatif' AND id_kriteria='$id_kriteria';");
        return $query->row_array();
    }

    public function untuk_tombol($id_alternatif)
    {
        $query = $this->db->query("SELECT * FROM penilaian WHERE id_alternatif = '$id_alternatif' AND is_updated = '0'");
        return $query->num_rows();
    }

    public function data_sub_kriteria($id_kriteria)
    {
        $query = $this->db->query("SELECT * FROM sub_kriteria WHERE id_kriteria='$id_kriteria' ORDER BY nilai DESC;");
        return $query->result_array();
    }

    public function batal_pengaduan($id_alternatif){
        $query1 = $this->db->query("DELETE FROM penilaian WHERE id_alternatif = '$id_alternatif'");
        $query2 = $this->db->query("DELETE FROM alternatif WHERE id_alternatif = '$id_alternatif'");

        return $query2;
    }

}