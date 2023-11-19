<?php
class Register extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('Alternatif_model');
        $this->load->model('Penilaian_model');
        $this->load->model('Register_model');
    }

    public function index()
    {
        $data = [
            'page' => "Alternatif",
            'lokasi' => $this->Register_model->lokasi(),
            
        ];
        $this->load->view("register", $data);
    }

    public function store()
    {
        $user = [
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'id_user_level' => 2,
            'telp' => $this->input->post('telp'),
            'id_lokasi' => $this->input->post('id_lokasi'),
            'alamat' => $this->input->post('alamat')
        ];

        // add user disini menyimpan data user untuk login dan mengembalikan nilai id_user untuk dimasukan ke tabel aternatif
        $add_user = $this->Register_model->insert($user);

        // $alternatif = [
        //     'nama' => $this->input->post('nama'),
        //     'id_lokasi' => $this->input->post('id_lokasi'),
        //     'id_user' => $add_user,
        //     'telp' => $this->input->post('telp'),
        //     'alamat' => $this->input->post('alamat'),
        // ];

        // $id_kriteria = array('0', '39', '40', '41', '42', '44', '45');
        // $nilai = array('0','182', '205', '196','199', '212', '211');


        // $id_pelanggan = $this->Alternatif_model->insert($alternatif);

        // if ($id_pelanggan != null) {
        //     foreach ($nilai as $key) {
        //         $this->Penilaian_model->tambah_penilaian($id_pelanggan, $id_kriteria[$i], $key);
        //         $i++;
        //     }
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            redirect('alternatif');
        // }


    }
}