<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
    </div>
    <a class="btn btn-sm btn-success mb-3" href="#" data-toggle="modal" data-target="#modalTambah"><i
            class="fas fa-plus"></i> Tambah Pegawai</a>
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
                            <th class="text-center">NIP</th>
                            <th class="text-center">Nama Pegawai</th>
                            <th class="text-center">Jabatan</th>
                            <th class="text-center">Gaji</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">No. Telp</th>
                            <th class="text-center">Tanggal Lahir</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($pegawai as $p) : ?>
                        <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td class="text-center"><?php echo $p->nip ?></td>
                            <td class="text-center"><?php echo $p->nama_pegawai ?></td>
                            <td class="text-center"><?php echo $p->jabatan ?></td>
                            <td class="text-center"><?php echo $p->gaji_pokok ?></td>
                            <td class="text-center"><?php echo $p->alamat ?></td>
                            <td class="text-center"><?php echo $p->no_telp ?></td>
                            <td class="text-center"><?php echo $p->tgl_lahir ?></td>
                            

                            <td>
                                <center>
                                    <a class="btn btn-sm btn-info"
                                        href="<?php echo base_url('admin/data_pegawai/update_data/'.$p->nip) ?>"><i
                                            class="fas fa-edit"></i></a>
                                    <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger"
                                        href="<?php echo base_url('admin/data_pegawai/delete_data/'.$p->nip) ?>"><i
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

<!--Modal-->
<div class="modal fade bd-example-modal-lg" id="modalTambah" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Isi modal -->
                <form method="POST" action="<?php echo base_url('admin/data_pegawai/tambah_data_aksi')?>"
                    enctype="multipart/form-data"> 
                    <!-- Form input -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>NIP</label>
                            <input type="number" name="nip" class="form-control" value="<?php echo $next_nip; ?>"
                                readonly>
                            <?php echo form_error('nip', '<div class="text-small text-danger"> </div>')?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nama Pegawai</label>
                            <input type="text" name="nama_pegawai" class="form-control">
                            <?php echo form_error('nama_pegawai', '<div class="text-small text-danger"> </div>')?>
                        </div>
                    </div>

                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>No. Telpon</label>
                            <input type="text" name="no_telp" class="form-control">
                            <?php echo form_error('no_telp', '<div class="text-small text-danger"> </div>')?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Gaji</label>
                            <input type="text" name="gaji_pokok" class="form-control">
                            <?php echo form_error('gaji_pokok', '<div class="text-small text-danger"> </div>')?>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Alamat</label>
                            <input type="text" name="alamat" class="form-control">
                            <?php echo form_error('alamat', '<div class="text-small text-danger"> </div>')?>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Jenis Kelamin</label>
                            <select name="jenis_kelamin" class="form-control">
                                <option value="">--Pilih Jenis Kelamin--</option>
                                <option value="Laki-Laki">Laki-Laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                            <?php echo form_error('jenis_kelamin', '<div class="text-small text-danger"> </div>')?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Jabatan</label>
                            <select name="jabatan" class="form-control">
                                <option value="">--Pilih Jabatan--</option>
                                <?php foreach($jabatan as $j) :?>
                                <option value="<?php echo $j->nama_jabatan ?>"><?php echo $j->nama_jabatan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Tanggal Lahir</label>
                            <input type="date" name="tgl_lahir" class="form-control">
                            <?php echo form_error('tgl_lahir', '<div class="text-small text-danger"> </div>')?>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="">--Pilih Status--</option>
                                <option value="Karyawan Tetap">Karyawan Tetap</option>
                                <option value="Karyawan Tidak Tetap">Karyawan Tidak Tetap</option>
                            </select>
                            <?php echo form_error('status', '<div class="text-small text-danger"> </div>')?>
                        </div>
                    </div>

                    <div class="form-row">
                        
                        <div class="form-group col-md-6">
                            <label>Photo</label>
                            <input type="file" name="photo" class="form-control">
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