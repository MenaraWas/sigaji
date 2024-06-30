<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title; ?></h1>
    </div>
    <a class="btn btn-sm btn-success mb-3" href="#" data-toggle="modal" data-target="#modalTambah"><i
            class="fas fa-plus"></i> Tambah User</a>
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
                            <th class="text-center">ID User</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php $no = 1; foreach ($user as $p) : ?>
                        <tr>
                            <td class="text-center"><?php echo $no++; ?></td>
                            <td class="text-center"><?php echo $p->nip ?></td>
                            <td class="text-center"><?php echo $p->email; ?></td>
                            <td class="text-center"><?php echo $p->Level; ?></td>
                            <td>
                                <center>
                                    <button class="btn btn-sm btn-info" data-toggle="modal"
                                        data-target="#modal_edit_user_<?php echo $p->id_user; ?>"><i
                                            class="fas fa-edit"></i></button>
                                            <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger"
    href="<?php echo base_url('admin/data_user/delete_data/'.$p->nip) ?>"><i class="fas fa-trash"></i></a>

                                </center>
                            </td>
                        </tr>

                        <!-- Modal Edit Jurnal Umum -->
                        <div class="modal fade" id="modal_edit_user_<?php echo $p->id_user; ?>" tabindex="-1"
                            role="dialog" aria-labelledby="modal_edit_user_<?php echo $p->id_user; ?>"
                            aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title"
                                            id="modal_edit_jurnalLabel_<?php echo $p->id_user; ?>">Edit User
                                        </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form method="post"
                                            action="<?php echo base_url('admin/data_user/update_data_aksi'); ?>">
                                            <input type="hidden" name="id_jurnal" value="<?php echo $p->id_user; ?>">
                                            <div class="form-group">
                                                <label for="tanggal">NIP</label>
                                                <input type="text" class="form-control" id="tanggal" name="nip"
                                                    value="<?php echo $p->nip; ?>">
                                            </div>
                                            <div class="form-group">
                                                <label for="hak_akses">Level</label>
                                                <select name="hak_akses" class="form-control">
                                                    <?php foreach ($hak_akses as $ha): ?>
                                                    <option value="<?php echo $ha->hak_akses; ?>"><?php echo $ha->keterangan; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" class="form-control" value="<?php echo $p->email; ?>">
                                            </div>

                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" class="form-control" value="<?php echo $p->password; ?>">
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

<!-- Modal Tambah User -->
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalTambahLabel">Tambah User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <?php echo form_open('admin/data_user/tambah_data_aksi'); ?>

                <div class="form-group">
                    <label for="nip">ID User</label>
                    <select name="nip" class="form-control">
                        <?php foreach ($filter as $p): ?>
                        <option value="<?php echo $p->nip; ?>"><?php echo $p->nip; ?> - <?php echo $p->nama_pegawai; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="">
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" value="">
                </div>

                <div class="form-group">
                    <label for="hak_akses">Level</label>
                    <select name="hak_akses" class="form-control">
                        <?php foreach ($hak_akses as $ha): ?>
                        <option value="<?php echo $ha->hak_akses; ?>"><?php echo $ha->keterangan; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>

                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>