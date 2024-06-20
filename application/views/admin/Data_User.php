<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>
  <a class="btn btn-sm btn-success mb-3" href="<?php echo base_url('admin/Data_User/tambah_data') ?>"><i class="fas fa-plus"></i> Tambah User</a>
  <?php echo $this->session->flashdata('pesan')?>
 
  <div class="card" style="width: 60% ; margin-bottom: 100px">
	<div class="card-body">
		<form method="POST" action="<?php echo base_url('admin/data_pegawai/add_user')?>" enctype="multipart/form-data">
			
			<div class="form-group">
				<label>Id User</label>
				<input type="number" name="id_user" class="form-control">
				<?php echo form_error('id_user', '<div class="text-small text-danger"> </div>')?>
			</div>

      <div class="form-group">
				<label>Level</label>
				<select name="hak_akses" class="form-control">
					<option value="">--Pilih Level ...--</option>
					<option value="1">Admin</option>
					<option value="2">Pegawai</option>
				</select>
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


			<button type="submit" class="btn btn-success" >Simpan</button>
			<button type="reset" class="btn btn-danger" >Reset</button>
			<a href="<?php echo base_url('admin/data_user')?>" class="btn btn-warning">Kembali</a>

		</form>
	</div>
</div>
  
</div>


 