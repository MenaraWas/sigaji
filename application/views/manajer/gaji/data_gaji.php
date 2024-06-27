<div class="container-fluid">
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>

  <div class="card mb-3">
  <div class="card-header bg-primary text-white">
    Filter Gaji
  </div>
  <div class="card-body">
    <form class="form-inline">
	  <div class="form-group mb-2">
	  <label for="staticEmail2">Nama Pegawai</label>
		<select class="form-control ml-3" name="nama_pegawai">
			<option value=""> Pilih Pegawai </option>
			<?php foreach($pegawai as $p): ?>
				<option value="<?php echo $p->nip; ?>"><?php echo $p->nama_pegawai; ?></option>
			<?php endforeach; ?>
		</select>
	  </div>
	  <div class="form-group mb-2 ml-5">
	    <label for="staticEmail2">No Slip Gaji</label>
	    </select>
	  </div>
	  
	  <button type="submit" class="btn btn-primary mb-2 ml-auto"><i class="fas fa-eye"></i> Tampilkan Data</button>
	  <a href="<?php echo base_url('admin/data_penggajian/input_gaji') ?>" class="btn btn-success mb-2 ml-3"><i class="fas fa-plus"></i> Input Kehadiran</a>
	</form>
  </div>
</div>
</div>
	
	<?php
		if((isset($_GET['bulan']) && $_GET['bulan']!='') && (isset($_GET['tahun']) && $_GET['tahun']!='')){
			$bulan = $_GET['bulan'];
			$tahun = $_GET['tahun'];
			$bulantahun = $bulan.$tahun;
		}else{
			$bulan = date('m');
			$tahun = date('Y');
			$bulantahun = $bulan.$tahun;
		}
	?>


	<div class="alert alert-info">
		Menampilkan Data Kehadiran Pegawai Bulan: <span class="font-weight-bold"><?php echo $bulan ?></span> Tahun: <span class="font-weight-bold"><?php echo $tahun ?></span>
	</div>

	<?php

	$jml_data = count($absensi);
	if($jml_data > 0 ) { ?>

		<div class="container-fluid">
		  <div class="card shadow mb-4">
		   <div class="card-body">
		     <div class="table-responsive">
		       <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
		         <thead class="thead-dark">
		           <tr>
		              	<td class="text-center">No Slip Gaji</td>
						<td class="text-center">NIP</td>
						<td class="text-center">Nama Pegawai</td>
						<td class="text-center">Tanggal Gaji</td>
						<td class="text-center">Total Gapok</td>
						<td class="text-center">Total Tunjangan</td>
						<td class="text-center">Total Bonus</td>
						<td class="text-center">Gaji Bersih</td>
						<td class="text-center">Gaji Kotor</td>
						<td class="text-center">Status Pengajuan</td>
						<td class="text-center">Catatan</td>
		           </tr>
		         </thead>
		         <tbody>
		           <?php $no=1; foreach($absensi as $a) :?>
					<tr>
						<td class="text-center"><?php echo $no++?></td>
						<td class="text-center"><?php echo $a->nip?></td>
						<td class="text-center"><?php echo $a->nama_pegawai?></td>
						<td class="text-center"><?php echo $a->jenis_kelamin?></td>
						<td class="text-center"><?php echo $a->nama_jabatan?></td>
						<td class="text-center"><?php echo $a->hadir?></td>
						<td class="text-center"><?php echo $a->sakit?></td>
						<td class="text-center"><?php echo $a->alpha?></td>
					</tr>
		            </tr>
		          <?php endforeach; ?>
		         </tbody>
		       </table>
		     </div>
		   </div>
		  </div>
		</div>

	<?php }else { ?>
		<span class="badge badge-danger"><i class="fas fa-info-circle"></i> Data masih kosong, silakan input data kehadiran pada bulan dan tahun yang anda pilih</span>
	<?php } ?>
</div>