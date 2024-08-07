<?php

class Dashboard extends CI_Controller {

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
		$pegawai = $this->db->query("SELECT * FROM data_pegawai");
		$admin = $this->db->query("SELECT * FROM data_pegawai WHERE jabatan = 'Admin'");
		$jabatan = $this->db->query("SELECT * FROM data_jabatan");
		$kehadiran = $this->db->query("SELECT * FROM data_kehadiran");
		
		// Query untuk mengambil data gaji bulan Juni dan Juli
        $query = $this->db->query("
            SELECT MONTH(tgl_gaji) as bulan, SUM(gaji_bersih) as total_gaji
            FROM data_gaji
            WHERE MONTH(tgl_gaji) IN (6, 7) AND YEAR(tgl_gaji) = 2024
            GROUP BY MONTH(tgl_gaji)
        ");

        // Format data untuk chart
        $data_gaji = $query->result();

        // Kirim data ke view
        $data['data_gaji'] = $data_gaji;

		$data['title'] = "Dashboard";
		$data['pegawai'] = $pegawai->num_rows(); 
		$data['admin'] = $admin->num_rows();
		$data['jabatan'] = $jabatan->num_rows();
		$data['kehadiran'] = $kehadiran->num_rows();

		$this->load->view('template_admin/header',$data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('template_admin/footer');
	}
}

?>