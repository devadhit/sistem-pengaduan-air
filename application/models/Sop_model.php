<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sop_model extends CI_Model
{

    public function tampil()
    {
        $query = $this->db->query('SELECT a.*, b.deskripsi FROM sop as a JOIN sub_kriteria as b ON a.id_sub_kriteria = b.id_sub_kriteria');
        return $query->result();
    }

    public function getTotal()
    {
        return $this->db->count_all('sop');
    }

    public function insert($data)
    {
        // ambil id dari nama masalah yang dikirim dari penambahan sub kriteria
        $query = $this->db->get_where('sub_kriteria', array('deskripsi' => $data));
        // var_dump($query->row('id_sub_kriteria'));die;
        $data = [
            'id_sub_kriteria' => $query->row('id_sub_kriteria')
        ];
        $result = $this->db->insert('sop', $data);
        return $result;
    } 

    public function show($id_sop)
    {
        $this->db->where('id_sop', $id_sop);
        $query = $this->db->get('sop');
        return $query->row();
    }

    public function update($id_sop, $data = [])
    {
        $ubah = array(
            'file_sop' => $data['file_sop'],
            'file_ik' => $data['file_ik'],
        );

        $this->db->where('id_sop', $id_sop);
        $this->db->update('sop', $ubah);
    }

    public function delete($id_sub_kriteria)
    {
        $this->db->where('id_sub_kriteria', $id_sub_kriteria);
        $this->db->delete('sop');
    }
}