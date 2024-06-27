<?php

class Slip_Gaji extends CI_Controller {
 
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
		$data['title'] = "Slip Gaji Pegawai";
		$data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')-> result();

		$this->load->view('template_manager/header', $data);
		$this->load->view('template_manager/sidebar');
		$this->load->view('admin/gaji/slip_gaji', $data);
		$this->load->view('template_manager/footer');
	}

	public function cetak_slip_gaji(){

	$data['title'] = "Cetak Laporan Absensi Pegawai";
	$data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')-> result();
	$nama = $this->input->post('nama_pegawai');
	$bulan = $this->input->post('bulan');
	$tahun = $this->input->post('tahun');
	$bulantahun =$bulan.$tahun;

	$data['print_slip'] = $this->db->query("SELECT data_pegawai.nip,data_pegawai.nama_pegawai,data_pegawai.jabatan,data_gaji.tot_gapok,
	data_kehadiran.alpha,data_kehadiran.bulan, data_gaji.id_potongan, data_gaji.id_bonus, data_gaji.id_tunjangan, data_gaji.gaji_bersih 
	FROM data_pegawai 
	INNER JOIN data_kehadiran ON data_kehadiran.nip=data_pegawai.nip
	INNER JOIN data_gaji ON data_gaji.nip=data_kehadiran.nip		
		WHERE data_kehadiran.bulan='$bulantahun' AND data_kehadiran.nama_pegawai='$nama'")->result();
	$this->load->view('template_manager/header',$data);
	$this->load->view('admin/gaji/cetak_slip_gaji', $data);
	}
}
?>