<?php

class Laporan_Gaji extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if ($this->session->userdata('hak_akses') != '1') {
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
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
	$data['title'] = "Laporan Gaji";
	$data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();

	$nip = $this->input->get('nip');
	$bulan = $this->input->get('bulan');
	$status_pengajuan = $this->input->get('status_pengajuan');

	$this->db->select('data_gaji.*, data_pegawai.nama_pegawai, data_kehadiran.*');
	$this->db->from('data_gaji');
	$this->db->join('data_pegawai', 'data_gaji.nip = data_pegawai.nip');
	$this->db->join('data_kehadiran', 'data_gaji.nip = data_kehadiran.nip');


	if (!empty($nip)) {
		$this->db->where('data_gaji.nip', $nip);
	}
	if (!empty($bulan)) {
		$this->db->like('data_gaji.tgl_gaji', $bulan);
	}
	if (!empty($status_pengajuan)) {
		$this->db->where('data_gaji.status_pengajuan', $status_pengajuan);
	}

	$data['gaji'] = $this->db->get()->result();

		// Mendapatkan nomor slip gaji berikutnya
		$last_no_slip_query = $this->db->select('no_slip_gaji')->order_by('no_slip_gaji', 'DESC')->limit(1)->get('data_gaji');
		if ($last_no_slip_query->num_rows() > 0) {
			$last_no_slip = $last_no_slip_query->row()->no_slip_gaji;
			$data['next_no_slip'] = $last_no_slip + 1;
		} else {
			$data['next_no_slip'] = 1;
		}

	// Debug data
	// print_r($data['gaji']);
	// exit;

	$this->load->view('template_admin/header', $data);
	$this->load->view('template_admin/sidebar');
	$this->load->view('admin/gaji/laporan_gaji', $data);
	$this->load->view('template_admin/footer');
}

public function cetak_laporan_gaji() 
{
	$data['title'] = "Laporan Gaji";

	$nip = $this->input->get('nip');
	$bulan = $this->input->get('bulan');
	$status_pengajuan = $this->input->get('status_pengajuan');

	$this->db->select('data_gaji.*, data_pegawai.nama_pegawai, data_kehadiran.*');
	$this->db->from('data_gaji');
	$this->db->join('data_pegawai', 'data_gaji.nip = data_pegawai.nip');
	$this->db->join('data_kehadiran', 'data_gaji.nip = data_kehadiran.nip');


	if (!empty($nip)) {
		$this->db->where('data_gaji.nip', $nip);
	}
	if (!empty($bulan)) {
		$this->db->like('data_gaji.tgl_gaji', $bulan);
	}
	if (!empty($status_pengajuan)) {
		$this->db->where('data_gaji.status_pengajuan', $status_pengajuan);
	}

	$data['gaji'] = $this->db->get()->result();
	// Mendapatkan nomor slip gaji berikutnya
		$last_no_slip_query = $this->db->select('no_slip_gaji')->order_by('no_slip_gaji', 'DESC')->limit(1)->get('data_gaji');
		if ($last_no_slip_query->num_rows() > 0) {
			$last_no_slip = $last_no_slip_query->row()->no_slip_gaji;
			$data['next_no_slip'] = $last_no_slip + 1;
		} else {
			$data['next_no_slip'] = 1;
		}

	// Load view untuk mencetak laporan dengan data yang sudah disiapkan
	$this->load->view('admin/gaji/cetak_gaji', $data);
}
}

?>