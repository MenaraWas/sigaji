<?php

class Data_User extends CI_Controller{


public function index(){
        $data['title'] = "Data User";        
		$this->load->view('template_admin/header',$data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/Data_User', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data() {
		$data['title'] = " Tambah data";
		$this->load->view('template_admin/header',$data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/Data_User', $data);
		$this->load->view('template_admin/footer');
	}

	
}
?>
	
