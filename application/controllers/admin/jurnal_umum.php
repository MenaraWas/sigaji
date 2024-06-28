<?php

class Jurnal_Umum extends CI_Controller {

    public function index() {
        $data['title'] = "Jurnal Umum";    
        $data['jurnal_umum'] = $this->ModelPenggajian->get_data('jurnal_umum')->result();    
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/jurnal_umum', $data);
        $this->load->view('template_admin/footer');
    }

    public function tambah_data() {
        $data['title'] = "Tambah Jurnal Umum";   
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/tambah_jurnal_umum', $data);
        $this->load->view('template_admin/footer');
    }

    public function tambah_data_aksi() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->tambah_data();
        } else {
            $tanggal = $this->input->post('tanggal');
            $keterangan = $this->input->post('keterangan');
            $ref = $this->input->post('ref');
            $debit = $this->input->post('debit');
            $kredit = $this->input->post('kredit');

            $data = array(
                'tanggal' => $tanggal,
                'keterangan' => $keterangan,
                'ref' => $ref,
                'debit' => $debit,
                'kredit' => $kredit
            );

            $this->ModelPenggajian->insert_data($data, 'jurnal_umum');
            $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Data berhasil ditambahkan!</strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>');
            redirect('admin/jurnal_umum');
        }
    }

    public function update_data($id) {
        $where = array('id' => $id);
        $data['jurnal_umum'] = $this->ModelPenggajian->edit_data($where, 'jurnal_umum')->result();
        $data['title'] = "Edit Jurnal Umum"; 
        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/edit_jurnal_umum', $data);
        $this->load->view('template_admin/footer');
    }

    public function update_data_aksi() {
        $id = $this->input->post('id');
        $tanggal = $this->input->post('tanggal');
        $keterangan = $this->input->post('keterangan');
        $ref = $this->input->post('ref');
        $debit = $this->input->post('debit');
        $kredit = $this->input->post('kredit');

        $data = array(
            'tanggal' => $tanggal,
            'keterangan' => $keterangan,
            'ref' => $ref,
            'debit' => $debit,
            'kredit' => $kredit
        );

        $where = array(
            'id' => $id
        );

        $this->ModelPenggajian->update_data($where, $data, 'jurnal_umum');
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil diupdate!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('jurnal_umum');
    }

    public function delete_data($id) {
        $where = array('id' => $id);
        $this->ModelPenggajian->delete_data($where, 'jurnal_umum');
        $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Data berhasil dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        redirect('jurnal_umum');
    }

    private function _rules() {
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');
        $this->form_validation->set_rules('ref', 'Ref', 'required');
        $this->form_validation->set_rules('debit', 'Debit', 'required|numeric');
        $this->form_validation->set_rules('kredit', 'Kredit', 'required|numeric');
    }
}
?>
