<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input_gaji extends CI_Controller {

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

		$this->load->model('ModelPenggajian'); // Memuat model untuk penggajian
		$this->load->library('form_validation'); // Memuat library form_validation
		$this->load->helper('url'); // Memuat helper URL untuk penggunaan base_url()
	}
	
	public function index() 
	{
		$data['title'] = "Data Gaji Karyawan";
		$data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();

		// Query untuk mengambil data gaji dan kehadiran
		$data['gaji'] = $this->db->query('SELECT data_gaji.*, dp.gaji_pokok, dk.nip, dk.nama_pegawai, dk.sakit, dk.ijin, dk.hadir, dk.alpha, potongan_gaji.*, data_tunjangan.*, data_bonus.*
            FROM data_gaji
            INNER JOIN data_kehadiran dk ON data_gaji.nip = dk.nip 
            INNER JOIN data_pegawai dp ON dk.nip = dp.nip 
            INNER JOIN potongan_gaji ON data_gaji.id_potongan = potongan_gaji.id
			INNER JOIN data_tunjangan ON data_gaji.id_tunjangan = data_tunjangan.Kode_Tunjangan
			INNER JOIN data_bonus ON data_gaji.id_bonus = data_bonus.Kode_Bonus
            ORDER BY dk.nama_pegawai ASC')->result();

		// Mendapatkan nomor slip gaji berikutnya
		$last_no_slip_query = $this->db->select('no_slip_gaji')->order_by('no_slip_gaji', 'DESC')->limit(1)->get('data_gaji');
		if ($last_no_slip_query->num_rows() > 0) {
			$last_no_slip = $last_no_slip_query->row()->no_slip_gaji;
			$data['next_no_slip'] = $last_no_slip + 1;
		} else {
			$data['next_no_slip'] = 1;
		}

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/penggajian/data_gaji', $data);
		$this->load->view('template_admin/footer');
	}
	
	public function tambah_data(){
		$data['title'] = "Tambah Data Gaji Pegawai";
		$data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();

		// Mendapatkan nomor slip gaji berikutnya
		$last_no_slip_query = $this->db->select('no_slip_gaji')->order_by('no_slip_gaji', 'DESC')->limit(1)->get('data_gaji');
		if ($last_no_slip_query->num_rows() > 0) {
			$last_no_slip = $last_no_slip_query->row()->no_slip_gaji;
			$data['next_no_slip'] = $last_no_slip + 1;
		} else {
			$data['next_no_slip'] = 1;
		}

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/penggajian/tambah_gaji', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambah_data_aksi(){
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		$this->form_validation->set_rules('tgl_gajian', 'Tanggal Gaji', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->tambah_data();
		} else {
			$nip = $this->input->post('nip');
			$tgl_gaji = $this->input->post('tgl_gajian');

			$data = array(
				'nip' => $nip,
				'tgl_gaji' => $tgl_gaji,
			);
			
			$this->ModelPenggajian->insert_data($data, 'data_gaji');

			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');

			redirect('admin/input_gaji');
		}
	}

	public function update_data($nip){
		$data['title'] = "Update Data Gaji Pegawai";
		$data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
		$data['gaji'] = $this->ModelPenggajian->get_data_by_id($nip, 'data_gaji')->row();

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/penggajian/update_gaji', $data);
		$this->load->view('template_admin/footer');
	}

	public function update_data_aksi(){
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		$this->form_validation->set_rules('tgl_gajian', 'Tanggal Gaji', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->update_data($this->input->post('nip'));
		} else {
			$nip = $this->input->post('nip');
			$tgl_gaji = $this->input->post('tgl_gajian');

			$data = array(
				'nip' => $nip,
				'tgl_gaji' => $tgl_gaji,
			);

			$where = array('nip' => $nip);

			$this->ModelPenggajian->update_data('data_gaji', $data, $where);

			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil diupdate!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');

			redirect('admin/input_gaji');
		}
	}

	public function delete_data($nip){
		$where = array('nip' => $nip);
		$this->ModelPenggajian->delete_data($where, 'data_gaji');

		$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Data berhasil dihapus!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');

		redirect('admin/input_gaji');
	}
}

?>
