<?php

class Data_Pegawai extends CI_Controller {

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
		$data['title'] = "Data Pegawai";
		$data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
		$data['jabatan'] = $this->ModelPenggajian->get_data('data_jabatan')->result();

		$last_nip_query = $this->db->select('nip')->order_by('nip', 'DESC')->limit(1)->get('data_pegawai');
		if ($last_nip_query->num_rows() > 0) {
			$last_nip = $last_nip_query->row()->nip;
			$data['next_nip'] = $last_nip + 1;
		} else {
			// Jika tabel pegawai kosong, atur NIP awal ke 1
			$data['next_nip'] = 1;
		}

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/pegawai/data_pegawai', $data);
		$this->load->view('template_admin/footer');
	} 

	public function tambah_data()
{
    $data['title'] = "Tambah Data Pegawai";
    $data['jabatan'] = $this->ModelPenggajian->get_data('data_jabatan')->result();

    $last_nip_query = $this->db->select('nip')->order_by('nip', 'DESC')->limit(1)->get('data_pegawai');
    if ($last_nip_query->num_rows() > 0) {
        $last_nip = $last_nip_query->row()->nip;
        $data['next_nip'] = $last_nip + 1;
    } else {
        // Jika tabel pegawai kosong, atur NIP awal ke 1
        $data['next_nip'] = 1;
    }

    $this->load->view('template_admin/header', $data);
    $this->load->view('template_admin/sidebar');
    $this->load->view('admin/pegawai', $data);
    $this->load->view('template_admin/footer');
}


public function tambah_data_aksi()
{
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
        $this->tambah_data();
    } else {
        $nama_pegawai   = $this->input->post('nama_pegawai');
        $username       = $this->input->post('username');
        $password       = md5($this->input->post('password'));
        $jenis_kelamin  = $this->input->post('jenis_kelamin');
        $jabatan        = $this->input->post('jabatan');
        $tanggal_masuk  = $this->input->post('tanggal_masuk');
        $status         = $this->input->post('status');
        $hak_akses      = $this->input->post('hak_akses');
        $photo          = $_FILES['photo']['name'];

        // Ambil NIP terakhir
        $last_nip_query = $this->db->select('nip')->order_by('nip', 'DESC')->limit(1)->get('data_pegawai');
        if ($last_nip_query->num_rows() > 0) {
            $last_nip = $last_nip_query->row()->nip;
            $nip = $last_nip + 1;
        } else {
            // Jika tabel pegawai kosong, atur NIP awal ke 1
            $nip = 1;
        }

        // Simpan data ke dalam array
        $data = array(
            'nip'           => $nip,
            'nama_pegawai'  => $nama_pegawai,
            'username'      => $username,
            'password'      => $password,
            'jenis_kelamin' => $jenis_kelamin,
            'jabatan'       => $jabatan,
            'tanggal_masuk' => $tanggal_masuk,
            'status'        => $status,
            'hak_akses'     => $hak_akses,
            'photo'         => $photo,
        );

        // Simpan data ke database
        $this->ModelPenggajian->insert_data($data, 'data_pegawai');

        // Tambahkan data pengguna (user) jika diperlukan
        // ...

        $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil ditambahkan!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');

        redirect('admin/data_pegawai');
    }
}



	public function add_user(){

		$this->_rules();
		$username       = $this->input->post('username');
		$password       = md5($this->input->post('password'));
		$hak_akses      = $this->input->post('hak_akses');

		$data_to_user = array(
			'id_user'      => '',
			'username'      => $username,
			'password'      => $password,
			'Level'     => $hak_akses,
		);

		$this->ModelPenggajian->insert_data_to_user($data_to_user, 'data_user');
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			
			redirect('admin/data_user');
		
	}
	

	public function update_data($id) 
	{
		$where = array('id_pegawai' => $id);
		$data['title'] = "update Data Pegawai";
		$data['jabatan'] = $this->ModelPenggajian->get_data('data_jabatan')->result();
		$data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE id_pegawai='$id'")->result();
		
		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/pegawai/update_dataPegawai', $data);
		$this->load->view('template_admin/footer');
	}

	public function update_data_aksi() {
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->update_data();
		} else {
			$id				= $this->input->post('id_pegawai');
			$nip			= $this->input->post('nip');
			$nama_pegawai	= $this->input->post('nama_pegawai');
			$username		= $this->input->post('username');
			$password		= md5($this->input->post('password'));
			$jenis_kelamin	= $this->input->post('jenis_kelamin');
			$jabatan		= $this->input->post('jabatan');
			$tanggal_masuk	= $this->input->post('tanggal_masuk');
			$status			= $this->input->post('status');
			$hak_akses		= $this->input->post('hak_akses');
			$photo			= $_FILES['photo']['name'];
			if($photo){
				$config['upload_path'] 		= './photo';
				$config['allowed_types'] 	= 'jpg|jpeg|png|tiff';
				$config['max_size']			= 	2048;
				$config['file_name']		= 	'pegawai-'.date('ymd').'-'.substr(md5(rand()),0,10);
				$this->load->library('upload',$config);
				if($this->upload->do_upload('photo')){
					$photo=$this->upload->data('file_name');
					$this->db->set('photo',$photo);
				}else{
					echo $this->upload->display_errors();
				}
			}

			$data = array(
				'nip' 			=> $nip,
				'nama_pegawai' 	=> $nama_pegawai,
				'username' 		=> $username,
				'password' 		=> $password,
				'jenis_kelamin' => $jenis_kelamin,
				'jabatan' 		=> $jabatan,
				'tanggal_masuk' => $tanggal_masuk,
				'status' 		=> $status,
				'hak_akses' 	=> $hak_akses,
			);

			$where = array(
				'id_pegawai' => $id

			);

			$this->ModelPenggajian->update_data('data_pegawai', $data, $where);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil diupdate!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_pegawai');
		}
	}

	public function _rules() {
		$this->form_validation->set_rules('nip','nip','required');
		$this->form_validation->set_rules('nama_pegawai','Nama Pegawai','required');
		$this->form_validation->set_rules('jenis_kelamin','Jenis Kelamin','required');
		$this->form_validation->set_rules('tanggal_masuk','Tanggal Masuk','required');
		$this->form_validation->set_rules('jabatan','Jabatan','required');
		$this->form_validation->set_rules('status','Status','required');
	}

	public function delete_data($id) {
		$where = array('id_pegawai' => $id);
		$this->ModelPenggajian->delete_data($where, 'data_pegawai');
		$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_pegawai');
	}
}
?>