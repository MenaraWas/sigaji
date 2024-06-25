<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
    </div>
    <a class="btn btn-sm btn-success mb-3" href="#" data-toggle="modal" data-target="#modalTambah"><i
            class="fas fa-plus"></i> Tambah Jabatan</a>
    <?php echo $this->session->flashdata('pesan')?>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Jabatan</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($jabatan as $j) : ?>
                        <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td class="text-center"><?php echo $j->nama_jabatan ?></td>

                            <td>
                                <center>
                                    <a class="btn btn-sm btn-info"
                                        href="<?php echo base_url('admin/data_jabatan/update_data/'.$j->id_jabatan) ?>"><i
                                            class="fas fa-edit"></i></a>
                                    <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger"
                                        href="<?php echo base_url('admin/data_jabatan/delete_data/'.$j->id_jabatan) ?>"><i
                                            class="fas fa-trash"></i></a>
                                </center>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!--Modal add Jabatan-->
<div class="modal fade bd-example-modal-lg" id="modalTambah" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Jabatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?php echo base_url('admin/data_jabatan/tambah_data_aksi')?>">
                    
                    <div class="form-group">
                        <label>Nama Jabatan</label>
                        <input type="text" name="nama_jabatan" class="form-control">
                        <?php echo form_error('nama_jabatan', '<div class="text-small text-danger"> </div>')?>
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