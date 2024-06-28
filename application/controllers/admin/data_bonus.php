<?php

class data_bonus extends CI_Controller{

public function index()
{
        $data['title'] = "Data Bonus";    
		$data['bonus'] = $this->ModelPenggajian->get_data('data_bonus')   
			->result();	
		$this->load->view('template_admin/header',$data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/data_bonus', $data);
		$this->load->view('template_admin/footer');
	}

	public function tambahdata()
{
        $data['title'] = "Tambah Data Bonus";   
		
		
    // Mendapatkan Kode Bonus terakhir
    $lastBonus = $this->db->select('Kode_Bonus')
                          ->order_by('Kode_Bonus', 'DESC')
                          ->limit(1)
                          ->get('data_bonus')
                          ->row();

    // Menghasilkan Kode Bonus baru
    if ($lastBonus) {
        $data['newKodeBonus'] = intval($lastBonus->Kode_Bonus) + 1;
    } else {
        $data['newKodeBonus'] = 1;
    }


		$data['bonus'] = $this->ModelPenggajian->get_data('data_bonus')  
			->result();	
		$this->load->view('template_admin/header',$data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/formDataBonus', $data);
		$this->load->view('template_admin/footer');
	}

	Public function tambahDataAksi()
	{
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->tambahdata();
		}else{
			$Nama_Bonus		=$this->input->post('Nama_Bonus');
			$Jumlah_Bonus	=$this->input->post('Jumlah_Bonus');
			$Keterangan		=$this->input->post('Keterangan');

			        // Mendapatkan Kode Bonus terakhir
					$lastBonus = $this->db->select('Kode_Bonus')
					->order_by('Kode_Bonus', 'DESC')
					->limit(1)
					->get('data_bonus')
					->row();

				// Menghasilkan Kode Bonus baru
				if ($lastBonus) {
				$newKodeBonus = intval($lastBonus->Kode_Bonus) + 1;
				} else {
				$newKodeBonus = 1;
				}


			$data=array(
				'Kode_Bonus' 		=> $newKodeBonus,
				'Nama_Bonus'		=> $Nama_Bonus,
				'Jumlah_Bonus'		=> $Jumlah_Bonus,
				'Keterangan'		=> $Keterangan
			);

			$this->ModelPenggajian->insert_data($data,'data_bonus');
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil ditambahkan!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_bonus');
		}	
	}

	public function updatedata($id)
{
		$where = array('Kode_Bonus' => $id);
		$data['bonus'] = $this->db->query("SELECT * FROM data_bonus
			WHERE Kode_Bonus ='$id'")->result();
        $data['title'] = "Update Data Bonus";    
		$this->load->view('template_admin/header',$data);
		$this->load->view('template_admin/sidebar');
		$this->load->view('admin/updateDataBonus', $data);
		$this->load->view('template_admin/footer');
	}

	Public function updateDataAksi()
	{
		$this->_rules();

		if($this->form_validation->run() == FALSE) {
			$this->updatedata();
		}else{
			$id				=$this->input->post('Kode_Bonus');
			$Nama_Bonus		=$this->input->post('Nama_Bonus');
			$Jumlah_Bonus	=$this->input->post('Jumlah_Bonus');
			$Keterangan		=$this->input->post('Keterangan');

			$data = array(
				'Nama_Bonus'		=> $Nama_Bonus,
				'Jumlah_Bonus'		=> $Jumlah_Bonus,
				'Keterangan'		=> $Keterangan,
			);

			$where = array(
				'Kode_Bonus' => $id
			);

			$this->ModelPenggajian->update_data('data_bonus',$data,$where);
			$this->session->set_flashdata('pesan','<div class="alert alert-success alert-dismissible fade show" role="alert">
				<strong>Data berhasil diupdate!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_bonus');
		}	
	}

		public function _rules()
		{
			$this->form_validation->set_rules('Nama_Bonus',
			'Nama_Bonus','required');
			$this->form_validation->set_rules('Jumlah_Bonus',
			'Jumlah_Bonus','required');
			$this->form_validation->set_rules('Keterangan',
			'Keterangan','required');
		}
		
		public function deletedata ($id)
		{
			$where = array('Kode_Bonus' => $id);
			$this->ModelPenggajian->delete_data($where, 'data_bonus');
			$this->session->set_flashdata('pesan','<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>Data berhasil dihapus!</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				</div>');
			redirect('admin/data_bonus');
		}

	}
?>
