<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Penilaian extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('Penilaian_model');
        $this->load->model('Pengaduan_model');


    }

    public function index()
    {
        $data = [
            'page' => "Penilaian",
            'kriteria' => $this->Penilaian_model->get_kriteria(),
            'alternatif' => $this->Penilaian_model->get_alternatif()
        ];
        $this->load->view('penilaian/index', $data);
    }


    public function tambah_penilaian()  
    {
        $id_alternatif = $this->input->post('id_alternatif');
        $id_kriteria = $this->input->post('id_kriteria');
        $nilai = $this->input->post('nilai');
        $i = 0;
        // echo var_dump($nilai);die;
        foreach ($nilai as $key) {
            $this->Penilaian_model->tambah_penilaian($id_alternatif, $id_kriteria[$i], $key);
            $i++;
        }
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
        if ($this->session->userdata('id_user_level') == '2') {
            redirect('daftar_pengaduan');
        }
        redirect('penilaian');
    }

    public function update_penilaian()
    {
        $id_alternatif = $this->input->post('id_alternatif');
        $id_kriteria = $this->input->post('id_kriteria');
        $nilai = $this->input->post('nilai');
        $i = 0;

        // upload bukti masalah
        $config['upload_path'] = FCPATH . 'uploads/bukti/';
        $config['allowed_types'] = 'jpg|jpeg|png|mp4';

        $this->load->library('upload', $config);

        // upload file sop
        $file_bukti = $this->upload->do_upload('bukti');
        $file_bukti = $this->upload->data();
        $file_bukti = $file_bukti['file_name'];
        // var_dump($file_bukti);die; 
        
        

        $pengaduan = [
            'no_pelanggan' => $this->input->post('id_alternatif'),
            'id_lokasi_pengaduan' => $this->input->post('id_lokasi'),
            'id_user_pelanggan' => $this->input->post('id_user'),
            'detail_masalah' => $this->input->post('detail_masalah'),
            'jenis_pengaduan' => $nilai[0],
            'tingkat_keparahan' => $nilai[1],
            'peluang_kejadian' => $nilai[2],
            'durasi_kejadian' => $nilai[3],
            'bukti' => $file_bukti,
            'status' => 'BELUM_DITANGANI'
        ];
        $cek_keberadaan_id = $this->db->get_where('pengaduan', array('no_pelanggan' => $id_alternatif))->num_rows();
        if($cek_keberadaan_id == 0){
            // masukkan ke pengaduan
            $this->Pengaduan_model->insert($pengaduan);
        }else{
            $pengaduan = [
                'no_pelanggan' => $this->input->post('id_alternatif'),
                'jenis_pengaduan' => $nilai[0],
                'tingkat_keparahan' => $nilai[1],
                'peluang_kejadian' => $nilai[2],
                'durasi_kejadian' => $nilai[3],
                'bukti' => $file_bukti,
            ];
            $this->Pengaduan_model->update($pengaduan, $id_alternatif);
        }

        // jika pelanggan memasukan pengaduan, update is_submited jadi 1
        $this->db->query("UPDATE alternatif SET is_submited = 1 WHERE id_alternatif = '$id_alternatif'");

        foreach ($nilai as $key) {
            $cek = $this->Penilaian_model->data_penilaian($id_alternatif, $id_kriteria[$i]);
            if ($cek == 0) {
                $this->Penilaian_model->tambah_penilaian($id_alternatif, $id_kriteria[$i], $key);
            } else {
                $this->Penilaian_model->edit_penilaian($id_alternatif, $id_kriteria[$i], $key);
            }
            $i++;
        }

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        if ($this->session->userdata('id_user_level') == '2') {
            redirect('daftar_pengaduan');
        }
        redirect('penilaian');
    }

    public function batal_pengaduan($id_alternatif){
        $batal = $this->Penilaian_model->batal_pengaduan($id_alternatif);
        if ($batal) {
            redirect('daftar_pengaduan');
        }
    }
}