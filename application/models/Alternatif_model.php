<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif_model extends CI_Model
{

    public function tampil()
    {
        $query = $this->db->get_where('alternatif', array('is_submited' => 1));
        return $query->result();
    }

    public function getTotal()  
    {
        return $this->db->count_all('alternatif');
    }

    public function insert($data = [])
    {
        $this->db->insert('alternatif', $data);
        $result = $this->db->insert_id();
        return $result;
    }

    public function show($id_alternatif)
    {
        $this->db->where('id_alternatif', $id_alternatif);
        $query = $this->db->get('alternatif');
        return $query->row();
    }

    public function update($id_alternatif, $data = [])
    {
        $ubah = array(
            'nama' => $data['nama'],
            'telp' => $data['telp'],
            'id_lokasi' => $data['id_lokasi'],
            'alamat' => $data['alamat'],
            'tgl_laporan' => $data['tgl_laporan'],
        );

        $this->db->where('id_alternatif', $id_alternatif);
        $this->db->update('alternatif', $ubah);
    }


    public function delete($id_alternatif)
    {
        $this->db->where('id_alternatif', $id_alternatif);
        $this->db->delete('alternatif');
    }
}