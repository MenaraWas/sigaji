<?php

class Data_User extends CI_Controller{


public function index(){
        $data['title'] = "Data User";        
		$data['user'] = $this->ModelPenggajian->get_data('data_user')->result();
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

	public function updated_data($id){
		$where = array('nip' => $id);
		$data['title'] = "Update Data User";
		
		// Ambil data pengguna yang relevan berdasarkan NIP
		$data['user'] = $this->ModelPenggajian->get_data_where('data_user', $where)->result();
		
		// Ambil data hak akses berdasarkan email (atau bisa juga berdasarkan ID)
		$data['hak_akses'] = $this->db->query("SELECT * FROM data_user WHERE nip='$id'")->result();
		
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/pegawai/update_dataUser', $data);
		$this->load->view('template_admin/footer');
	}
	

	
}
?>
	
