<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
    </div>

</div>
<!-- /.container-fluid -->

<div class="card" style="width: 60% ; margin-bottom: 100px">
    <div class="card-body">

        <?php foreach ($pegawai as $p)  : ?>
        <form method="POST" action="<?php echo base_url('admin/data_pegawai/update_data_aksi')?>"
            enctype="multipart/form-data">

            <div class="form-group">
                <label>NIP</label>
                <input type="hidden" readonly name="id_pegawai" class="form-control" value="<?php echo $p->nip?>">
                <input type="number" readonly name="nip" class="form-control" value="<?php echo $p->nip?>">
                <?php echo form_error('nip', '<div class="text-small text-danger"> </div>')?>
            </div>

            <div class="form-group">
                <label>Nama Pegawai</label>
                <input type="text" name="nama_pegawai" class="form-control" value="<?php echo $p->nama_pegawai?>">
                <?php echo form_error('nama_pegawai', '<div class="text-small text-danger"> </div>')?>
            </div>

            <div class="form-group">
                <label>email</label>
                <input type="text" name="email" class="form-control" value="<?php echo $p->email?>">
                <?php echo form_error('email', '<div class="text-small text-danger"> </div>')?>
            </div>
            <div class="form-group">
                <label>gaji</label>
                <input type="text" name="gaji_pokok" class="form-control" value="<?php echo $p->gaji_pokok?>">
                <?php echo form_error('gaji_pokok', '<div class="text-small text-danger"> </div>')?>
            </div>
            <div class="form-group">
                <label>alamat</label>
                <input type="text" name="alamat" class="form-control" value="<?php echo $p->alamat?>">
                <?php echo form_error('alamat', '<div class="text-small text-danger"> </div>')?>
            </div>
            <div class="form-group">
                <label>no.telp</label>
                <input type="text" name="no_telp" class="form-control" value="<?php echo $p->no_telp?>">
                <?php echo form_error('no_telp', '<div class="text-small text-danger"> </div>')?>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" value="<?php echo md5($p->password)?>">
                <?php echo form_error('password', '<div class="text-small text-danger"> </div>')?>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" value="<?php echo $p->id_pegawai?>">
                    <option value="<?php echo $p->jenis_kelamin?>"><?php echo $p->jenis_kelamin?></option>
                    <option value="Laki-Laki">Laki-Laki</option>
                    <option value="Perempuan">Perempuan</option>
                </select>
                <?php echo form_error('jenis_kelamin', '<div class="text-small text-danger"> </div>')?>
            </div>

            <div class="form-group">
                <label>Jabatan</label>
                <select name="jabatan" class="form-control">
                    <option value="<?php echo $p->jabatan?>"><?php echo $p->jabatan?></option>
                    <?php foreach($jabatan as $j) :?>
                    <option value="<?php echo $j->nama_jabatan ?>"><?php echo $j->nama_jabatan ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Masuk</label>
                <input type="date" name="tgl_lahir" class="form-control" value="<?php echo $p->tgl_lahir?>">
                <?php echo form_error('tgl_lahir', '<div class="text-small text-danger"> </div>')?>
            </div>

            <div class="form-group">
                <label>Status</label>
                <select name="status" class="form-control">
                    <option value="<?php echo $p->status?>"><?php echo $p->status?></option>
                    <option value="Karyawan Tetap">Karyawan Tetap</option>
                    <option value="Karyawan Tidak Tetap">Karyawan Tidak Tetap</option>
                </select>
                <?php echo form_error('status', '<div class="text-small text-danger"> </div>')?>
            </div>

            <div class="form-group">
                <label>Hak Akses</label>
                <select name="hak_akses" class="form-control">
                    <option value="<?php echo $p->hak_akses?>">
                        <?php if ($p->hak_akses=='1') {
							echo "Admin";
						} else if ($p->hak_akses=='2'){
							echo "Pegawai";
						} else { 
                            echo "Manajer";
                        } 
                        
                        ?>
                    </option>
                    <option value="1">Admin</option>
                    <option value="2">Pegawai</option>
                    <option value="3">Manajer</option>
                </select>
            </div>

            <div class="form-group">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control">
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="<?php echo base_url('admin/data_pegawai')?>" class="btn btn-warning">Kembali</a>

        </form>
        <?php endforeach; ?>
    </div>
</div>