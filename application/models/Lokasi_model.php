<?php

defined('BASEPATH') or exit('No direct script access allowed');

class lokasi_model extends CI_Model
{

    public function tampil()
    {
        $query = $this->db->get('lokasi');
        return $query->result();
    }

    public function getTotal()
    {
        return $this->db->count_all('lokasi');
    }

    public function insert($data = [])
    {
        $result = $this->db->insert('lokasi', $data);
        return $result;
    }

    public function show($id_lokasi)
    {
        $this->db->where('id_lokasi', $id_lokasi);
        $query = $this->db->get('lokasi');
        return $query->row();
    }

    public function update($id_lokasi, $data = [])
    {
        $ubah = array(
            'nama_lokasi' => $data['nama_lokasi'],
        );

        $this->db->where('id_lokasi', $id_lokasi);
        $this->db->update('lokasi', $ubah);
    }

    public function delete($id_lokasi)
    {
        $this->db->where('id_lokasi', $id_lokasi);
        $this->db->delete('lokasi');
    }
}