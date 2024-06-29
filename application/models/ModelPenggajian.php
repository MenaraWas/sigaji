<?php

class ModelPenggajian extends CI_model{

	public function get_data($table) {
		return $this->db->get($table);
	}

	public function insert_data($data,$table){
		$this->db->insert($table, $data);
	}

    public function insert_data_to_user($data_to_user, $table){
        $this->db->insert($table, $data_to_user);
    }
    public function update_data_to_pegawai($data_to_pegawai, $table, $whare){
        $this->db->update($table, $data_to_pegawai, $whare);
    }
    public function update_data_to_gaji($data_to_gaji, $table, $whare){
        $this->db->update($table, $data_to_gaji, $whare);
    }

    public function update_data_to_user($table, $data, $whare){
		$this->db->update($table, $data, $whare);
	}

	public function update_data($table, $data, $whare){
		$this->db->update($table, $data, $whare);
	}

	public function delete_data($whare,$table){
		$this->db->where($whare);
		$this->db->delete($table);
	}

	public function insert_batch($table = null, $data = array()) {
		$jumlah = count($data);
		if ($jumlah > 0) {
			$this->db->insert_batch($table, $data);
		}
	}

	public function cek_login($email, $password)
{
    $result = $this->db->where('email', $email)
                        ->where('password', md5($password))
                        ->limit(1)
                        ->get('data_pegawai');
    if($result->num_rows() > 0) {
        return $result->row();
    } else {
        return FALSE;
    }
}


public function get_kehadiran_gaji_pegawai($nip) {
    $this->db->select('data_pegawai.nip, data_pegawai.nama_pegawai, data_kehadiran.hadir, data_kehadiran.alpha, data_kehadiran.sakit, data_gaji.*');
    $this->db->from('data_pegawai');
    $this->db->join('data_kehadiran', 'data_pegawai.nip = data_kehadiran.nip');
    $this->db->join('data_gaji', 'data_kehadiran.id = data_gaji.id_presensi');
    $this->db->where('data_pegawai.nip', $nip);
    $query = $this->db->get();
    return $query->result();
}


public function cek_login_user_only($email, $password)
{
    $result = $this->db->where('email', $email)
                        ->where('password', md5($password))
                        ->limit(1)
                        ->get('data_user');
    if($result->num_rows() > 0) {
        return $result->row();
    } else {
        return FALSE;
    }
}



}

?>