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


	// // Query untuk mengambil data gaji dan kehadiran
	// $data['gaji'] = $this->db->query('SELECT data_gaji.*, data_pegawai.gaji_pokok, data_kehadiran.nip, data_kehadiran.nama_pegawai, data_kehadiran.sakit, 
	// 	data_kehadiran.ijin, data_kehadiran.hadir, data_kehadiran.alpha
	// 	FROM data_gaji
	// 	INNER JOIN data_kehadiran ON data_gaji.nip = data_kehadiran.nip 
	// 	INNER JOIN data_pegawai  ON data_kehadiran.nip = data_pegawai.nip 
	// 	ORDER BY data_kehadiran.nama_pegawai ASC')->result();

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
	
			// Ambil gaji_pokok dari tabel data_pegawai berdasarkan nip
			$pegawai = $this->db->get_where('data_pegawai', array('nip' => $nip))->row();
	
			if ($pegawai) {
				$gaji_pokok = $pegawai->gaji_pokok;

				$total_potongan = $query_potongan->total_potongan;
	
				// Hitung gaji kotor
				$gaji_kotor = $gaji_pokok;
	
				// Hitung gaji bersih
				$gaji_bersih = $gaji_kotor - $total_potongan;
	
				$data = array(
					'nip' => $nip,
					'tgl_gaji' => $tgl_gaji,
					'tot_gapok' => $gaji_pokok,
					'gaji_kotor' => $gaji_kotor,
					'gaji_bersih' => $gaji_bersih,
					'status_pengajuan' => 'Proses'
				);
				
	
				$this->ModelPenggajian->insert_data($data, 'data_gaji');
	
				$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Data berhasil ditambahkan!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span> 
					</button>
					</div>');
	
				redirect('admin/input_gaji');
			} else {
				$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Data pegawai tidak ditemukan!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>');
	
				redirect('admin/input_gaji');
			}
		}
	}
	
	

	public function update_data($id) {
        $data['title'] = "Update Data Gaji Pegawai";
        $where = array('nip' => $id);
        // $data['gaji'] = $this->db->get_where('data_gaji', $where)->result();
		$data['gaji'] = $this->db->query("SELECT * FROM data_gaji WHERE nip='$where'")->result();
        $data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
    
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/penggajian/update_gaji', $data);
        $this->load->view('template_admin/footer');
    }
    
    public function update_data_aksi() {
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('gapok', 'Gaji Pokok', 'required');
        // $this->form_validation->set_rules('catatan', 'Catatan', 'required');
    
        if ($this->form_validation->run() == FALSE) {
            // Redirect back to the form with error messages
            $this->update_data();
        } else {
            $nip = $this->input->post('nip');
            $gapok = $this->input->post('gapok');
    
            $data_gaji = array(
                'tot_gapok' => $gapok,
            );
    
            $data_pegawai = array(
                'gaji_pokok' => $gapok
            );
    
            $where = array('nip' => $nip);
    
            // Update data_gaji
            $this->ModelPenggajian->update_data('data_gaji', $data_gaji, $where);
    
            // Update data_pegawai
            $this->ModelPenggajian->update_data('data_pegawai', $data_pegawai, $where);
    
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

	public function input_ke_jurnal() {
		// Tentukan bulan dan tahun yang ingin dihitung
		$bulan = date('Y-m'); // Misalnya, bulan ini
		// Bisa juga menggunakan input dari form:
		// $bulan = $this->input->get('bulan');
	
		// Query untuk menghitung total gaji pada bulan tertentu
		$this->db->select_sum('gaji_bersih');
		$this->db->from('data_gaji');
		$this->db->like('tgl_gaji', $bulan); 
		$total_gaji_bulan = $this->db->get()->row()->gaji_bersih;
	
		// Data yang akan dimasukkan ke jurnal umum untuk debit
		$data_jurnal_debit = array(
			'tanggal' => date('Y-m-d'), // Tanggal input ke jurnal
			'keterangan' => 'Hutang gaji bulan ' . $bulan,
			'debit' => $total_gaji_bulan,
			'kredit' => 0,
			'jenis' => 'Debit' // Sesuaikan dengan skema jurnal umum
		);
	
		// Data yang akan dimasukkan ke jurnal umum untuk kredit
		$data_jurnal_kredit = array(
			'tanggal' => date('Y-m-d'), // Tanggal input ke jurnal
			'keterangan' => 'Kas',
			'debit' => 0,
			'kredit' => $total_gaji_bulan,
			'jenis' => 'Kredit' // Sesuaikan dengan skema jurnal umum
		);
	
		// Masukkan data ke jurnal umum
		$this->ModelPenggajian->insert_data($data_jurnal_debit, 'jurnal_umum');
		$this->ModelPenggajian->insert_data($data_jurnal_kredit, 'jurnal_umum');
	
		// Redirect kembali dengan pesan sukses
		$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>Data berhasil dimasukkan ke jurnal umum!</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
			</div>');
	
		redirect('admin/input_gaji');
	}
	
	
}

?>