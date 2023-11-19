<?php
class daftar_pengaduan extends CI_Controller
{
    public function __construct()
        {
            parent::__construct();
            $this->load->library('pagination');
            $this->load->library('form_validation');
            $this->load->model('Pengaduan_model');
        }

    public function index()
    {
        $data['list'] = $this->Pengaduan_model->show($this->session->userdata('id_user'));
        $this->load->view("daftar_pengaduan", $data);
    }
}
