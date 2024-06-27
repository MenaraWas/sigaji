<?php

class Data_Jabatan extends CI_Controller { 

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('hak_akses') != '1' && $this->session->userdata('hak_akses') != '3'){
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
		$data['title'] = "Data Jabatan";
		$data['jabatan'] = $this->ModelPenggajian->get_data('data_jabatan')->result();
		
		$last_id_query = $this->db->select('id_jabatan')->order_by('id_jabatan', 'DESC')->limit(1)->get('data_jabatan');
		if ($last_id_query->num_rows() > 0) {
			$last_id = $last_id_query->row()->id_jabatan;
			$data['next_id'] = $last_id + 1;
		} else {
			// Jika tabel pegawai kosong, atur NIP awal ke 1
			$data['next_id'] = 1;
		}

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/jabatan/data_jabatan', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data() 
	{
		$data['title'] = "Tambah Data Jabatan";

		$last_id_query = $this->db->select('id_jabatan')->order_by('id_jabatan', 'DESC')->limit(1)->get('data_jabatan');

		// Tampilkan query yang dijalankan
		if ($last_id_query->num_rows() > 0) {
			// Tampilkan hasil query untuk memastikan
			$last_id = $last_id_query->row()->id_jabatan;
			$data['next_id'] = $last_id + 1;
		} else {
			// Jika tabel data_jabatan kosong, atur id_jabatan awal ke 1
			$data['next_id'] = 1;
		}


		
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/jabatan/tambah_dataJabatan', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data_aksi() {
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->tambah_data();
		} else {
			$nama_jabatan	= $this->input->post('nama_jabatan');
			

			$data = array(
				'nama_jabatan' 	=> $nama_jabatan,
				
			);

			$this->ModelPenggajian->insert_data($data, 'data_jabatan');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_jabatan');
		}
	}

	public function update_data($id) 
	{
		$where = array('id_jabatan' => $id);
		$data['jabatan'] = $this->db->query("SELECT * FROM data_jabatan WHERE id_jabatan= '$id'")->result();
		$data['title'] = "Update Data Jabatan";
		
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/jabatan/update_dataJabatan', $data);
		$this->load->view('template_admin/footer');
	}

	public function update_data_aksi() {
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->update_data();
		} else {
			$id				= $this->input->post('id_jabatan');
			$nama_jabatan	= $this->input->post('nama_jabatan');

			$data = array(
				'nama_jabatan' 	=> $nama_jabatan
			);
 
			$where = array(
				'id_jabatan' => $id
			);

			$this->ModelPenggajian->update_data('data_jabatan', $data, $where);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil diupdate!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_jabatan');
		}
	}

	public function _rules() {
		$this->form_validation->set_rules('nama_jabatan','Nama Jabatan','required');
	}

	public function delete_data($id) {
		$where = array('id_jabatan' => $id);
		$this->ModelPenggajian->delete_data($where, 'data_jabatan');
		$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_jabatan');
	}
}

?>