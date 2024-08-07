<?php

class Detail_Gaji extends CI_Controller {

    public function index() {
        $data['title'] = "Detail Gaji";

        // Ambil data dari model untuk formulir
        $data['gaji'] = $this->ModelPenggajian->get_data('data_gaji')->result();
        $data['tunjangan'] = $this->ModelPenggajian->get_data('data_tunjangan')->result();
        $data['bonus'] = $this->ModelPenggajian->get_data('data_bonus')->result();
        $data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')->result();
        $data['dg'] = $this->ModelPenggajian->get_data('detail_gaji')->result();
        $data['filter'] = $this->db->query("SELECT data_gaji.*, data_pegawai.nama_pegawai FROM data_gaji INNER JOIN data_pegawai ON data_pegawai.nip = data_gaji.nip  where id_tunjangan = 0")->result();
    
        // // Ambil nilai no_slip_gaji dari form
        // $no_slip_gaji = $this->input->post('no_slip_gaji');
    
        // // Ambil nip dari tabel data_gaji berdasarkan no_slip_gaji
        // $query_gaji = $this->db->get_where('data_gaji', array('no_slip_gaji' => $no_slip_gaji))->row();
        // $nip = $query_gaji ? $query_gaji->nip : '';
    
        // // Ambil alpha dari tabel data_kehadiran berdasarkan nip
        // $this->db->select('alpha');
        // $this->db->where('nip', $nip);
        // $data['filter_kehadiran'] = $this->db->get('data_kehadiran')->result();
        
//         $data['detail_gaji'] = $this->db->query('
//     SELECT 
//         detail_gaji.*, 
//         data_gaji.no_slip_gaji, 
//         data_tunjangan.Nama_Tunjangan, 
//         data_bonus.Nama_Bonus, 
//         potongan_gaji.potongan 
//     FROM 
//         detail_gaji 
//         INNER JOIN data_gaji ON detail_gaji.no_slip_gaji = data_gaji.no_slip_gaji 
//         INNER JOIN data_tunjangan ON detail_gaji.id_tunjangan = data_tunjangan.Kode_Tunjangan 
//         INNER JOIN data_bonus ON detail_gaji.id_bonus = data_bonus.Kode_Bonus
//         INNER JOIN potongan_gaji ON detail_gaji.id_potongan = potongan_gaji.id
//          WHERE data_gaji.id_tunjangan = 0
//     ORDER BY detail_gaji.id_detail_gaji ASC
// ')->result();


        $last_detail_query = $this->db->select('id_detail_gaji')->order_by('id_detail_gaji', 'DESC')->limit(1)->get('detail_gaji');
        if ($last_detail_query->num_rows() > 0) {
            $last_id = $last_detail_query->row()->id_detail_gaji;
            $data['next_id'] = $last_id + 1;
        } else {
            $data['next_id'] = 1;
        }

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/Detail_Gaji', $data);
        $this->load->view('template_admin/footer');
    }

    public function tambah_data() {
        $data['title'] = "Tambah Data Gaji Pegawai";
        $data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
        $data['tunjangan'] = $this->ModelPenggajian->get_data('data_tunjangan')->result();
        $data['bonus'] = $this->ModelPenggajian->get_data('data_bonus')->result();
        $data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')->result();

        $last_detail_query = $this->db->select('id_detail_gaji')->order_by('id_detail_gaji', 'DESC')->limit(1)->get('detail_gaji');
        if ($last_detail_query->num_rows() > 0) {
            $last_id = $last_detail_query->row()->id_detail_gaji;
            $data['next_id'] = $last_id + 1;
        } else {
            $data['next_id'] = 1;
        }

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/penggajian/tambah_gaji', $data);
        $this->load->view('template_admin/footer');
    }

    public function tambah_data_aksi() {
        $this->_rules();
    
        if($this->form_validation->run() == FALSE) {
            $this->tambah_data();
        } else {
            $id_detail = $this->input->post('id_detail');
            $no_slip_gaji = $this->input->post('no_slip_gaji');
            $id_tunjangan = $this->input->post('id_tunjangan');
            $id_potongan = $this->input->post('id_potongan');
            $id_bonus = $this->input->post('id_bonus');
            
    
            // Ambil tot_gapok dari tabel data_gaji berdasarkan no_slip_gaji
            $query_gaji = $this->db->get_where('data_gaji', array('no_slip_gaji' => $no_slip_gaji))->row();
    
            if ($query_gaji) {
                $tot_gapok = $query_gaji->tot_gapok;
                $nip = $query_gaji->nip;

                $this->db->select('alpha');
                $this->db->where('nip', $nip);
                $query_kehadiran = $this->db->get('data_kehadiran')->row();

                // Ambil nilai alpha
                $alpha = $query_kehadiran ? $query_kehadiran->alpha : 0;
                $total_potongan = $id_potongan*$alpha;
    
                // Hitung gaji kotor
                $gaji_kotor = $tot_gapok + $id_tunjangan + $id_bonus;
    
                // Hitung gaji bersih
                $gaji_bersih = $gaji_kotor - $total_potongan;
    
                // Data untuk tabel detail_gaji
                $data_detail_gaji = array(
                    'id_detail_gaji' => $id_detail,
                    'no_slip_gaji' => $no_slip_gaji,
                    'id_tunjangan' => $id_tunjangan,
                    'id_potongan' => $total_potongan,
                    'id_bonus' => $id_bonus,
                );
    
                // Simpan data ke dalam tabel detail_gaji
                $this->ModelPenggajian->insert_data($data_detail_gaji, 'detail_gaji');
    
                // Data untuk update ke data_gaji
                $data_to_gaji = array(
                    'id_tunjangan' => $id_tunjangan,
                    'id_potongan' => $total_potongan,
                    'id_bonus' => $id_bonus,
                    'gaji_kotor' => $gaji_kotor,
                    'gaji_bersih' => $gaji_bersih,
                );
    
                // Kondisi where untuk update data_gaji
                $where_gaji = array(
                    'no_slip_gaji' => $no_slip_gaji,
                );

                // Ambil tanggal dari data_gaji
                $tanggal_gaji = $query_gaji->tgl_gaji;


                 
                $data_jurnal = array();

                // Gaji Bersih 
                $data_jurnal[] = array(
                    'tanggal' => $tanggal_gaji,
                    'debit' => $gaji_bersih,
                    'keterangan' => 'Hutang Gaji',
                    'jenis' => 'Debit',
                );
                $data_jurnal[] = array(
                    'tanggal' => $tanggal_gaji,
                    'kredit' => $gaji_bersih,
                    'keterangan' => 'Kas',
                    'jenis' => 'Kredit',
                );
                // Simpan semua entri ke dalam tabel jurnal_umum
                foreach ($data_jurnal as $jurnal) {
                    $this->ModelPenggajian->insert_data($jurnal, 'jurnal_umum');
                }

                // Update data ke dalam tabel data_gaji
                $this->ModelPenggajian->update_data_to_gaji($data_to_gaji, 'data_gaji', $where_gaji);
    
                // Set flashdata untuk memberi notifikasi berhasil
                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil ditambahkan!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
    
                // Redirect ke halaman admin/Detail_Gaji setelah berhasil ditambahkan
                redirect('admin/Detail_Gaji');
            } else {
                // Handle jika data gaji tidak ditemukan
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data gaji tidak ditemukan!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');
    
                redirect('admin/Detail_Gaji');
            }
        }
    }
    

    public function _rules() {
        $this->form_validation->set_rules('no_slip_gaji', 'No Slip Gaji', 'required');
        $this->form_validation->set_rules('id_tunjangan', 'Tunjangan', 'required');
        $this->form_validation->set_rules('id_potongan', 'Potongan', 'required');
        $this->form_validation->set_rules('id_bonus', 'Bonus', 'required');
    }

    public function update_data($id) {
        $data['title'] = "Update Data Gaji Pegawai";
        $data['pegawai'] = $this->ModelPenggajian->get_data('data_pegawai')->result();
        $data['tunjangan'] = $this->ModelPenggajian->get_data('data_tunjangan')->result();
        $data['bonus'] = $this->ModelPenggajian->get_data('data_bonus')->result();
        $data['potongan'] = $this->ModelPenggajian->get_data('potongan_gaji')->result();
        $data['detail_gaji'] = $this->db->query("SELECT * FROM detail_gaji WHERE id_detail_gaji='$id'")->row();
        // $data['detail_gaji'] = $this->ModelPenggajian->get_data_by_id('detail_gaji', 'id_detail_gaji', $id)->row();

        $this->load->view('template_admin/header', $data);
        $this->load->view('template_admin/sidebar');
        $this->load->view('admin/penggajian', $data);
        $this->load->view('template_admin/footer');
    }

    public function update_data_aksi() {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update_data($this->input->post('id_detail'));
        } else {
            $id_detail = $this->input->post('id_detail');
            $no_slip_gaji = $this->input->post('no_slip_gaji');
            $id_tunjangan = $this->input->post('id_tunjangan');
            $id_potongan = $this->input->post('id_potongan');
            $id_bonus = $this->input->post('id_bonus');

            $query_gaji = $this->db->get_where('data_gaji', array('no_slip_gaji' => $no_slip_gaji))->row();

            if ($query_gaji) {
                $tot_gapok = $query_gaji->tot_gapok;
                $nip = $query_gaji->nip;

                $this->db->select('alpha');
                $this->db->where('nip', $nip);
                $query_kehadiran = $this->db->get('data_kehadiran')->row();

                $alpha = $query_kehadiran ? $query_kehadiran->alpha : 0;
                $total_potongan = $id_potongan * $alpha;

                $gaji_kotor = $tot_gapok + $id_tunjangan + $id_bonus;
                $gaji_bersih = $gaji_kotor - $total_potongan;

                $data_detail_gaji = array(
                    'no_slip_gaji' => $no_slip_gaji,
                    'id_tunjangan' => $id_tunjangan,
                    'id_potongan' => $total_potongan,
                    'id_bonus' => $id_bonus,
                );

                $where_detail = array('id_detail_gaji' => $id_detail);
                
                $this->ModelPenggajian->update_data('detail_gaji', $data_detail_gaji, $where_detail);

                $data_to_gaji = array(
                    'id_tunjangan' => $id_tunjangan,
                    'id_potongan' => $total_potongan,
                    'id_bonus' => $id_bonus,
                    'gaji_kotor' => $gaji_kotor,
                    'gaji_bersih' => $gaji_bersih,
                );

                $where_gaji = array('no_slip_gaji' => $no_slip_gaji);
                $this->ModelPenggajian->update_data('data_gaji', $data_to_gaji, $where_gaji);

                $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Data berhasil diupdate!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');

                redirect('admin/Detail_Gaji');
            } else {
                $this->session->set_flashdata('pesan', '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Data gaji tidak ditemukan!</strong>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                    </div>');

                redirect('admin/Detail_Gaji');
            }
        }
    }

    public function delete_data($id) {
        $where = array('id_detail_gaji' => $id);
        $this->ModelPenggajian->delete_data($where, 'detail_gaji');

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Data berhasil dihapus!</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');

        redirect('admin/Detail_Gaji');
    }
}
?>
