<?php

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('hak_akses') != '3'){
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
		$data['title'] = "Dashboard";
		$id=$this->session->userdata('nip');
		$data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE nip='$id'")->result();

		$this->load->view('template_manager/header',$data);
		$this->load->view('template_manager/sidebar');
		$this->load->view('manajer/dashboard', $data);
		$this->load->view('template_manager/footer');
	}
}

?>