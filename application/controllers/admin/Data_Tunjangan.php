<?php

class Data_Tunjangan extends CI_Controller{

    public function index()
    {
            $data['title'] = "Data Tunjangan";       
            $data['tunjangan'] = $this->ModelPenggajian->get_data('data_tunjangan')  
            ->result();	 
            $this->load->view('template_admin/header',$data);
            $this->load->view('template_admin/sidebar');
            $this->load->view('admin/Data_Tunjangan', $data);
            $this->load->view('template_admin/footer');
        }
        public function tambahdata()
        {
                $data['title'] = "Tambah Data Tunjangan";    

            // Mendapatkan Kode Tunjangan terakhir
            $lastTunjangan = $this->db->select('Kode_Tunjangan')
            ->order_by('Kode_Tunjangan', 'DESC')
            ->limit(1)
            ->get('data_tunjangan')
            ->row();

            // Menghasilkan Kode Tunjangan baru
            if ($lastTunjangan) {
            $data['newKodeTunjangan'] = intval($lastTunjangan->Kode_Tunjangan) + 1;
            } else {
            $data['newKodeTunjangan'] = 1;
            }
      
                $this->load->view('template_admin/header',$data);
                $this->load->view('template_admin/sidebar');
                $this->load->view('admin/tambahDataTunjangan', $data);
                $this->load->view('template_admin/footer');
            }

            Public function tambahDataAksi()

            {
                $this->_rules();
        
                if($this->form_validation->run() == FALSE) {
                    $this->tambahdata();
                }else{
                    $Nama_Tunjangan		=$this->input->post('Nama_Tunjangan');
                    $Jumlah_Tunjangan	=$this->input->post('Jumlah_Tunjangan');
                    $Keterangan		    =$this->input->post('Keterangan');


                    // Mendapatkan Kode Tunjangan terakhir
					$lastTunjangan = $this->db->select('Kode_Tunjangan')
					->order_by('Kode_Tunjangan', 'DESC')
					->limit(1)
					->get('data_tunjangan')
					->row();

                    // Menghasilkan Kode Tunjangan baru
                    if ($lastTunjangan) {
                    $newKodeTunjangan = intval($lastTunjangan->Kode_Tunjangan) + 1;
                    } else {
                    $newKodeTunjangan = 1;
                    }


                    $data=array(
                        'Nama_Tunjangan'		=> $Nama_Tunjangan,
                        'Jumlah_Tunjangan'		=> $Jumlah_Tunjangan,
                        'Keterangan'		    => $Keterangan
                    );
        
                    $this->ModelPenggajian->insert_data($data,'data_tunjangan');
                    $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Data berhasil ditambahkan!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                    redirect('admin/Data_Tunjangan');
                }	
            }
        
            public function updatedata($id)
        {
                $where = array('Kode_Tunjangan' => $id);
                $data['tunjangan'] = $this->db->query("SELECT * FROM data_tunjangan
                    WHERE Kode_Tunjangan ='$id'")->result();
                $data['title'] = "Update Data Tunjangan";    
                $this->load->view('template_admin/header',$data);
                $this->load->view('template_admin/sidebar');
                $this->load->view('admin/updateDataTunjangan', $data);
                $this->load->view('template_admin/footer');
            }
        
            Public function updateDataAksi()
            {
                $this->_rules();
        
                if($this->form_validation->run() == FALSE) {
                    $id = $this->input->post('Kode_Tunjangan');
                    $this->updatedata($id);
                }else{
                    $id				    =$this->input->post('Kode_Tunjangan');
                    $Nama_Tunjangan	    =$this->input->post('Nama_Tunjangan');
                    $Jumlah_Tunjangan	=$this->input->post('Jumlah_Tunjangan');
                    $Keterangan		    =$this->input->post('Keterangan');
        
                    $data = array(
                        'Nama_Tunjangan'		=> $Nama_Tunjangan,
                        'Jumlah_Tunjangan'		=> $Jumlah_Tunjangan,
                        'Keterangan'		    => $Keterangan,
                    );
        
                    $where = array(
                        'Kode_Tunjangan' => $id
                    );
        
                    $this->ModelPenggajian->update_data('data_tunjangan',$data,$where);
                    $this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Data berhasil diupdate!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                    redirect('admin/Data_Tunjangan');
                }	
            }
        
                public function _rules()
                {
                    $this->form_validation->set_rules('Nama_Tunjangan',
                    'Nama_Tunjangan','required');
                    $this->form_validation->set_rules('Jumlah_Tunjangan',
                    'Jumlah_Tunjangan','required');
                    $this->form_validation->set_rules('Keterangan',
                    'Keterangan','required');
                }
                
                public function deletedata ($id)
                {
                    $where = array('Kode_Tunjangan' => $id);
                    $this->ModelPenggajian->delete_data($where, 'data_tunjangan');
                    $this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Data berhasil dihapus!</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                        </div>');
                    redirect('admin/Data_Tunjangan');
                }
        
            }
        ?>
        