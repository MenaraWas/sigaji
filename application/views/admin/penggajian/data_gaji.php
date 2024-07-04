<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
    </div>
    <a class="btn btn-sm btn-success mb-3" href="#" data-toggle="modal" data-target="#modalTambah"><i
            class="fas fa-plus"></i> Tambah Data Gaji</a>
            <a class="btn btn-sm btn-primary mb-3" href="#" data-toggle="modal" data-target="#inputBulanModal">Input data ke Jurnal Umum</a>

    <?php echo $this->session->flashdata('pesan')?>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4"> 
        <div class="card-body">
            <form method="GET" class="mb-3" action="<?php echo base_url('admin/input_gaji'); ?>">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Nama Pegawai</label>
                        <select name="nip" class="form-control">
                            <option value="">-- Pilih Nama Pegawai --</option>
                            <?php foreach($pegawai as $p): ?>
                                <option value="<?php echo $p->nip; ?>" <?php echo ($this->input->get('nip') == $p->nip) ? 'selected' : ''; ?>>
                                    <?php echo $p->nama_pegawai; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Bulan</label>
                        <div class="col-sm-9">
                        <select class="form-control" name="bulan">
                            <option value=""> Pilih Bulan </option>
                            <option value="01" <?php echo ($this->input->get('bulan') == '01') ? 'selected' : ''; ?>>Januari</option>
                            <option value="02" <?php echo ($this->input->get('bulan') == '02') ? 'selected' : ''; ?>>Februari</option>
                            <option value="03" <?php echo ($this->input->get('bulan') == '03') ? 'selected' : ''; ?>>Maret</option>
                            <option value="04" <?php echo ($this->input->get('bulan') == '04') ? 'selected' : ''; ?>>April</option>
                            <option value="05" <?php echo ($this->input->get('bulan') == '05') ? 'selected' : ''; ?>>Mei</option>
                            <option value="06" <?php echo ($this->input->get('bulan') == '06') ? 'selected' : ''; ?>>Juni</option>
                            <option value="07" <?php echo ($this->input->get('bulan') == '07') ? 'selected' : ''; ?>>Juli</option>
                            <option value="08" <?php echo ($this->input->get('bulan') == '08') ? 'selected' : ''; ?>>Agustus</option>
                            <option value="09" <?php echo ($this->input->get('bulan') == '09') ? 'selected' : ''; ?>>September</option>
                            <option value="10" <?php echo ($this->input->get('bulan') == '10') ? 'selected' : ''; ?>>Oktober</option>
                            <option value="11" <?php echo ($this->input->get('bulan') == '11') ? 'selected' : ''; ?>>November</option>
                            <option value="12" <?php echo ($this->input->get('bulan') == '12') ? 'selected' : ''; ?>>Desember</option>
                        </select>
                        </div>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Status Pengajuan</label>
                        <select name="status_pengajuan" class="form-control">
                            <option value="">-- Pilih Status --</option>
                            <option value="Proses" <?php echo ($this->input->get('status_pengajuan') == 'Proses') ? 'selected' : ''; ?>>Proses</option>
                            <option value="Diterima" <?php echo ($this->input->get('status_pengajuan') == 'Diterima') ? 'selected' : ''; ?>>Disetujui</option>
                            <option value="Ditolak" <?php echo ($this->input->get('status_pengajuan') == 'Ditolak') ? 'selected' : ''; ?>>Ditolak</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="<?php echo base_url('admin/input_gaji'); ?>" class="btn btn-secondary">Reset</a>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">No Slip Gaji</th>
                            <th class="text-center">NIP</th>
                            <th class="text-center">Nama Pegawai</th>
                            <th class="text-center">Tanggal Gaji</th>
                            <th class="text-center">Gaji Pokok</th> 
                            <th class="text-center">Total Tunjangan</th>
                            <th class="text-center">Total Potongan</th>
                            <th class="text-center">Total Bonus</th>
                            <th class="text-center">Gaji Kotor</th>
                            <th class="text-center">Gaji Bersih</th>
                            <th class="text-center">Total Presensi</th>
                            <th class="text-center">Status Pengajuan</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead> 
                    <tbody> 
                        <?php $no=1; foreach($gaji as $p) : ?>
                        <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td class="text-center"><?php echo $p->no_slip_gaji ?></td>
                            <td class="text-center"><?php echo $p->nip ?></td>
                            <td class="text-center"><?php echo $p->nama_pegawai ?></td>
                            <td class="text-center"><?php echo $p->tgl_gaji ?></td>
                            <td class="text-center"><?php echo $p->tot_gapok ?></td>
                            <td class="text-center">Rp. <?php echo number_format($p->id_tunjangan,0,',','.') ?></td>
                            <td class="text-center">Rp. <?php echo number_format($p->id_potongan,0,',','.') ?></td>
                            <td class="text-center">Rp. <?php echo number_format($p->id_bonus,0,',','.') ?></td>
                            <td class="text-center">Rp. <?php echo number_format($p->gaji_kotor,0,',','.') ?></td>
                            <td class="text-center">Rp. <?php echo number_format($p->gaji_bersih,0,',','.') ?></td>
                            
                            <td class="text-center">
                                <?php echo "Hadir: " . $p->hadir . ", Sakit: " . $p->sakit . ", Ijin: " . $p->ijin . ", Alpha: " . $p->alpha; ?>
                            </td>
                            <td class="text-center">
                                <?php 
                                    if ($p->status_pengajuan == 'Diterima') {
                                        echo '<span class="label-approve">Disetujui</span>';
                                    } elseif ($p->status_pengajuan == 'Proses') {
                                        echo '<span class="label-process">Proses</span>';
                                    } elseif ($p->status_pengajuan == 'Ditolak') {
                                        echo '<span class="label-reject">Ditolak</span>';
                                    } else {
                                        echo '<span class="label-default">'.$p->status_pengajuan.'</span>';
                                    }
                                ?>
                            </td>
                            <td>
                                <center>
                                <button class="btn btn-sm btn-info" data-toggle="modal"
                                        data-target="#modal_edit_user_<?php echo $p->nip; ?>"><i
                                            class="fas fa-edit"></i></button>

                                    <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger"
                                        href="<?php echo base_url('admin/input_gaji/delete_data/'.$p->nip) ?>"><i
                                            class="fas fa-trash"></i></a>
                                </center>
                            </td>
                        </tr>

                       <!-- Modal Edit Jurnal Umum -->
    <div class="modal fade" id="modal_edit_user_<?php echo $p->nip; ?>" tabindex="-1"
        role="dialog" aria-labelledby="modal_edit_user_<?php echo $p->nip; ?>"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_edit_jurnalLabel_<?php echo $p->nip; ?>">
                        Edit Gaji <?php echo $p->nama_pegawai; ?>
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="post" action="<?php echo base_url('admin/input_gaji/update_data_aksi'); ?>">
                        <div class="form-group">
                            <label for="nip">NIP</label>
                            <input type="text" class="form-control" id="nip" name="nip"
                                value="<?php echo $p->nip; ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="gapok">Gaji Pokok</label>
                            <input type="text" class="form-control" id="gapok" name="gapok"
                                value="<?php echo $p->tot_gapok; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalTambah" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Isi modal -->
                <form method="POST" action="<?php echo base_url('admin/input_gaji/tambah_data_aksi')?>"
                    enctype="multipart/form-data">
                    <!-- Form input -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>No Slip Gaji</label>
                            <input type="text" name="no_slip_gaji" class="form-control"
                                value="<?php echo $next_no_slip; ?>" readonly>
                            <?php echo form_error('no_slip_gaji', '<div class="text-small text-danger"> </div>')?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Gajian</label>
                            <input type="date" name="tgl_gajian" class="form-control">
                            <?php echo form_error('tgl_gajian', '<div class="text-small text-danger"> </div>')?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Nama Pegawai</label>
                            <select name="nip" class="form-control">
                                <?php foreach($pegawai as $p): ?>
                                <option value="<?php echo $p->nip; ?>"><?php echo $p->nama_pegawai; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php echo form_error('nip', '<div class="text-small text-danger"> </div>')?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- Tombol simpan -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Editing Data -->
<div class="modal fade bd-example-modal-lg" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Isi modal -->
                <form method="POST" action="<?php echo base_url('admin/input_gaji/edit_data_aksi')?>" enctype="multipart/form-data">
                    <!-- Form input -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>NIP</label>
                            <input type="text" name="nip" class="form-control" value="<?php echo set_value('nip', $gaji->nip); ?>" readonly>
                            <?php echo form_error('nip', '<div class="text-small text-danger"> </div>')?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nomor Gaji</label>
                            <input type="text" name="nomor_gaji" class="form-control" value="<?php echo set_value('nomor_gaji', $gaji->nomor_gaji); ?>">
                            <?php echo form_error('nomor_gaji', '<div class="text-small text-danger"> </div>')?>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Gaji Pokok</label>
                            <input type="text" name="gaji_pokok" class="form-control" value="<?php echo set_value('gaji_pokok', $gaji->gaji_pokok); ?>">
                            <?php echo form_error('gaji_pokok', '<div class="text-small text-danger"> </div>')?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Catatan</label>
                            <textarea name="catatan" class="form-control"><?php echo set_value('catatan', $gaji->catatan); ?></textarea>
                            <?php echo form_error('catatan', '<div class="text-small text-danger"> </div>')?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- Tombol simpan -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="inputBulanModal" tabindex="-1" role="dialog" aria-labelledby="inputBulanModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="inputBulanModalLabel">Input Bulan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="bulanForm" action="<?= base_url('admin/input_gaji/input_ke_jurnal') ?>" method="post">
          <div class="form-group">
            <label for="bulanInput">Bulan</label>
            <input type="month" class="form-control" id="bulanInput" name="bulan" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="bulanForm" class="btn btn-primary">Submit</button>
      </div>
    </div>
  </div>
</div>
