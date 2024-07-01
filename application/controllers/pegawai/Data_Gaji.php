<?php

class Data_Gaji extends CI_Controller {

	public function __construct(){
		parent::__construct();

		if($this->session->userdata('hak_akses') != '2'){
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
		$data['title'] = "Data Gaji";
		$nip=$this->session->userdata('nip');
		$data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')->result();
		$data['gaji'] = $this->db->query("SELECT data_pegawai.nama_pegawai,data_pegawai.nip,data_gaji.tot_gapok,data_gaji.id_tunjangan,data_gaji.id_bonus,
			data_gaji.gaji_bersih,data_gaji.id_potongan,
			data_kehadiran.alpha,data_kehadiran.bulan,data_kehadiran.id_kehadiran
			FROM data_pegawai
			INNER JOIN data_kehadiran ON data_kehadiran.nip = data_pegawai.nip
			INNER JOIN data_jabatan ON data_jabatan.nama_jabatan = data_pegawai.jabatan
			INNER JOIN data_gaji ON data_gaji.nip = data_kehadiran.nip
			WHERE data_kehadiran.nip = '$nip'
			ORDER BY data_kehadiran.bulan DESC")->result();

		$this->load->view('template_pegawai/header',$data);
		$this->load->view('template_pegawai/sidebar');
		$this->load->view('pegawai/data_gaji', $data);
		$this->load->view('template_pegawai/footer');
	}

	public function cetak_slip($id)
	{
		$data['title'] = 'Cetak Slip Gaji';
		$data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')-> result();

		$data['print_slip'] = $this->db->query("SELECT data_pegawai.nip,data_pegawai.nama_pegawai,
			data_pegawai.jabatan,data_gaji.tot_gapok,data_gaji.id_tunjangan,data_gaji.id_bonus,data_gaji.id_potongan, data_gaji.gaji_bersih,data_kehadiran.alpha,data_kehadiran.bulan
			FROM data_pegawai
			INNER JOIN data_kehadiran ON data_kehadiran.nip=data_pegawai.nip
			INNER JOIN data_jabatan ON data_jabatan.nama_jabatan=data_pegawai.jabatan
			INNER JOIN data_gaji ON data_gaji.nip=data_kehadiran.nip
			WHERE data_kehadiran.id_kehadiran = '$id'")->result();
		$this->load->view('template_pegawai/header',$data);
		$this->load->view('pegawai/cetak_slip_gaji', $data);
	}
}

?>