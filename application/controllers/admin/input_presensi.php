<?php

class input_presensi extends CI_Controller {

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
		$data['title'] = "Data Kehadiran Pegawai update";
		$data['kehadiran'] = $this->ModelPenggajian->get_data('data_kehadiran')->result();
	    $data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();

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
		$this->load->view('admin/absensi/data_absensi', $data);
		$this->load->view('template_admin/footer');
	}

    public function tambah_data(){
        $data['kehadiran'] = $this->ModelPenggajian->get_data('data_kehadiran')->result();

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
		$this->load->view('admin/absensi', $data);
		$this->load->view('template_admin/footer');
    }

    public function tambah_data_aksi() {
        $this->_rules();

        if($this->form_validation->run() == FALSE) {
            $this->tambah_data();
        } else {
            $nip_nama_pegawai = $this->input->post('nip');
            list($nip, $nama_pegawai) = explode('|', $nip_nama_pegawai);
    
            $hadir      = $this->input->post('hadir');
            $sakit      = $this->input->post('sakit');
            $ijin  = $this->input->post('ijin');
            $alpha  = $this->input->post('alpha');

        $bulan  = $this->input->post('bulan');
        $tahun  = $this->input->post('tahun');
        // Gabungkan bulan dan tahun menjadi format YYYY-MM
        $tgl_presensi = $tahun . '-' . $bulan;

            $data = array(
                'nip'       => $nip,
                'nama_pegawai'       => $nama_pegawai,
                'hadir'     => $hadir,
                'sakit'  => $sakit,
                'ijin' => $ijin,
                'alpha' => $alpha,
                'bulan' => $tgl_presensi,
            );

            $this->ModelPenggajian->insert_data($data, 'data_kehadiran');

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil ditambahkan!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');

            redirect('admin/input_presensi');
        }
    }
    private function _rules() {
        // Rules validasi form
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('hadir', 'Jumlah Kehadiran', 'required');
        $this->form_validation->set_rules('sakit', 'Jumlah Sakit', 'required');
        $this->form_validation->set_rules('ijin', 'Jumlah Ijin', 'required');
        $this->form_validation->set_rules('alpha', 'Jumlah Tanpa Keterangan', 'required');
    }

    public function update_data($id){
        $data['title'] = "Update Data Kehadiran";
        $data['kehadiran'] = $this->ModelPenggajian->get_data_by_id($id_kehadiran, 'data_kehadiran')->row();
        $data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
    
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/absensi/update_absensi', $data);
        $this->load->view('template_admin/footer');
    }
    
    public function update_data_aksi(){
        $this->_rules();
    
        if ($this->form_validation->run() == FALSE) {
            $this->update_data($this->input->post('id_kehadiran'));
        } else {
            $nip_nama_pegawai = $this->input->post('nip');
            list($nip, $nama_pegawai) = explode('|', $nip_nama_pegawai);
    
            $hadir = $this->input->post('hadir');
            $sakit = $this->input->post('sakit');
            $ijin = $this->input->post('ijin');
            $alpha = $this->input->post('alpha');
            $bulan = $this->input->post('bulan');
            $tahun = $this->input->post('tahun');
            
            // Gabungkan bulan dan tahun menjadi format YYYY-MM
            $tgl_presensi = $tahun . '-' . $bulan;
    
            $data = array(
                'hadir' => $hadir,
                'sakit' => $sakit,
                'ijin' => $ijin,
                'alpha' => $alpha,
                'bulan' => $tgl_presensi,
            );
    
            $where = array('nip' => $this->input->post('nip'));
    
            $this->ModelPenggajian->update_data('data_kehadiran', $data, $where);
    
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil diupdate!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
    
            redirect('admin/input_presensi');
        }
    }
    

    public function delete_data($id){
        $where = array('nip' => $id);
        $this->ModelPenggajian->delete_data($where, 'data_kehadiran');
    
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
    
        redirect('admin/input_presensi');
    }
    

}

?>