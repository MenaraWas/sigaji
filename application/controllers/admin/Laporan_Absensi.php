<?php

class Laporan_Absensi extends CI_Controller {

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

	public function index() {
		$data['title'] = "Laporan Data Absensi Pegawai";
	    $data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();

		$bulan = $this->input->get('bulan'); 

		$this->db->select('data_kehadiran.*, data_pegawai.nama_pegawai, data_pegawai.jabatan');
		$this->db->from('data_kehadiran');
		$this->db->join('data_pegawai', 'data_kehadiran.nip = data_pegawai.nip');

		if (!empty($nip)) {
			$this->db->where('data_kehadiran.nip', $nip);
		}
		if (!empty($bulan)) {
			$this->db->like('data_kehadiran.bulan', $bulan);
		}

		$data['kehadiran'] = $this->db->get()->result();

        // Mendapatkan nomor kehadiran gaji berikutnya
		$last_no_kehadiran_query = $this->db->select('id_kehadiran')->order_by('id_kehadiran', 'DESC')->limit(1)->get('data_kehadiran');
		if ($last_no_kehadiran_query->num_rows() > 0) {
			$last_no_kehadiran = $last_no_kehadiran_query->row()->id_kehadiran;
			$data['next_no_kehadiran'] = $last_no_kehadiran + 1;
		} else {
			$data['next_no_kehadiran'] = 1;
		}

		$this->load->view('template_admin/header', $data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/absensi/laporan_absensi', $data);
		$this->load->view('template_admin/footer');
	}

	public function cetak_laporan_absensi(){

		$nip = $this->input->get('nip');
		$bulan = $this->input->get('bulan'); 

		$this->db->select('data_kehadiran.*, data_pegawai.nama_pegawai, data_pegawai.jabatan');
		$this->db->from('data_kehadiran');
		$this->db->join('data_pegawai', 'data_kehadiran.nip = data_pegawai.nip');

		if (!empty($nip)) {
			$this->db->where('data_kehadiran.nip', $nip);
		}
		if (!empty($bulan)) {
			$this->db->like('data_kehadiran.bulan', $bulan);
		}

		$data['kehadiran'] = $this->db->get()->result();


		// Getting the next kehadiran number
		$this->db->order_by('id_kehadiran', 'DESC');
		$this->db->limit(1);
		$last_no_kehadiran_query = $this->db->get('data_kehadiran');

		if ($last_no_kehadiran_query->num_rows() > 0) {
			$last_no_kehadiran = $last_no_kehadiran_query->row()->id_kehadiran;
			$data['next_no_kehadiran'] = $last_no_kehadiran + 1;
		} else {
			$data['next_no_kehadiran'] = 1;
		}


	$this->load->view('template_admin/header',$data);
	$this->load->view('admin/absensi/cetak_absensi', $data);
	}
}

?>