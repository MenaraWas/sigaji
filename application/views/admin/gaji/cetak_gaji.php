<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title?></title>
	<style type="text/css">
		body{
			font-family: Arial;
			color: black;
		}
		.table {
			width: 100%;
			border-collapse: collapse;
		}
		.table, .table th, .table td {
			border: 1px solid black;
		}
		.table th, .table td {
			padding: 8px;
			text-align: center;
		}
	</style>
</head>
<body>
	<center>
		<h1>PT. Multimedia Adiautama Asia</h1>
		<h2>Daftar Gaji Pegawai</h2>
	</center>

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
	<table>
		<tr>
			<td>Bulan</td>
			<td>:</td>
			<td><?php echo $bulan?></td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>:</td>
			<td><?php echo $tahun?></td>
		</tr>
	</table>
	<table class="table">
		<tr>
			<th class="text-center">No</th>
			<th class="text-center">NIP</th>
			<th class="text-center">Nama Pegawai</th>
			<th class="text-center">Jenis Kelamin</th>
			<th class="text-center">Jabatan</th>
			<th class="text-center">Gaji Pokok</th>
			<th class="text-center">Tj. Transport</th>
			<th class="text-center">Uang Makan</th>
			<th class="text-center">Potongan</th>
			<th class="text-center">Total Gaji</th>
		</tr>
		<?php 
		$no = 1; 
		foreach($cetak_gaji as $g) : 
			foreach($potongan as $p) {
				$alpha = $p->jml_potongan;
			}
			$potongan = $g->alpha * $alpha;
		?>
		<tr>
			<td class="text-center"><?php echo $no++ ?></td>
			<td class="text-center"><?php echo $g->nip ?></td>
			<td class="text-center"><?php echo $g->nama_pegawai ?></td>
			<td class="text-center"><?php echo $g->jenis_kelamin ?></td>
			<td class="text-center"><?php echo $g->jabatan ?></td>
			<td class="text-center">Rp. <?php echo number_format($g->gaji_pokok,0,',','.') ?></td>
			<td class="text-center">Rp. <?php echo number_format($g->tj_transport,0,',','.') ?></td>
			<td class="text-center">Rp. <?php echo number_format($g->uang_makan,0,',','.') ?></td>
			<td class="text-center">Rp. <?php echo number_format($potongan,0, ',','.') ?></td>
			<td class="text-center">Rp. <?php echo number_format($g->gaji_pokok + $g->tj_transport + $g->uang_makan - $potongan,0,',','.') ?></td>
		</tr>
		<?php endforeach; ?>
	</table>

	<table width="100%">
		<tr>
			<td></td>
			<td width="200px">
				<p>Yogyakarta, <?php echo date("d M Y") ?> <br> Finance</p>
				<br>
				<br>
				<p>_____________________</p>
			</td>
		</tr>
	</table>
</body>
</html>

<script type="text/javascript">
	window.print();
</script>
