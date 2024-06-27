<?php

class Data_Pegawai extends CI_Controller {

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

		$this->load->view('template_manager/header', $data);
		$this->load->view('template_manager/sidebar');
		$this->load->view('admin/pegawai/data_pegawai', $data);
		$this->load->view('template_manager/footer');
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

    $this->load->view('template_manager/header', $data);
    $this->load->view('template_manager/sidebar');
    $this->load->view('admin/pegawai', $data);
    $this->load->view('template_manager/footer');
}


public function tambah_data_aksi()
{
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
        $this->tambah_data();
    } else {
        $nama_pegawai   = $this->input->post('nama_pegawai');
        // $email       = $this->input->post('email');
        // $password       = md5($this->input->post('password'));
        $jenis_kelamin  = $this->input->post('jenis_kelamin');
        $jabatan        = $this->input->post('jabatan');
        $tgl_lahir  = $this->input->post('tgl_lahir');
        $status         = $this->input->post('status');
        // $hak_akses      = $this->input->post('hak_akses');
        $alamat      = $this->input->post('alamat');
        $gaji_pokok      = $this->input->post('gaji_pokok');
        $no_telp     = $this->input->post('no_telp');
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
            // 'email'      => $email,
            // 'password'      => $password,
            'jenis_kelamin' => $jenis_kelamin,
            'jabatan'       => $jabatan,
            'tgl_lahir' => $tgl_lahir,
            'status'        => $status,
            // 'hak_akses'     => $hak_akses,
            'no_telp'     => $no_telp,
            'alamat'     => $alamat,
            'gaji_pokok'     => $gaji_pokok,
            'photo'         => $photo,
        );

        // Simpan data ke database
        $this->ModelPenggajian->insert_data($data, 'data_pegawai');

		// Proses pengisian data user
        // $data_to_user = array(
        //     'id_user'      => '',
        //     'email'        => $email,
        //     'password'     => $password,
        //     'Level'        => $hak_akses,
        // );

        // $this->ModelPenggajian->insert_data_to_user($data_to_user, 'data_user');

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



	// public function add_user(){

	// 	$this->_rules();
	// 	$email       = $this->input->post('email');
	// 	$password       = md5($this->input->post('password'));
	// 	$hak_akses      = $this->input->post('hak_akses');

	// 	$data_to_user = array(
	// 		'id_user'      => '',
	// 		'email'      => $email,
	// 		'password'      => $password,
	// 		'Level'     => $hak_akses,
	// 	);

	// 	$this->ModelPenggajian->insert_data_to_user($data_to_user, 'data_user');
	// 	$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
	// 			<strong>Data berhasil ditambahkan!</strong>
	// 			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
	// 			<span aria-hidden="true">&times;</span>
	// 			</button>
	// 			</div>');
			
	// 		redirect('admin/data_user');
		
	// }
	

	public function update_data($id) 
	{
		$where = array('nip' => $id);
		$data['title'] = "update Data Pegawai";
		$data['jabatan'] = $this->ModelPenggajian->get_data('data_jabatan')->result();
		$data['pegawai'] = $this->db->query("SELECT * FROM data_pegawai WHERE nip='$id'")->result();
		
		$this->load->view('template_manager/header', $data);
		$this->load->view('template_manager/sidebar');
		$this->load->view('admin/pegawai/update_dataPegawai', $data);
		$this->load->view('template_manager/footer');
	}

	public function update_data_aksi() {
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->update_data();
		} else {
			
			$nip			= $this->input->post('nip');
			$nama_pegawai	= $this->input->post('nama_pegawai');
			// $email		= $this->input->post('email');
			// $password		= md5($this->input->post('password'));
			$jenis_kelamin	= $this->input->post('jenis_kelamin');
			$jabatan		= $this->input->post('jabatan');
			$tgl_lahir	= $this->input->post('tgl_lahir');
			$status			= $this->input->post('status');
			// $hak_akses		= $this->input->post('hak_akses');
			$alamat      = $this->input->post('alamat');
			$gaji_pokok      = $this->input->post('gaji_pokok');
			$no_telp     = $this->input->post('no_telp');
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
				'jenis_kelamin' => $jenis_kelamin,
				'jabatan' 		=> $jabatan,
				'tgl_lahir' => $tgl_lahir,
				'status' 		=> $status,
				// 'hak_akses' 	=> $hak_akses,
				'no_telp'     => $no_telp,
				'alamat'     => $alamat,
				'gaji_pokok'     => $gaji_pokok,
				'photo'         => $photo,
			);

			$where = array(
				'nip' => $nip

			);
			$this->ModelPenggajian->update_data('data_pegawai', $data, $where);

			// $data_to_user = array (
			// 	'email'        => $email,
            // 'password'     => $password,
            // 'Level'        => $hak_akses,
			// );

			$whereUser = array (
				'email' => $email
			);
				
			// $this->ModelPenggajian->update_data_to_user('data_user', $data_to_user, $whereUser);

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
		$this->form_validation->set_rules('tgl_lahir','Tanggal Masuk','required');
		$this->form_validation->set_rules('jabatan','Jabatan','required');
		$this->form_validation->set_rules('status','Status','required');
	}

	public function delete_data($id) {
		$where = array('nip' => $id);
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