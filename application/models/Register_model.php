<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Register_model extends CI_Model {

        public function tampil()
        {
            $query = $this->db->get('alternatif');
            return $query->result();
        }
        public function lokasi()
        {
            $query = $this->db->get('lokasi');
            return $query->result();
        }

        public function getTotal()
        {
            return $this->db->count_all('alternatif');
        }

        public function insert($data = [])
        {
            $this->db->insert('user', $data);
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
                'nama'  => $data['nama']
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
    
    