<?php

class Detail_Gaji extends CI_Controller{

    public function index()
    {
            $data['title'] = "Detail Gaji";        
            $this->load->view('template_admin/header',$data);
            $this->load->view('template_admin/sidebar');
            $this->load->view('admin/Detail_Gaji', $data);
            $this->load->view('template_admin/footer');
        }
}
?>