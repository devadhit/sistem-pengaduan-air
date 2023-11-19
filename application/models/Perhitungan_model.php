<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Perhitungan_model extends CI_Model
{

    public function get_kriteria()
    {
        $query = $this->db->get('kriteria');
        return $query->result();
    }
    public function get_alternatif()
    {
        $query = $this->db->query('SELECT * FROM alternatif WHERE is_updated = 0');
        return $query->result();
    }

    public function data_nilai($id_alternatif, $id_kriteria)
    {
        // AND penilaian.is_updated != 0 AND sub_kriteria.deskripsi != '-' 
        $query = $this->db->query("SELECT * FROM penilaian JOIN sub_kriteria 
        WHERE penilaian.nilai=sub_kriteria.id_sub_kriteria AND penilaian.id_alternatif='$id_alternatif' 
        AND penilaian.id_kriteria='$id_kriteria' AND penilaian.is_updated != 0;");
        return $query->row_array();
    }

    public function get_hasil_topsis()
    {
        $query = $this->db->query("SELECT * FROM hasil_topsis 
        JOIN alternatif
         ON hasil_topsis.id_alternatif=alternatif.id_alternatif 
         JOIN pengaduan 
         ON hasil_topsis.id_alternatif = pengaduan.no_pelanggan
         ORDER BY nilai DESC;");
        return $query->result();
    }

    public function insert_hasil_topsis($hasil_akhir = [])
    {
        $result = $this->db->insert('hasil_topsis', $hasil_akhir);
        return $result;
    }

    public function hapus_hasil_topsis()
    {
        $query = $this->db->query("TRUNCATE TABLE hasil_topsis;");
        return $query;
    }
}