<?php
class Potongan_Gaji extends CI_Controller {

	function __construct(){
        parent::__construct();
        $this->load->model('ModelPotongan_Gaji');

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

	function index()
	{
        $data['title'] = "Setting Potongan Gaji";

        $this->load->view('template_admin/header');
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/potongan_gaji/list_potonganGaji', $data);
        $this->load->view('template_admin/footer');
    }

    function TampilPotongan()
    {
        $data['hasil']=$this->ModelPotongan_Gaji->TampilPotongan();
        $this->load->view('admin/potongan_gaji/data_potonganGaji',$data);
    }

    function tambah_potonganGaji()
    {
        $last_id = $this->ModelPotongan_Gaji->get_last_id();
        $kode_unik = '' . str_pad($last_id + 1, 1, '0', STR_PAD_LEFT); // Menghasilkan kode unik dari 1
        $data['kode_unik'] = $kode_unik;
        $this->load->view('admin/potongan_gaji/tambah_potonganGaji', $data);
    }

    function edit_potonganGaji()
    {
        $potongan=$this->input->post('potongan');
        $data['hasil']=$this->ModelPotongan_Gaji->Getpotongan($potongan);
        $this->load->view('admin/potongan_gaji/edit_potonganGaji',$data);
    }
    
    function hapus_potonganGaji()
    {
        $potongan=$this->input->post('potongan');
        $data['hasil']=$this->ModelPotongan_Gaji->Getpotongan($potongan);
        $this->load->view('admin/potongan_gaji/hapus_potonganGaji',$data);
    }

    function simpanPotongan()
    {
        $data = array(
            'id' => $this->input->post('id'),
            'potongan'=>$this->input->post('potongan'),
            'jml_potongan'=>$this->input->post('jml_potongan'),
            'keterangan'=>$this->input->post('keterangan')
            );
            $this->db->insert('potongan_gaji',$data);
    }

    function editPotongan()
    {
        $data = array(
            'potongan'=>$this->input->post('potongan_baru'),
            'jml_potongan'=>$this->input->post('jml_potongan'),
            'keterangan'=>$this->input->post('keterangan')
		);
        $potongan = $this->input->post('potongan_lama');
        $this->db->where('potongan', $potongan);
        $this->db->update('potongan_gaji',$data);
    }
    function hapusPotongan()
    {
        $potongan=$this->input->post('potongan');
        $this->db->delete('potongan_gaji',array('potongan' => $potongan));
    }
    function Getpotongan($potongan) {
        $this->db->where('potongan', $potongan);
        return $this->db->get('potongan_gaji')->row();
    }

    

}
?>