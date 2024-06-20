<?php
Class ModelPotongan_Gaji extends CI_Model
{
  function TampilPotongan() 
    {
        $this->db->order_by('id', 'ASC');
        return $this->db->from('potongan_gaji')
          ->get()
          ->result();
    }

    function Getpotongan($potongan = '')
    {
      return $this->db->get_where('potongan_gaji', array('potongan' => $potongan))->row();
    }
    function HapusPotongan($potongan)
    {
        $this->db->delete('potongan_gaji',array('potongan' => $potongan));
    }
    
    public function get_last_id() {
      $this->db->select('id');
      $this->db->order_by('id', 'DESC');
      $this->db->limit(1);
      $query = $this->db->get('potongan_gaji');
      if ($query->num_rows() > 0) {
          return $query->row()->id;
      } else {
          return 0;
      }
  }
    
}