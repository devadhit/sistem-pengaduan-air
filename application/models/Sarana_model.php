<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Sarana_model extends CI_Model {

        public function tampil()
        {
            $query = $this->db->get('sarana');
            return $query->result();
        } 

        public function getTotal()
        {
            return $this->db->count_all('sarana');
        }

        public function insert($data = [])
        {
            $result = $this->db->insert('sarana', $data);
            return $result;
        }

        public function show($id_sarana)
        {
            $this->db->where('id_sarana', $id_sarana);
            $query = $this->db->get('sarana');
            return $query->row();
        }

        public function update($id_sarana, $data = [])
        {

            $this->db->where('id_sarana', $id_sarana);
            $this->db->update('sarana', $data);
        }

        public function delete($id_sarana)
        {
            $this->db->where('id_sarana', $id_sarana);
            $this->db->delete('sarana');
        }
    }
    