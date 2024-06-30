	<div class="container-fluid">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
		</div>
		<?php echo $this->session->flashdata('pesan')?>
	</div>

	<div class="container-fluid">
		<div class="card shadow mb-4">
			<div class="card-body">
				<form method="GET" class="mb-3" action="<?php echo base_url('admin/laporan_gaji'); ?>">
					<div class="form-row">
						<div class="form-group col-md-4">
							<label>Nama Pegawai</label>
							<select name="nip" class="form-control">
								<option value="">-- Pilih Nama Pegawai --</option>
								<?php foreach($pegawai as $p): ?>
									<option value="<?php echo $p->nip; ?>" <?php echo ($this->input->get('nip') == $p->nip) ? 'selected' : ''; ?>>
										<?php echo $p->nama_pegawai; ?>
									</option>
								<?php endforeach; ?>
							</select>
						</div>
						<div class="form-group col-md-4"> 
							<label>Bulan</label>
							<div class="col-sm-9">
							<select class="form-control" name="bulan">
								<option value=""> Pilih Bulan </option>
								<option value="01" <?php echo ($this->input->get('bulan') == '01') ? 'selected' : ''; ?>>Januari</option>
								<option value="02" <?php echo ($this->input->get('bulan') == '02') ? 'selected' : ''; ?>>Februari</option>
								<option value="03" <?php echo ($this->input->get('bulan') == '03') ? 'selected' : ''; ?>>Maret</option>
								<option value="04" <?php echo ($this->input->get('bulan') == '04') ? 'selected' : ''; ?>>April</option>
								<option value="05" <?php echo ($this->input->get('bulan') == '05') ? 'selected' : ''; ?>>Mei</option>
								<option value="06" <?php echo ($this->input->get('bulan') == '06') ? 'selected' : ''; ?>>Juni</option>
								<option value="07" <?php echo ($this->input->get('bulan') == '07') ? 'selected' : ''; ?>>Juli</option>
								<option value="08" <?php echo ($this->input->get('bulan') == '08') ? 'selected' : ''; ?>>Agustus</option>
								<option value="09" <?php echo ($this->input->get('bulan') == '09') ? 'selected' : ''; ?>>September</option>
								<option value="10" <?php echo ($this->input->get('bulan') == '10') ? 'selected' : ''; ?>>Oktober</option>
								<option value="11" <?php echo ($this->input->get('bulan') == '11') ? 'selected' : ''; ?>>November</option>
								<option value="12" <?php echo ($this->input->get('bulan') == '12') ? 'selected' : ''; ?>>Desember</option>
							</select>
							</div>
						</div>
						<div class="form-group col-md-4">
							<label>Status Pengajuan</label>
							<select name="status_pengajuan" class="form-control">
								<option value="">-- Pilih Status --</option>
								<option value="Proses" <?php echo ($this->input->get('status_pengajuan') == 'Proses') ? 'selected' : ''; ?>>Proses</option>
								<option value="Disetujui" <?php echo ($this->input->get('status_pengajuan') == 'Disetujui') ? 'selected' : ''; ?>>Disetujui</option>
								<option value="Ditolak" <?php echo ($this->input->get('status_pengajuan') == 'Ditolak') ? 'selected' : ''; ?>>Ditolak</option>
							</select>
						</div>
					</div>
					<button type="submit" class="btn btn-primary">Filter</button>
					<a href="<?php echo base_url('admin/laporan_gaji'); ?>" class="btn btn-secondary">Reset</a>
					<a href="<?php echo base_url('admin/laporan_gaji/cetak_laporan_gaji'); ?>?nip=<?php echo $this->input->get('nip'); ?>&bulan=<?php echo $this->input->get('bulan'); ?>&status_pengajuan=<?php echo $this->input->get('status_pengajuan'); ?>" class="btn btn-success"><i class="fas fa-print"></i> Cetak Laporan</a>
				</form>
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead class="thead-dark">
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">No Slip Gaji</th> 
								<th class="text-center">NIP</th>
								<th class="text-center">Nama Pegawai</th>
								<th class="text-center">Tanggal Gaji</th>
								<th class="text-center">Gaji Pokok</th>
								<th class="text-center">Total Tunjangan</th>
								<th class="text-center">Total Bonus</th>
								<th class="text-center">Total Potongan</th>
								<th class="text-center">Gaji Kotor</th>
								<th class="text-center">Gaji Bersih</th>
								<th class="text-center">Total Presensi</th>
								<th class="text-center">Status Pengajuan</th>
								<th class="text-center">Catatan</th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach($gaji as $p) : ?>
							<tr>
								<td class="text-center"><?php echo $no++ ?></td>
								<td class="text-center"><?php echo $p->no_slip_gaji ?></td>
								<td class="text-center"><?php echo $p->nip ?></td>
								<td class="text-center"><?php echo $p->nama_pegawai ?></td>
								<td class="text-center"><?php echo $p->tgl_gaji ?></td>
								<td class="text-center"><?php echo $p->tot_gapok ?></td>
								<td class="text-center"><?php echo $p->id_tunjangan ?></td>
								<td class="text-center"><?php echo $p->id_bonus ?></td>
								<td class="text-center"><?php echo $p->id_potongan ?></td>
								<td class="text-center"><?php echo $p->gaji_kotor ?></td>
								<td class="text-center"><?php echo $p->gaji_bersih ?></td>
								
								<td class="text-center">
									<?php echo "Hadir: " . $p->hadir . ", Sakit: " . $p->sakit . ", Alpha: " . $p->alpha; ?>
								</td>
								<td class="text-center"><?php echo $p->status_pengajuan ?></td>
								<td class="text-center"><?php echo $p->catatan ?></td>
							</tr>
							<?php endforeach; ?>
						</tbody>

					</table>
				</div>
			</div>
		</div>
	</div>
