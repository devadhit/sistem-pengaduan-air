<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Login_model');
        $this->load->model('User_model');
    }
    public function index()
    {
        if ($this->Login_model->logged_id()) {
            redirect('Login/home');
        } else {
            $this->load->view('login');
        }
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        $passwordx = md5($password);
        $set = $this->Login_model->login($username, $passwordx);
        if ($set) {

            
            // set up variabel session
            $log = [
                'id_user' => $set->id_user,
                'username' => $set->username,
                'nama' => $set->nama,
                'id_user_level' => $set->id_user_level,
                'id_lokasi' => $set->id_lokasi,
                'alamat' => $set->alamat,
                'telp' => $set->telp,
                'status' => 'Logged'
            ];
         if($set->id_user_level == '3'){
                $data_petugas = $this->db->query("SELECT * FROM petugas JOIN lokasi ON petugas.id_lokasi = lokasi.id_lokasi");
                $log = [
                    'id_user' => $set->id_user,
                    'username' => $set->username,
                    'id_user_level' => $set->id_user_level,
                    'id_lokasi' => $data_petugas->row('id_lokasi'),
                    'nama' => $data_petugas->row('nama_petugas'),
                    'nama_lokasi' => $data_petugas->row('nama_lokasi'),
                    'status' => 'Logged'
                ];
            }
            // var_dump($log['id_lokasi']);die;
            $this->session->set_userdata($log);
            

            // apabila levelnya 1, arahkan ke halaman admin
            // apabila levelnya 2, ambil id pelanggan (dari id_alternatif yang id_usernya sesuai login)
            // dan set ke dalam session untuk melakukan penilaian
            if ($set->id_user_level == '1' || $set->id_user_level == '3' ) {
                redirect('Login/home');
            }else if ($set->id_user_level == '2') {
                redirect('home');
            }
            
            
        } else {
            $this->session->set_flashdata('message', 'Username atau Password Salah');
            redirect('login');
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('login');
    }

    public function home()
    {
        $data['page'] = "Dashboard";
        $this->load->view('admin/index', $data);
    }
}

/* End of file Login.php */