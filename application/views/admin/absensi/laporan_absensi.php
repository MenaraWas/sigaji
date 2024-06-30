<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
    </div>
    <?php echo $this->session->flashdata('pesan')?>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <form method="GET" class="mb-3" action="<?php echo base_url('admin/laporan_absensi'); ?>">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Bulan</label>
                        <div class="col-sm-9">
                            <select class="form-control" name="bulan">
                                <option value=""> Pilih Bulan </option>
                                <option value="01"
                                    <?php echo ($this->input->get('bulan') == '01') ? 'selected' : ''; ?>>Januari
                                </option>
                                <option value="02"
                                    <?php echo ($this->input->get('bulan') == '02') ? 'selected' : ''; ?>>Februari
                                </option>
                                <option value="03"
                                    <?php echo ($this->input->get('bulan') == '03') ? 'selected' : ''; ?>>Maret</option>
                                <option value="04"
                                    <?php echo ($this->input->get('bulan') == '04') ? 'selected' : ''; ?>>April</option>
                                <option value="05"
                                    <?php echo ($this->input->get('bulan') == '05') ? 'selected' : ''; ?>>Mei</option>
                                <option value="06"
                                    <?php echo ($this->input->get('bulan') == '06') ? 'selected' : ''; ?>>Juni</option>
                                <option value="07"
                                    <?php echo ($this->input->get('bulan') == '07') ? 'selected' : ''; ?>>Juli</option>
                                <option value="08"
                                    <?php echo ($this->input->get('bulan') == '08') ? 'selected' : ''; ?>>Agustus
                                </option>
                                <option value="09"
                                    <?php echo ($this->input->get('bulan') == '09') ? 'selected' : ''; ?>>September
                                </option>
                                <option value="10"
                                    <?php echo ($this->input->get('bulan') == '10') ? 'selected' : ''; ?>>Oktober
                                </option>
                                <option value="11"
                                    <?php echo ($this->input->get('bulan') == '11') ? 'selected' : ''; ?>>November
                                </option>
                                <option value="12"
                                    <?php echo ($this->input->get('bulan') == '12') ? 'selected' : ''; ?>>Desember
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="<?php echo base_url('admin/laporan_absensi'); ?>" class="btn btn-secondary">Reset</a>
                <a href="<?php echo base_url('admin/laporan_absensi/cetak_laporan_absensi'); ?>?bulan=<?php echo $this->input->get('bulan'); ?>"
                    class="btn btn-success"><i class="fas fa-print"></i> Cetak Laporan</a>
            </form>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">ID Kehadiran</th>
                            <th class="text-center">Bulan</th>
                            <th class="text-center">NIP</th>
                            <th class="text-center">Nama Pegawai</th>
                            <th class="text-center">Hadir</th>
                            <th class="text-center">Sakit</th>
                            <th class="text-center">Ijin</th>
                            <th class="text-center">Tanpa Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($kehadiran as $p) : ?>
                        <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td class="text-center"><?php echo $p->id_kehadiran ?></td>
                            <td class="text-center"><?php echo date('Y-m-d', strtotime($p->bulan)); ?></td>
                            <td class="text-center"><?php echo $p->nip ?></td>
                            <td class="text-center"><?php echo $p->nama_pegawai ?></td>
                            <td class="text-center"><?php echo $p->hadir ?></td>
                            <td class="text-center"><?php echo $p->sakit ?></td>
                            <td class="text-center"><?php echo $p->ijin ?></td>
                            <td class="text-center"><?php echo $p->alpha ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
			</div>
			</div>
			</div>
			