<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Petugas_model extends CI_Model {

        public function tampil()
        {
            $query = $this->db->query('SELECT a.*, b.*, c.nama_lokasi FROM petugas as a JOIN user as b ON a.id_user = b.id_user JOIN lokasi as c ON a.id_lokasi = c.id_lokasi');
            return $query->result();
        }

        public function getTotal()
        {
            return $this->db->count_all('user');
        }
 
        public function insert($data = [])
        {
            $this->db->insert('user', $data);
            $result = $this->db->insert_id();
            return $result;
        }
        public function insert_petugas($data = [])
        {
            $petugas = $this->db->insert('petugas', $data);
            return $petugas;
        }

        public function show($id_user)
        {
            $query = $this->db->query("SELECT a.*, b.*, c.nama_lokasi FROM petugas as a JOIN user as b ON a.id_user = b.id_user JOIN lokasi as c ON a.id_lokasi = c.id_lokasi WHERE a.id_user = '$id_user'");
            // var_dump($query->row());die;
            return $query->row();
        }

        public function update($id_user, $data = [])
        {
            $ubah = array(
                'id_user_level' => 3,
                'email' => $data['email'],
				'nama'  => $data['nama'],
                'username'  => $data['username'],
                'password'  => $data['password']
            );

            $this->db->where('id_user', $id_user);
            $this->db->update('user', $ubah);
        }
        public function update_petugas($id_user, $data = [])
        {

            $this->db->where('id_user', $id_user);
            $this->db->update('petugas', $data);
        }

        public function delete($id_user)
        {
            $this->db->where('id_user', $id_user);
            $this->db->delete('user');
            $this->db->where('id_user', $id_user);
            $this->db->delete('petugas');
            
        }

        public function get_user()
        {
            $query = $this->db->get('user');
            return $query->result();
        }
        public function user_level()
        {
            $query = $this->db->get('user_level');
            return $query->result();
        }             
        public function wilayah()
        {
            $query = $this->db->get('lokasi');
            return $query->result();
        }             
    }
    
    /* End of file Kategori_model.php */
    