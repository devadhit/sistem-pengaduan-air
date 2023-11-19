<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SOP extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('pagination');
        $this->load->library('form_validation');
        $this->load->model('Sop_model');

        if ($this->session->userdata('id_user_level') == "2") {
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
        $data['page'] = "SOP";
        $data['list'] = $this->Sop_model->tampil();
        $this->load->view('sop/index', $data);
    }

    //menampilkan view create
    public function create()
    {
        $data['page'] = "SOP";
        $this->load->view('sop/create', $data);
    }

    //menambahkan data ke database
    public function store()
    {
        $data = [
            'file_sop' => $this->input->post('file_sop'),
            'file_ik' => $this->input->post('file_ik')
        ];


        $result = $this->Sop_model->insert($data);
        if ($result) {
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
            redirect('SOP');
        }


    }

    public function edit($id_sop)
    {
        $data['page'] = "SOP";
        $data['sop'] = $this->Sop_model->show($id_sop);
        $this->load->view('sop/edit', $data);
    }

    public function upload() {
        
    }

    public function update($id_sop)
    {
        $config['upload_path'] = FCPATH.'uploads/';
        $config['allowed_types'] = 'sql|pdf|docx|xlsx|csv';

        $this->load->library('upload', $config);

        // upload file sop
        $file_sop = $this->upload->do_upload('file_sop');
        $file_sop = $this->upload->data();
        $file_sop = $file_sop['file_name'];
        // upload file ik
        $file_ik = $this->upload->do_upload('file_ik');
        $file_ik = $this->upload->data();
        $file_ik = $file_ik['file_name'];
        

        // TODO: implementasi update data berdasarkan $id_sop
        $data = [
            'file_sop' => $file_sop,
            'file_ik' => $file_ik
        ];
       

        $this->Sop_model->update($id_sop, $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
        redirect('SOP');
    }

    public function destroy($id_sop)
    {
        $this->Sop_model->delete($id_sop);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
        redirect('SOP');
    }

}