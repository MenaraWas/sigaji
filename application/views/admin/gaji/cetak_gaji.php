<!DOCTYPE html>
<html>
<head>
	<title><?php echo $title;?></title>
	<style type="text/css">
		body {
			font-family: Arial, sans-serif;
			font-size: 14px;
		}
		.table {
			width: 100%;
			border-collapse: collapse;
			margin-top: 20px;
		}
		.table, .table th, .table td {
			border: 1px solid #ddd;
			padding: 8px;
		}
		.table th, .table td {
			text-align: left;
		}
		.text-center {
			text-align: center;
		}
		.text-right {
			text-align: right;
		}
		.title {
			text-align: center;
			font-size: 18px;
			font-weight: bold;
			margin-bottom: 20px;
		}
	</style>
</head>
<body>
<div class="title">
	<p>LAPORAN PENGGAJIAN PEGAWAI <br>PT Pandam Adiwastra Janaloka</p>
	<a href="www.pandamjanaloka.com">www.pandamjanaloka.com</a>
</div>


<table class="table">
	<thead>
		<tr>
			<th class="text-center">No</th>
			<th class="text-center">No Slip Gaji</th>
			<th class="text-center">NIP</th>
			<th class="text-center">Nama Pegawai</th>
			<th class="text-center">Tanggal Gaji</th>
			<th class="text-center">Gaji Pokok</th>
			<th class="text-center">Bonus</th>
			<th class="text-center">Tunjangan</th>
			<th class="text-center">Potongan</th>
			<th class="text-center">Total Gaji</th>
		</tr>
	</thead>
	<tbody>
		<?php if (!empty($gaji)) : ?>
			<?php $no = 1; ?>
			<?php foreach ($gaji as $row) : ?>
				<tr>
					<td class="text-center"><?php echo $no++; ?></td>
					<td><?php echo $row->no_slip_gaji; ?></td> 
					<td><?php echo $row->nip; ?></td>
					<td><?php echo $row->nama_pegawai; ?></td>
					<td class="text-center"><?php echo date('d M Y', strtotime($row->tgl_gaji)); ?></td>
					<td class="text-right">Rp. <?php echo number_format($row->tot_gapok, 0, ',', '.'); ?></td>
					<td class="text-right">Rp. <?php echo number_format($row->id_bonus, 0, ',', '.'); ?></td>
					<td class="text-right">Rp. <?php echo number_format($row->id_tunjangan, 0, ',', '.'); ?></td>
					<td class="text-right">Rp. <?php echo number_format($row->id_potongan, 0, ',', '.'); ?></td>
					<td class="text-right">Rp. <?php echo number_format($row->gaji_bersih, 0, ',', '.'); ?></td>
				</tr>
			<?php endforeach; ?>
		<?php else : ?>
			<tr>
				<td colspan="10" class="text-center">Data tidak tersedia.</td>
			</tr>
		<?php endif; ?>
	</tbody>
</table>

</body>
</html>

<script>
	window.print()
</script>