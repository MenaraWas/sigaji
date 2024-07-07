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
        <form method="POST" action="<?php echo base_url('manajer/data_pegawai/update_data_aksi')?>"
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
                <label>Jabatan</label>
                <select name="jabatan" class="form-control">
                    <option value="<?php echo $p->jabatan?>"><?php echo $p->jabatan?></option>
                    <?php foreach($jabatan as $j) :?>
                    <option value="<?php echo $j->nama_jabatan ?>"><?php echo $j->nama_jabatan ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input type="date" name="tgl_lahir" class="form-control" value="<?php echo $p->tgl_lahir?>">
                <?php echo form_error('tgl_lahir', '<div class="text-small text-danger"> </div>')?>
            </div>

            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="<?php echo base_url('manajer/data_pegawai')?>" class="btn btn-warning">Kembali</a>

        </form>
        <?php endforeach; ?>
    </div>
</div>