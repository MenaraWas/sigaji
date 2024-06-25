<?php

class input_gaji extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('hak_akses') != '1'){
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Anda Belum Login!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
				redirect('login');
		}
	}
	
	public function index() 
	{
		$data['title'] = "Data Gaji Pegawai";

        if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan.$tahun;
		}else{
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan.$tahun;
		}

		$data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
		$data['gaji'] = $this->ModelPenggajian->get_data('data_gaji')->result();
		// $data['gaji'] = $this->db->query("");

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/penggajian/data_gaji', $data);
		$this->load->view('template_admin/footer');
	}

	public function get_latest_no_slip_gaji() {
		// Mengambil no slip gaji terbaru dari database
		$latest_no_slip_gaji = $this->ModelPenggajian->get_latest_no_slip_gaji();
		
		// Mengembalikan nilai no slip gaji terbaru
		echo $latest_no_slip_gaji;
	}
	
	
	public function input_gaji(){

	}
	

}

?>