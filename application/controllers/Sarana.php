<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Sarana extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('Sarana_model');

        if ($this->session->userdata('id_user_level') != "3") {
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
        $data['page'] = "Sarana";
        $data['list'] = $this->Sarana_model->tampil();
        $this->load->view('sarana/index', $data);
    }

    //menampilkan view create
    public function create()
    {
        $data['page'] = "Sarana";
        $this->load->view('sarana/create', $data);
    }

    //menambahkan data ke database
    public function store()
    {
        $data = [
            'tanggal' => $this->input->post('tanggal'),
            'nama_sarana' => $this->input->post('nama_sarana'),
            'status' => $this->input->post('status')
        ];


        $result = $this->Sarana_model->insert($data);
        if ($result) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            redirect('Sarana');
        }


    }

    public function edit($id_sarana)
    {
        $data['page'] = "Sarana";
        $data['sarana'] = $this->Sarana_model->show($id_sarana);
        $this->load->view('sarana/edit', $data);
    }

    public function update($id_sarana)
    {
        // TODO: implementasi update data berdasarkan $id_kriteria
        $id_kriteria = $this->input->post('id_sarana');
        $data = [
            'tanggal' => $this->input->post('tanggal'),
            'nama_sarana' => $this->input->post('nama_sarana'),
            'status' => $this->input->post('status')
        ];

        $this->Sarana_model->update($id_kriteria, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        redirect('Sarana');
    }

    public function destroy($id_kriteria)
    {
        $this->Sarana_model->delete($id_kriteria);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('Sarana');
    }

}