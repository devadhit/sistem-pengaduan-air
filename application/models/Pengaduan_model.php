<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Pengaduan_model extends CI_Model {

        public function tampil($status, $tanggal_dibuat)
        { 
            
            $this->db->select(['p.*',
            'l.nama_lokasi',
            'a.deskripsi as jenis_pengaduan', 
            'b.deskripsi as tingkat_keparahan', 
            'c.deskripsi as peluang_kejadian', 
            'd.deskripsi as durasi_kejadian', 
            'u.nama as nama_pelanggan' ,
            'pu.nama as nama_petugas_unit',
            's.file_sop as sop',
            's.file_ik as ik',
            'al.alamat',
            'al.telp',
            'al.nama as nama_lengkap']);
            $this->db->from('pengaduan as p');
            $this->db->join('lokasi as l', 'p.id_lokasi_pengaduan = l.id_lokasi', 'left');
            $this->db->join('sub_kriteria as a', 'p.jenis_pengaduan = a.id_sub_kriteria', 'left');
            $this->db->join('sub_kriteria as b', 'p.tingkat_keparahan = b.id_sub_kriteria', 'left');
            $this->db->join('sub_kriteria as c', 'p.peluang_kejadian = c.id_sub_kriteria', 'left');
            $this->db->join('sub_kriteria as d', 'p.durasi_kejadian = d.id_sub_kriteria', 'left');
            $this->db->join('user as u', 'p.id_user_pelanggan = u.id_user', 'left');
            $this->db->join('user as pu', 'p.id_user_petugas_unit = pu.id_user', 'left');
            $this->db->join('sop as s', 'p.jenis_pengaduan = s.id_sub_kriteria', 'left');
            $this->db->join('alternatif as al', 'p.no_pelanggan = al.id_alternatif', 'left');
            $this->db->where('status', strtoupper($status));
            $this->db->like('p.tanggal_dibuat', $tanggal_dibuat);
            // jika yang login petugas, munculin masalah yang ada di wilayahnya
            if ($this->session->userdata('id_user_level') == '3'){
            $this->db->where('id_lokasi_pengaduan', $this->session->userdata('id_lokasi'));
            }
            $this->db->group_by('no_pelanggan');
            $query = $this->db->get();
            return $query->result();
        }
        
        public function evaluasi()
        { 
            
            $this->db->select(['p.*',
            'l.nama_lokasi',
            'a.deskripsi as jenis_pengaduan', 
            'b.deskripsi as tingkat_keparahan', 
            'c.deskripsi as peluang_kejadian', 
            'd.deskripsi as durasi_kejadian', 
            'u.nama as nama_pelanggan' ,
            'pu.nama as nama_petugas_unit',
            's.file_sop as sop',
            's.file_ik as ik',
            'al.alamat',
            'al.telp',
            'al.nama as nama_lengkap']);
            $this->db->from('pengaduan as p');
            $this->db->join('lokasi as l', 'p.id_lokasi_pengaduan = l.id_lokasi', 'left');
            $this->db->join('sub_kriteria as a', 'p.jenis_pengaduan = a.id_sub_kriteria', 'left');
            $this->db->join('sub_kriteria as b', 'p.tingkat_keparahan = b.id_sub_kriteria', 'left');
            $this->db->join('sub_kriteria as c', 'p.peluang_kejadian = c.id_sub_kriteria', 'left');
            $this->db->join('sub_kriteria as d', 'p.durasi_kejadian = d.id_sub_kriteria', 'left');
            $this->db->join('user as u', 'p.id_user_pelanggan = u.id_user', 'left');
            $this->db->join('user as pu', 'p.id_user_petugas_unit = pu.id_user', 'left');
            $this->db->join('sop as s', 'p.jenis_pengaduan = s.id_sub_kriteria', 'left');
            $this->db->join('alternatif as al', 'p.no_pelanggan = al.id_alternatif', 'left');
            // jika yang login petugas, munculin masalah yang ada di wilayahnya
            if ($this->session->userdata('id_user_level') == '3'){
            $this->db->where('id_lokasi_pengaduan', $this->session->userdata('id_lokasi'));
            }
            $this->db->group_by('no_pelanggan');
            $query = $this->db->get();
            return $query->result();
        }

        public function getTotal()
        {
            return $this->db->count_all('pengaduan');
        }

        public function insert($data = [])
        {
            $result = $this->db->insert('pengaduan', $data);
            return $result;
        }

        public function show($id_user)
        { 
            
            $this->db->select(['p.*','l.nama_lokasi','a.deskripsi as jenis_pengaduan', 'b.deskripsi as tingkat_keparahan', 'c.deskripsi as peluang_kejadian', 'd.deskripsi as durasi_kejadian', 'u.nama as nama_pelanggan' ,'pu.nama as nama_petugas_unit']);
            $this->db->from('pengaduan as p');
            $this->db->join('lokasi as l', 'p.id_lokasi_pengaduan = l.id_lokasi', 'left');
            $this->db->join('sub_kriteria as a', 'p.jenis_pengaduan = a.id_sub_kriteria', 'left');
            $this->db->join('sub_kriteria as b', 'p.tingkat_keparahan = b.id_sub_kriteria', 'left');
            $this->db->join('sub_kriteria as c', 'p.peluang_kejadian = c.id_sub_kriteria', 'left');
            $this->db->join('sub_kriteria as d', 'p.durasi_kejadian = d.id_sub_kriteria', 'left');
            $this->db->join('user as u', 'p.id_user_pelanggan = u.id_user', 'left');
            $this->db->join('user as pu', 'p.id_user_petugas_unit = pu.id_user', 'left');
            // jika yang login petugas, munculin masalah yang ada di wilayahnya
            if ($this->session->userdata('id_user_level') == '3'){
            $this->db->where('id_lokasi_pengaduan', $this->session->userdata('id_lokasi'));
            }
            $this->db->where('id_user_pelanggan', $id_user);
            $query = $this->db->get();
            return $query->result();
        }

        public function update($id_alternatif, $data = [])
        {
            $this->db->where('no_pelanggan', $id_alternatif);
            $this->db->update('pengaduan', $data);
        }
        public function update_catatan($id_pengaduan, $data = [])
        {
            $this->db->where('id_pengaduan', $id_pengaduan);
            $this->db->update('pengaduan', $data);
        }

        public function delete($id_pengaduan)
        {
            $this->db->where('id_pengaduan', $id_pengaduan);
            $this->db->delete('pengaduan');
        }
    }
    