<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Alternatif extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('Alternatif_model');
        $this->load->model('Penilaian_model');
        $this->load->model('Pengaduan_model');
        $this->load->model('Register_model');
        $this->load->model('Petugas_model');

    }

    public function index()
    {
        $data = [
            'page' => "Alternatif",
            'list' => $this->Alternatif_model->tampil(),

        ];
        $this->load->view('alternatif/index', $data);
    }

    //menampilkan view create
    public function create()
    {
        $data['page'] = "Alternatif";
        $data['lokasi'] = $this->Register_model->lokasi();

        $this->load->view('alternatif/create', $data);
    }

    //menambahkan data ke database
    public function store()
    {
        $data = [
            'nama' => $this->input->post('nama'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'telp' => $this->input->post('telp'),
            'alamat' => $this->input->post('alamat'),
            'tgl_laporan' => $this->input->post('tgl_laporan'),
        ];

        $id_kriteria = array('39', '40', '41', '42', '44', '45');
        $nilai = array('182', '205', '196', '199', '212', '211');
        $i = 0;

        $this->form_validation->set_rules('nama', 'Nama', 'required');



        if ($this->form_validation->run() != false) {
            // masukin ke alternatif (pelanggan) dan ambil lagi id nya
            $id_alternatif = $this->Alternatif_model->insert($data);
            $is_updated = 0;

            // masukkan ke pengaduan
            $pengaduan = [
                'no_pelanggan' => $id_alternatif,
                'id_lokasi_pengaduan' => $this->input->post('id_lokasi'),
                'detail_masalah' => $this->input->post('detail_masalah'),
                'id_user_pelanggan' => 0,
                'jenis_pengaduan' => $nilai[0],
                'tingkat_keparahan' => $nilai[1],
                'peluang_kejadian' => $nilai[2],
                'durasi_kejadian' => $nilai[3],
                'status' => 'BELUM_DITANGANI'
            ];
            $cek_keberadaan_id = $this->db->get_where('pengaduan', array('no_pelanggan' => $id_alternatif))->num_rows();
            if ($cek_keberadaan_id == 0) {
                // masukkan ke pengaduan
                $this->Pengaduan_model->insert($pengaduan);
            }

            if ($id_alternatif != null) {
                foreach ($nilai as $key) {
                    $penilaian = $this->Penilaian_model->tambah_penilaian($id_alternatif, $id_kriteria[$i], $key, $is_updated);
                    $i++;
                }
            }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            redirect('alternatif');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data gagal disimpan!</div>');
            redirect('alternatif/create');

        }


    }

    public function edit($id_alternatif)
    {
        $alternatif = $this->Alternatif_model->show($id_alternatif);
        $data = [
            'page' => "Alternatif",
            'alternatif' => $alternatif,
            'wilayah' => $this->Petugas_model->wilayah(),
            'detail_masalah' => $this->db->query("SELECT detail_masalah FROM pengaduan WHERE no_pelanggan = $id_alternatif")->row()
        ];
        $this->load->view('alternatif/edit', $data);
    }

    public function update($id_alternatif)
    {
        $id_alternatif = $this->input->post('id_alternatif');
        $data = array(
            'nama' => $this->input->post('nama'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'telp' => $this->input->post('telp'),
            'alamat' => $this->input->post('alamat'),
            'tgl_laporan' => $this->input->post('tgl_laporan'),
        );
        
        $pengaduan = [
            'detail_masalah' => $this->input->post('detail_masalah')
        ];
        $this->Pengaduan_model->update($pengaduan, $id_alternatif);

        $this->Alternatif_model->update($id_alternatif, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        redirect('alternatif');
    }

    public function destroy($id_alternatif)
    {
        $this->Alternatif_model->delete($id_alternatif);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('alternatif');
    }

}