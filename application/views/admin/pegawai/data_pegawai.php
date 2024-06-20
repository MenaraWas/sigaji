<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>
  <a class="btn btn-sm btn-success mb-3" href="#" data-toggle="modal" data-target="#modalTambah"><i class="fas fa-plus"></i> Tambah Pegawai</a>
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
              <th class="text-center">Jenis Kelamin</th>
              <th class="text-center">Jabatan</th>
              <th class="text-center">Tanggal Masuk</th>
              <th class="text-center">Status</th>
              <th class="text-center">Hak Akses</th>
              <th class="text-center">Photo</th>
              <th class="text-center">Actions</th>
           </tr>
         </thead>
         <tbody>
           <?php $no=1; foreach($pegawai as $p) : ?>
            <tr>
              <td class="text-center"><?php echo $no++ ?></td>
              <td class="text-center"><?php echo $p->nip ?></td>
              <td class="text-center"><?php echo $p->nama_pegawai ?></td>
              <td class="text-center"><?php echo $p->jenis_kelamin ?></td>
              <td class="text-center"><?php echo $p->jabatan ?></td>
              <td class="text-center"><?php echo $p->tanggal_masuk ?></td>
              <td class="text-center"><?php echo $p->status ?></td>
              <?php if($p->hak_akses=='1') { ?>
                <td>Admin</td>
                <?php } else { ?>
                  <td>Pegawai</td>
                <?php } ?>
              <td><img src="<?php echo base_url().'photo/'.$p->photo?>" width="50px"></td>
              
              <td>
                <center>
                  <a class="btn btn-sm btn-info" href="<?php echo base_url('admin/data_pegawai/update_data/'.$p->id_pegawai) ?>"><i class="fas fa-edit"></i></a>
                  <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger" href="<?php echo base_url('admin/data_pegawai/delete_data/'.$p->id_pegawai) ?>"><i class="fas fa-trash"></i></a>
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
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Pegawai</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Isi modal -->
        <form method="POST" action="<?php echo base_url('admin/data_pegawai/tambah_data_aksi')?>" enctype="multipart/form-data">
          <!-- Form input -->
          <div class="form-group">
			<label>NIP</label>
			<input type="number" name="nip" class="form-control" value="<?php echo $next_nip; ?>" readonly>
			<?php echo form_error('nip', '<div class="text-small text-danger"> </div>')?>
		</div>

			<div class="form-group">
				<label>Nama Pegawai</label>
				<input type="text" name="nama_pegawai" class="form-control">
				<?php echo form_error('nama_pegawai', '<div class="text-small text-danger"> </div>')?>
			</div>

			<div class="form-group">
				<label>Username</label>
				<input type="text" name="username" class="form-control">
				<?php echo form_error('username', '<div class="text-small text-danger"> </div>')?>
			</div>

			<div class="form-group">
				<label>Password</label>
				<input type="password" name="password" class="form-control">
				<?php echo form_error('password', '<div class="text-small text-danger"> </div>')?>
			</div>

			<div class="form-group">
				<label>Jenis Kelamin</label>
				<select name="jenis_kelamin" class="form-control">
					<option value="">--Pilih Jenis Kelamin--</option>
					<option value="Laki-Laki">Laki-Laki</option>
					<option value="Perempuan">Perempuan</option>
				</select>
				<?php echo form_error('jenis_kelamin', '<div class="text-small text-danger"> </div>')?>
			</div>

			<div class="form-group">
				<label>Jabatan</label>
				<select name="jabatan" class="form-control">
					<option value="">--Pilih Jabatan--</option>
					<?php foreach($jabatan as $j) :?>
					<option value="<?php echo $j->nama_jabatan ?>"><?php echo $j->nama_jabatan ?></option>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label>Tanggal Masuk</label>
				<input type="date" name="tanggal_masuk" class="form-control">
				<?php echo form_error('tanggal_masuk', '<div class="text-small text-danger"> </div>')?>
			</div>

			<div class="form-group">
				<label>Status</label>
				<select name="status" class="form-control">
					<option value="">--Pilih Status--</option>
					<option value="Karyawan Tetap">Karyawan Tetap</option>
					<option value="Karyawan Tidak Tetap">Karyawan Tidak Tetap</option>
				</select>
				<?php echo form_error('status', '<div class="text-small text-danger"> </div>')?>
			</div>

			<div class="form-group">
				<label>Hak Akses</label>
				<select name="hak_akses" class="form-control">
					<option value="">--Pilih Hak Akses--</option>
					<option value="1">Admin</option>
					<option value="2">Pegawai</option>
				</select>
			</div>

			<div class="form-group">
				<label>Photo</label>
				<input type="file" name="photo" class="form-control">
			</div>
        </form>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-success" >Simpan</button>
			<button type="reset" class="btn btn-danger" >Reset</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <!-- Tombol simpan -->
      </div>
    </div>
  </div>
</div>

