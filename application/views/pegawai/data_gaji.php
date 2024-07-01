<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>

  <table class="table table-striped table-bordered">
  	<tr>
  		<th>Bulan/Tahun</th>
  		<th>Gaji Pokok</th>
  		<th>Tunjangan Transportasi</th>
  		<th>Uang Makan</th>
  		<th>Potongan</th>
  		<th>Total Gaji</th>
  		<th>Cetak Slip</th>
  	</tr>

  	<?php foreach($potongan as $p) : ?>
  		<?php $potongan = $p->jml_potongan; ?>
  	<?php endforeach; ?>

  	<?php foreach ($gaji as $g) : ?>
  	<?php $pot_gaji = $g->alpha * $potongan ?>
  	<tr>
  		<td><?php echo $g->bulan ?></td>
  		<td>Rp. <?php echo number_format($g->tot_gapok,0,',','.') ?></td>
  		<td>Rp. <?php echo number_format($g->id_tunjangan,0,',','.') ?></td>
  		<td>Rp. <?php echo number_format($g->id_bonus,0,',','.') ?></td>
  		<td>Rp. <?php echo number_format($g->id_potongan,0,',','.') ?></td>
  		<td>Rp. <?php echo number_format($g->gaji_bersih,0,',','.') ?></td>
  		<td>
  			<center>
  				<a class="btn btn-sm btn-primary" href="<?php echo base_url('pegawai/data_gaji/cetak_slip/'.$g->id_kehadiran)?>"><i class="fas fa-print"></i></a>
  			</center>
  		</td>
  	</tr>
  <?php endforeach; ?>
  </table>

</div>
<!-- /.container-fluid -->