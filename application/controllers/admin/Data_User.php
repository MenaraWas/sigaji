<?php

class Data_User extends CI_Controller {

    public function index() {
        $data['title'] = "Data User";        
        $data['user'] = $this->ModelPenggajian->get_data('data_user')->result();
        $data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
        $data['hak_akses'] = $this->ModelPenggajian->get_data('hak_akses')->result();
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/Data_User', $data);
        $this->load->view('template_admin/footer');
    }

    public function tambah_data() {
        $data['title'] = "Tambah Data";
        $data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
        $data['hak_akses'] = $this->ModelPenggajian->get_data('hak_akses')->result();

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/Data_User', $data);
        $this->load->view('template_admin/footer');
    }

    public function tambah_data_aksi() {
        $this->_rules();

        if($this->form_validation->run() == FALSE) {
            $this->tambah_data();
        } else {
            $nip        = $this->input->post('nip');
            $email      = $this->input->post('email');
            $password   = md5($this->input->post('password'));
            $hak_akses  = $this->input->post('hak_akses');

            $data = array(
                'nip'       => $nip,
                'email'     => $email,
                'password'  => $password,
                'Level' => $hak_akses,
            );

			$data_to_pegawai = array(
                'email'     => $email,
                'password'  => $password,
                'hak_akses' => $hak_akses,
            );
			$where = array(
				'nip' => $nip
			);

            $this->ModelPenggajian->insert_data($data, 'data_user');
			$this->ModelPenggajian->update_data_to_pegawai($data_to_pegawai, 'data_pegawai', $where);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil ditambahkan!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');

            redirect('admin/data_user');
        }
    }

    public function _rules() {
        $this->form_validation->set_rules('nip', 'NIP', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');
        $this->form_validation->set_rules('hak_akses', 'Hak Akses', 'required');
    }

    public function update_data($id) {
        $where = array('nip' => $id);
        $data['title'] = "Update Data User";
        
		$data['user'] = $this->db->query("SELECT * FROM data_user WHERE nip='$where'")->result();
        $data['hak_akses'] = $this->ModelPenggajian->get_data('hak_akses')->result();
        
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/pegawai/update_dataUser', $data);
        $this->load->view('template_admin/footer');
    }

    public function update_data_aksi(){
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update_data();
        } else {
            $nip        = $this->input->post('nip');
            $email      = $this->input->post('email');
            $password   = md5($this->input->post('password'));
            $hak_akses  = $this->input->post('hak_akses');

            $data = array(
                'email'     => $email,
                'password'  => $password,
                'Level'     => $hak_akses,
            );

            $data_to_pegawai = array(
                'email'     => $email,
                'password'  => $password,
                'hak_akses' => $hak_akses,
            );

            $where = array(
                'nip' => $nip
            );

            $this->ModelPenggajian->update_data('data_user',$data,  $where);
            $this->ModelPenggajian->update_data_to_pegawai($data_to_pegawai, 'data_pegawai', $where);

            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil diupdate!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');

            redirect('admin/data_user');
        }
    }

	public function delete_data($id) {
		$where = array('nip' => $id);
		$this->ModelPenggajian->delete_data($where, 'data_user');
		$this->ModelPenggajian->delete_data($where, 'data_pegawai');
		$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_user');
	}
}
?>
