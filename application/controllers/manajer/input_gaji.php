<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Input_gaji extends CI_Controller {

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

		$this->load->model('ModelPenggajian'); // Memuat model untuk penggajian
		$this->load->library('form_validation'); // Memuat library form_validation
		$this->load->helper('url'); // Memuat helper URL untuk penggunaan base_url()
	}
	
	public function index() 
{
	$data['title'] = "Data Gaji Karyawan";
	$data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();

	// Query untuk mengambil data gaji dan kehadiran
	$data['gaji'] = $this->db->query('SELECT data_gaji.*, data_pegawai.gaji_pokok, data_kehadiran.nip, data_kehadiran.nama_pegawai, data_kehadiran.sakit, 
		data_kehadiran.ijin, data_kehadiran.hadir, data_kehadiran.alpha
		FROM data_gaji
		INNER JOIN data_kehadiran ON data_gaji.nip = data_kehadiran.nip 
		INNER JOIN data_pegawai  ON data_kehadiran.nip = data_pegawai.nip 
		ORDER BY data_kehadiran.nama_pegawai ASC')->result();

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

	$this->load->view('template_manager/header', $data);
	$this->load->view('template_manager/sidebar');
	$this->load->view('manajer/penggajian/data_gaji', $data);
	$this->load->view('template_manager/footer');
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

		$this->load->view('template_manager/header', $data);
		$this->load->view('template_manager/sidebar');
		$this->load->view('manajer/penggajian/tambah_gaji', $data);
		$this->load->view('template_manager/footer');
	}

	public function tambah_data_aksi(){
		$this->form_validation->set_rules('nip', 'NIP', 'required');
		$this->form_validation->set_rules('tgl_gajian', 'Tanggal Gaji', 'required');
	
		if ($this->form_validation->run() == FALSE) {
			$this->tambah_data();
		} else {
			$nip = $this->input->post('nip');
			$tgl_gaji = $this->input->post('tgl_gajian');
	
			// Ambil gaji_pokok dari tabel data_pegawai berdasarkan nip
			$pegawai = $this->db->get_where('data_pegawai', array('nip' => $nip))->row();
	
			if ($pegawai) {
				$gaji_pokok = $pegawai->gaji_pokok;
	
				// // Query untuk mengambil total tunjangan dari data_tunjangan
				// $query_tunjangan = $this->db->query('SELECT COALESCE(SUM(jumlah_tunjangan), 0) AS total_tunjangan FROM data_tunjangan WHERE Kode_Tunjangan = "'.$kode_tunjangan.'"')->row();
				// $total_tunjangan = $query_tunjangan->total_tunjangan;
	
				// // Query untuk mengambil total bonus dari data_bonus
				// $query_bonus = $this->db->query('SELECT COALESCE(SUM(jumlah_bonus), 0) AS total_bonus FROM data_bonus WHERE Kode_Bonus = "'.$kode_bonus.'"')->row();
				// $total_bonus = $query_bonus->total_bonus;
	
				// // Query untuk mengambil total potongan dari potongan_gaji
				// $query_potongan = $this->db->query('SELECT COALESCE(SUM(jml_potongan), 0) AS total_potongan FROM potongan_gaji WHERE id = "'.$id.'"')->row();
				$total_potongan = $query_potongan->total_potongan;
	
				// Hitung gaji kotor
				$gaji_kotor = $gaji_pokok + $total_tunjangan + $total_bonus;
	
				// Hitung gaji bersih
				$gaji_bersih = $gaji_kotor - $total_potongan;
	
				$data = array(
					'nip' => $nip,
					'tgl_gaji' => $tgl_gaji,
					'tot_gapok' => $gaji_pokok,
					// 'total_tunjangan' => $total_tunjangan,
					// 'total_bonus' => $total_bonus,
					// 'total_potongan' => $total_potongan,
					'gaji_kotor' => $gaji_kotor,
					'gaji_bersih' => $gaji_bersih,
				);
	
				$this->ModelPenggajian->insert_data($data, 'data_gaji');
	
				$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil ditambahkan!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
	
				redirect('manajer/input_gaji');
			} else {
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data pegawai tidak ditemukan!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
	
				redirect('manajer/input_gaji');
			}
		}
	}
	
	

	public function update_data($nip){
		$data['title'] = "Update Data Gaji Pegawai";
		$data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
		$data['gaji'] = $this->ModelPenggajian->get_data_by_id($nip, 'data_gaji')->row();

		$this->load->view('template_manager/header', $data);
		$this->load->view('template_manager/sidebar');
		$this->load->view('manajer/penggajian/update_gaji', $data);
		$this->load->view('template_manager/footer');
	}

	public function update_data_aksi(){
		$this->form_validation->set_rules('nip', 'NIP', 'required');

		if ($this->form_validation->run() == FALSE) {
			$this->update_data($this->input->post('nip'));
		} else {
			$nip = $this->input->post('nip');
			$status_pengajuan = $this->input->post('status_pengajuan');
			$catatan = $this->input->post('catatan');

			$data = array(
				'status_pengajuan' => $status_pengajuan,
				'catatan' => $catatan,
			);

			$where = array('nip' => $nip);

			$this->ModelPenggajian->update_data('data_gaji', $data, $where);

			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil diupdate!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');

			redirect('manajer/input_gaji');
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

		redirect('manajer/input_gaji');
	}
}

?>