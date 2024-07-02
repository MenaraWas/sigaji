<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    </div>
    <a class="btn btn-sm btn-success mb-3" href="#" data-toggle="modal" data-target="#modalTambah"><i
            class="fas fa-plus"></i> Tambah Detail Gaji</a>
    <?php echo $this->session->flashdata('pesan'); ?>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">ID Detail Gaji</th>
                            <th class="text-center">No Slip Gaji</th>
                            <th class="text-center">Tunjangan</th>
                            <th class="text-center">Potongan</th>
                            <th class="text-center">Bonus</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; foreach ($dg as $p) : ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td class="text-center"><?php echo $p->id_detail_gaji ?></td>
                            <td class="text-center"><?php echo $p->no_slip_gaji; ?></td>
                            <td class="text-center">Rp. <?php echo number_format($p->id_tunjangan,0,',','.') ?></td>
                            <td class="text-center">Rp. <?php echo number_format($p->id_potongan,0,',','.') ?></td>
                            <td class="text-center">Rp. <?php echo number_format($p->id_bonus,0,',','.') ?></td>
                            <td class="text-center">
                                <a class="btn btn-sm btn-info" data-toggle="modal"
                                    data-target="#modalUpdate<?php echo $p->no_slip_gaji; ?>">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a class="btn btn-sm btn-danger"
                                    href="<?php echo base_url('admin/detail_gaji/delete_data/'.$p->id_detail_gaji); ?>"
                                    onclick="return confirm('Yakin ingin menghapus data?');">
                                    <i class="fas fa-trash"></i>
                                </a>

                                <!-- Modal -->
                                <div class="modal fade" id="modalUpdate<?php echo $p->no_slip_gaji; ?>" tabindex="-1"
                                    role="dialog" aria-labelledby="modalUpdateLabel<?php echo $p->no_slip_gaji; ?>"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="modalUpdateLabel<?php echo $p->no_slip_gaji; ?>">Update Detail
                                                    Gaji</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <?php echo form_open('admin/detail_gaji/update_data_aksi'); ?>

                                                <div class="form-group">
                                                    <label>ID Detail Gaji</label>
                                                    <input type="number" name="id_detail" class="form-control"
                                                        value="<?php echo $p->id_detail_gaji; ?>" readonly>
                                                    <?php echo form_error('id_detail', '<div class="text-small text-danger"> </div>')?>
                                                </div>

                                                <div class="form-group">
                                                    <label>No Slip Gaji</label>
                                                    <input type="number" name="no_slip_gaji" class="form-control"
                                                        value="<?php echo $p->no_slip_gaji; ?>" readonly>
                                                    <?php echo form_error('no_slip_gaji', '<div class="text-small text-danger"> </div>')?>
                                                </div>

                                                <div class="form-group">
                                                    <label>Tunjangan</label>
                                                    <select name="id_tunjangan" class="form-control">
                                                        <option value="">--Pilih Tunjangan--</option>
                                                        <?php foreach ($tunjangan as $t) : ?>
                                                        <option value="<?php echo $t->Jumlah_Tunjangan; ?>">
                                                            <?php echo $t->Nama_Tunjangan; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?php echo form_error('id_tunjangan', '<div class="text-small text-danger"> </div>')?>
                                                </div>

                                                <div class="form-group">
                                                    <label>Potongan Gaji</label>
                                                    <select id="id_potongan" name="id_potongan" class="form-control"
                                                        onchange="calculatePotongan()">
                                                        <option value="">--Pilih Potongan Gaji--</option>
                                                        <?php foreach ($potongan as $p) : ?>
                                                        <option value="<?php echo $p->jml_potongan; ?>">
                                                            <?php echo $p->potongan; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <div class="form-group">
                                                    <label>Total Potongan</label>
                                                    <input type="text" id="total_potongan" name="total_potongan"
                                                        class="form-control" readonly>
                                                </div>

                                                <script>
                                                function calculatePotongan() {
                                                    var potonganGaji = document.getElementById('id_potongan').value;
                                                    document.getElementById('total_potongan').value = potonganGaji;
                                                }
                                                </script>


                                                <div class="form-group">
                                                    <label>Bonus</label>
                                                    <select name="id_bonus" class="form-control">
                                                        <option value="">--Pilih Bonus--</option>
                                                        <?php foreach ($bonus as $b) : ?>
                                                        <option value="<?php echo $b->Jumlah_Bonus; ?>">
                                                            <?php echo $b->Nama_Bonus; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <?php echo form_error('id_bonus', '<div class="text-small text-danger"> </div>')?>
                                                </div>

                                                <button type="button" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Save</button>

                                                <?php echo form_close(); ?>
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

<!-- Modal Tambah Detail Gaji -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Detail Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('admin/detail_gaji/tambah_data_aksi'); ?>

                <div class="form-group">
                    <label>ID Detail Gaji</label>
                    <input type="number" name="id_detail" class="form-control" value="<?php echo $next_id; ?>" readonly>
                    <?php echo form_error('id_detail', '<div class="text-small text-danger"> </div>')?>
                </div>

                <div class="form-group">
                    <label>Pegawai</label>
                    <select name="no_slip_gaji" class="form-control">
                        <option value="">--Pilih Nama Pegawai--</option>
                        <?php foreach ($filter as $p) : ?>
                        <option value="<?php echo $p->no_slip_gaji; ?>"><?php echo $p->nama_pegawai; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('no_slip_gaji', '<div class="text-small text-danger"> </div>')?>
                </div>


                <div class="form-group">
                    <label>Tunjangan</label>
                    <select name="id_tunjangan" class="form-control">
                        <option value="">--Pilih Tunjangan--</option>
                        <?php foreach ($tunjangan as $t) : ?>
                        <option value="<?php echo $t->Jumlah_Tunjangan; ?>"><?php echo $t->Nama_Tunjangan; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('id_tunjangan', '<div class="text-small text-danger"> </div>')?>
                </div>

                <div class="form-group">
                    <label>Potongan Gaji</label>
                    <select id="id_potongan" name="id_potongan" class="form-control" onchange="calculatePotongan()">
                        <option value="">--Pilih Potongan Gaji--</option>
                        <?php foreach ($potongan as $p) : ?>
                        <option value="<?php echo $p->jml_potongan; ?>"><?php echo $p->potongan; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label>Bonus</label>
                    <select name="id_bonus" class="form-control">
                        <option value="">--Pilih Bonus--</option>
                        <?php foreach ($bonus as $b) : ?>
                        <option value="<?php echo $b->Jumlah_Bonus; ?>"><?php echo $b->Nama_Bonus; ?></option>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('id_bonus', '<div class="text-small text-danger"> </div>')?>
                </div>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>