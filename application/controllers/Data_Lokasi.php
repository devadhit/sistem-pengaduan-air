<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Data_Lokasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('Lokasi_model');

        if ($this->session->userdata('id_user_level') != "1") {
            ?>
            <script type="text/javascript">
                alert('Anda tidak berhak mengakses halaman ini!');
                window.location = '<?php echo base_url("Login/home"); ?>'
            </script>
            <?php
        }
    }

    public function index()
    {
        $data['page'] = "Data Lokasi";
        $data['list'] = $this->Lokasi_model->tampil();
        $this->load->view('data_lokasi/index', $data);
    }

    //menampilkan view create
    public function create()
    {
        $data['page'] = "Data_Lokasi";
        $this->load->view('data_lokasi/create', $data);
    }

    //menambahkan data ke database
    public function store()
    {
        $data = [
            'nama_lokasi' => $this->input->post('nama_lokasi')
        ];

        $this->form_validation->set_rules('nama_lokasi', 'Lokasi', 'required');



        if ($this->form_validation->run() != false) {
            $result = $this->Lokasi_model->insert($data);
            if ($result) {
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
                redirect('Data_Lokasi');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
            redirect('data_lokasi/create');

        }


    }

    public function edit($id_kriteria)
    {
        $data['page'] = "Data Lokasi";
        $data['kriteria'] = $this->Lokasi_model->show($id_kriteria);
        $this->load->view('data_lokasi/edit', $data);
    }

    public function update($id_kriteria)
    {
        // TODO: implementasi update data berdasarkan $id_kriteria
        $data = array(
            'nama_lokasi' => $this->input->post('nama_lokasi'),
        );
        // var_dump($data);die;    

        $this->Lokasi_model->update($id_kriteria, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        redirect('Data_Lokasi');
    }

    public function destroy($id_kriteria)
    {
        $this->Lokasi_model->delete($id_kriteria);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('Data_Lokasi');
    }

}