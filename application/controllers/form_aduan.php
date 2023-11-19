<?php
class form_aduan extends CI_Controller
{
    public function __construct()
        {
            parent::__construct();
            $this->load->model('Penilaian_model');
            $this->load->model('Alternatif_model');
        }

    public function buat_laporan()
    {
        
        $alternatif = [
            'nama' => $this->session->userdata('nama'),
            'id_lokasi' => $this->session->userdata('id_lokasi'),
            'id_user' => $this->session->userdata('id_user'),
            'telp' => $this->session->userdata('telp'),
            'alamat' => $this->session->userdata('alamat'),
            'is_submited' => 0
        ];
        
        $id_kriteria = array( '39', '40', '41', '42', '44', '45');
        $nilai = array('182', '205', '196','199', '212', '211');
        $i = 0;
        
        // masukin ke alternatif (pelanggan) dan ambil lagi id nya
        $id_pelanggan = $this->Alternatif_model->insert($alternatif);
        $is_updated = 0;
        
        // id alternatifnya diambil untuk mengubah variabel session id_alternatif
        $this->session->set_userdata('id_alternatif', $id_pelanggan);
        if ($id_pelanggan != null) {
            foreach ($nilai as $key) {
                $penilaian = $this->Penilaian_model->tambah_penilaian($id_pelanggan, $id_kriteria[$i], $key, $is_updated);
                // var_dump($penilaian);die;
                $i++;
            }
        }

        $data = [
            'kriteria'=> $this->Penilaian_model->get_kriteria(),
            'alternatif'=> $this->Penilaian_model->get_alternatif()             
        ];

        $this->load->view("form_aduan", $data);
    }
}
 