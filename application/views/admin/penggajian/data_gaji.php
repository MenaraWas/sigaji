<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title ?></h1>
    </div>
    <a class="btn btn-sm btn-success mb-3" href="#" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah Data Gaji</a>
    <?php echo $this->session->flashdata('pesan') ?>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
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
                            <th class="text-center">Total Bonus</th>
                            <th class="text-center">Total Potongan</th>
                            <th class="text-center">Gaji Kotor</th>
                            <th class="text-center">Gaji Bersih</th>
                            <th class="text-center">Total Presensi</th>
                            <th class="text-center">Status Pengajuan</th>
                            <th class="text-center">Catatan</th>
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
                            <td class="text-center"><?php echo date('d-m-Y', strtotime($p->tgl_gajian)) ?></td>
                            <td class="text-right"><?php echo number_format($p->gaji_pokok, 0, ',', '.') ?></td>
                            <td class="text-right"><?php echo number_format($p->Jumlah_Tunjangan, 0, ',', '.') ?></td>
                            <td class="text-right"><?php echo number_format($p->Jumlah_Bonus, 0, ',', '.') ?></td>
                            <td class="text-right"><?php echo number_format($p->jml_potongan, 0, ',', '.') ?></td>
                            <td class="text-right"><?php echo 'Rp. ' . number_format($p->gaji_pokok + $p->jumlah_tunjangan + $p->jumlah_bonus, 0, ',', '.') ?></td>
                            <td class="text-right"><?php echo 'Rp. ' . number_format($p->gaji_pokok + $p->jumlah_tunjangan + $p->jumlah_bonus - $p->jml_potongan, 0, ',', '.') ?></td>
                            <td class="text-center"><?php echo "Hadir: " . $p->hadir . ", Sakit: " . $p->sakit . ", Alpha: " . $p->alpha ?></td>
                            <td class="text-center"><?php echo $p->status_pengajuan ?></td>
                            <td class="text-center"><?php echo $p->catatan ?></td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/input_gaji/update_data/'.$p->nip) ?>"><i class="fas fa-edit"></i></a>
                                <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/input_gaji/delete_data/'.$p->nip) ?>"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url('admin/input_gaji/tambah_data_aksi') ?>" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>No Slip Gaji</label>
                            <input type="text" name="no_slip_gaji" class="form-control" value="<?php echo $next_no_slip; ?>" readonly>
                            <?php echo form_error('no_slip_gaji', '<div class="text-small text-danger">', '</div>') ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tanggal Gajian</label>
                            <input type="date" name="tgl_gajian" class="form-control">
                            <?php echo form_error('tgl_gajian', '<div class="text-small text-danger">', '</div>') ?>
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
                            <?php echo form_error('nip', '<div class="text-small text-danger">', '</div>') ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>