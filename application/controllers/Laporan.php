<?php
    
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Laporan extends CI_Controller {
    
        public function __construct()
        {
            parent ::__construct();
            $this->load->model('Perhitungan_model');
        }

		public function index()
		{
			$data = [
				'hasil_topsis'=> $this->Perhitungan_model->get_hasil_topsis()
            ];
			
            $this->load->view('laporan', $data);
		} 
    }
    