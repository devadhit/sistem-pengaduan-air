<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Pengaduan extends CI_Controller {
    
        public function __construct()
        {
            parent::__construct();
            $this->load->library('pagination');
            $this->load->library('form_validation');
            $this->load->model('Pengaduan_model');

            if ($this->session->userdata('id_user_level') == "2" ) {
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
            $data['page'] = "Pengaduan"; 
			$data['list'] = $this->Pengaduan_model->tampil($this->input->get('status'), $this->input->get('tanggal_dibuat'));
            $this->load->view('pengaduan/index', $data);
        }
        public function evaluasi()
        {
            $data['page'] = "Evaluasi"; 
			$data['list'] = $this->Pengaduan_model->evaluasi();
            $this->load->view('pengaduan/evaluasi', $data);
        }
        
        //menampilkan view create
         public function create()
        {
			$data['page'] = "Pengaduan";
            $this->load->view('pengaduan/create', $data);
        }

        //menambahkan data ke database
        public function store()
        {
                $data = [
                    'keterangan' => $this->input->post('keterangan'),
                    'kode_kriteria' => $this->input->post('kode_kriteria'),
                    'bobot' => $this->input->post('bobot'),
                    'jenis' => $this->input->post('jenis')
                ];
                
                $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
                $this->form_validation->set_rules('kode_kriteria', 'Kode Kriteria', 'required');
                $this->form_validation->set_rules('bobot', 'Bobot', 'required');
                $this->form_validation->set_rules('jenis', 'Jenis', 'required');
    
                if ($this->form_validation->run() != false) {
                    $result = $this->Pengaduan_model->insert($data);
                    if ($result) {
                        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil disimpan!</div>');
						redirect('Kriteria');
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Data gagal disimpan!</div>');
                    redirect('pengaduan/create');
                    
                }
            

        }

        public function edit($id_kriteria)
        {
            $data['page'] = "Pengaduan";
			$data['kriteria'] = $this->Pengaduan_model->show($id_kriteria);
            $this->load->view('pengaduan/edit', $data);
        }
    
        public function update($id_kriteria)
        {
            // TODO: implementasi update data berdasarkan $id_kriteria
            $id_kriteria = $this->input->post('id_kriteria');
            $data = array(
                'keterangan' => $this->input->post('keterangan'),
                'kode_kriteria' => $this->input->post('kode_kriteria'),
                'bobot' => $this->input->post('bobot'),
                'jenis' => $this->input->post('jenis')
            );

            $this->Pengaduan_model->update($id_kriteria, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('kriteria');
        }
        
        public function update_catatan($id_pengaduan)
        {
            $data = [
                'catatan' => $this->input->post('catatan'),
            ];

            $this->Pengaduan_model->update_catatan($id_pengaduan, $data);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil diupdate!</div>');
			redirect('pengaduan/evaluasi');
        }
        
    
        public function tangani($id_pengaduan)
        {
            $ubah = [
                'status' => 'SEDANG_DITANGANI'
            ];
            $this->db->where('id_pengaduan', $id_pengaduan);
            $this->db->update('pengaduan', $ubah);
			redirect('pengaduan?status=sedang_ditangani');

        }
        public function selesai($id_pengaduan)
        {
            $ubah = [
                'status' => 'SUDAH_DITANGANI'
            ];
            $this->db->where('id_pengaduan', $id_pengaduan);
            $this->db->update('pengaduan', $ubah);
			redirect('pengaduan?status=sudah_ditangani');

        }
        public function belum($id_pengaduan)
        {
            $ubah = [
                'status' => 'BELUM_DITANGANI'
            ];
            $this->db->where('id_pengaduan', $id_pengaduan);
            $this->db->update('pengaduan', $ubah);
			redirect('pengaduan?status=belum_ditangani');

        }
        public function destroy($id_kriteria)
        {
            $this->Pengaduan_model->delete($id_kriteria);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Data berhasil dihapus!</div>');
			redirect('kriteria');
        }
    
    }
    