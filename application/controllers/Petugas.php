<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Petugas extends CI_Controller {
    
        public function __construct() 
        {
            parent::__construct();
            $this->load->library('pagination');
            $this->load->library('form_validation');
            $this->load->model('Petugas_model');

            if ($this->session->userdata('id_user_level') != "1") {
            ?>
				<script type="text/javascript">
                    alert('Anda tidak berhak mengakses halaman ini!');
                    window.location='<?php echo base_url("Login/home"); ?>'
                </script>
            <?php
			}
        }

        public function index()
        { 
            $data = [
				'page' => "Petugas",
                'list' => $this->Petugas_model->tampil(),
                'user_level'=> $this->Petugas_model->user_level()
                
            ];
            $this->load->view('petugas/index', $data);
        }
        
        public function create()
        {
            $data['page'] = "User";
			$data['wilayah'] = $this->Petugas_model->wilayah();
            $this->load->view('petugas/create',$data);
        }

        public function store()
        {
            
			$data = [
				'id_user_level' => '3', //id level petugas
				'nama' => $this->input->post('nama'),
				'email' => $this->input->post('email'),
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
			];		

			
				$result = $this->Petugas_model->insert($data); //kalau berhasil akan memberikan id user
                $petugas = [
                    'id_user' => $result,
                    'id_lokasi' => $this->input->post('lokasi'),
                    'nama_petugas' => $this->input->post('nama'),
                ];
				$insert = $this->Petugas_model->insert_petugas($petugas);
				if ($insert) {
					$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
					redirect('Petugas');
				}
            

        }

        public function show($id_user)
        {
            $User = $this->Petugas_model->show($id_user);
            $user_level = $this->Petugas_model->user_level();
            $data = [
				'page' => "Petugas",
                'data' => $User,
                'user_level'=>$user_level
            ];
            $this->load->view('petugas/show', $data);
        }

        public function edit($id_user)
        {
            $User = $this->Petugas_model->show($id_user);
            $wilayah = $this->Petugas_model->wilayah();
            $data = [
                'page' => "Petugas",
				'User' => $User,
                'wilayah'=>$wilayah
            ];
            $this->load->view('petugas/edit', $data);
        }
    
        public function update($id_user)
        {
            // TODO: implementasi update data berdasarkan $id_user
            $id_user = $this->input->post('id_user');
            $data = array(
                'page' => "Petugas",
				'nama' => $this->input->post('nama'),
                'email' => $this->input->post('email'),
                'username' => $this->input->post('username'),
                'password' => md5($this->input->post('password'))
            );

            $petugas = [
                'id_lokasi' => $this->input->post('lokasi'),
                'nama_petugas' => $this->input->post('nama'),
            ];

            $this->Petugas_model->update($id_user, $data);
            $this->Petugas_model->update_petugas($id_user, $petugas);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('Petugas');
        }
    
        public function destroy($id_user)
        {
            $this->Petugas_model->delete($id_user);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
			redirect('Petugas');
        }
    
    }
    
    /* End of file Kategori.php */
    