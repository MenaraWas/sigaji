<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
    </div>
    <a class="btn btn-sm btn-success mb-3" href="#" data-toggle="modal" data-target="#modalTambah"><i
            class="fas fa-plus"></i> Tambah Data Kehadiran</a>
    <?php echo $this->session->flashdata('pesan')?>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
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
                            <th class="text-center">Actions</th>
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
                            <td>
                                <center>
                                    <a class="btn btn-sm btn-info" data-toggle="modal"
                                        data-target="#modalUpdate<?php echo $p->nip; ?>">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- Tombol Hapus dengan Modal -->
                                    <a class="btn btn-sm btn-danger" data-toggle="modal"
                                        data-target="#modalDelete<?php echo $p->nip; ?>">
                                        <i class="fas fa-trash"></i>
                                    </a>


                                    
                                </center>
                            </td>
                        </tr>
                        <!-- Modal Update -->
                        <div class="modal fade" id="modalUpdate<?php echo $p->nip; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="modalUpdateLabel<?php echo $p->nip; ?>"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalUpdateLabel<?php echo $p->nip; ?>">
                                                        Update Data Kehadiran</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Isi form update di sini -->
                                                    <!-- Contoh: -->
                                                    <!-- Form untuk mengupdate data -->

                                                    <form
                                                        action="<?php echo base_url('manajer/input_presensi/update_data_aksi'); ?>"
                                                        method="post">
                                                        <input type="hidden" name="nip" value="<?php echo $p->nip; ?>">

                                                        <!-- Isi form input sesuai kebutuhan -->

                                                        <div class="form-group">
                                                            <label>Nama Pegawai</label>
                                                            <input type="text" name="nama_pegawai" class="form-control"
                                                                value="<?php echo $p->nama_pegawai; ?>" required
                                                                readonly>
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label>Bulan</label>
                                                            <select name="bulan" class="form-control">
                                                                <option value="">-- Pilih Bulan --</option>
                                                                <?php
                                                                $bulanList = array(
                                                                    '01' => 'Januari',
                                                                    '02' => 'Februari',
                                                                    '03' => 'Maret',
                                                                    '04' => 'April',
                                                                    '05' => 'Mei',
                                                                    '06' => 'Juni',
                                                                    '07' => 'Juli',
                                                                    '08' => 'Agustus',
                                                                    '09' => 'September',
                                                                    '10' => 'Oktober',
                                                                    '11' => 'November',
                                                                    '12' => 'Desember'
                                                                );

                                                                foreach ($bulanList as $key => $value) {
                                                                    echo '<option value="' . $key . '">' . $value . '</option>';
                                                                }
                                                            ?>
                                                            </select>
                                                        </div>

                                                        <!-- Dropdown Tahun -->
                                                        <div class="form-group col-md-6">
                                                            <label>Tahun</label>
                                                            <select name="tahun" class="form-control">
                                                                <option value="">-- Pilih Tahun --</option>
                                                                <?php
                                                                    $tahunSekarang = date('Y');
                                                                    $tahunAwal = $tahunSekarang - 10; // Misalnya, pilih 10 tahun ke belakang dari tahun sekarang

                                                                    for ($tahun = $tahunSekarang; $tahun >= $tahunAwal; $tahun--) {
                                                                        echo '<option value="' . $tahun . '">' . $tahun . '</option>';
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="hadir">Jumlah Kehadiran</label>
                                                            <input type="text" name="hadir" class="form-control"
                                                                value="<?php echo $p->hadir; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ijin">Jumlah Ijin</label>
                                                            <input type="text" name="ijin" class="form-control"
                                                                value="<?php echo $p->ijin; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ijin">Jumlah Sakit</label>
                                                            <input type="text" name="sakit" class="form-control"
                                                                value="<?php echo $p->sakit; ?>">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="ijin">Jumlah Tanpa Keterangan</label>
                                                            <input type="text" name="alpha" class="form-control"
                                                                value="<?php echo $p->hadir; ?>">
                                                        </div>

                                                        <!-- Tombol submit untuk update -->
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Delete -->
                                    <div class="modal fade" id="modalDelete<?php echo $p->nip; ?>" tabindex="-1"
                                        role="dialog" aria-labelledby="modalDeleteLabel<?php echo $p->nip; ?>"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalDeleteLabel<?php echo $p->nip; ?>">
                                                        Konfirmasi Hapus Data</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Anda yakin ingin menghapus data ini?</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <a href="<?php echo base_url('manajer/input_presensi/delete_data/'.$p->nip); ?>"
                                                        class="btn btn-danger">Ya</a>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">Tidak</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php endforeach; ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modalTambah" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Kehadiran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Isi modal -->
                <form method="POST" action="<?php echo base_url('manajer/input_presensi/tambah_data_aksi')?>"
                    enctype="multipart/form-data">
                    <!-- Form input -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>ID Kehadiran</label>
                            <input type="text" name="id_kehadiran" class="form-control"
                                value="<?php echo $next_no_kehadiran; ?>" readonly>
                            <?php echo form_error('id_kehadiran', '<div class="text-small text-danger"> </div>')?>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label>Nama Pegawai</label>
                            <select name="nip" class="form-control">
                                <?php foreach($pegawai as $p): ?>
                                <option value="<?php echo $p->nip . '|' . $p->nama_pegawai; ?>">
                                    <?php echo $p->nama_pegawai; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <?php echo form_error('nip', '<div class="text-small text-danger"> </div>')?>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Bulan</label>
                        <select name="bulan" class="form-control">
                            <option value="">-- Pilih Bulan --</option>
                            <?php
								$bulanList = array(
									'01' => 'Januari',
									'02' => 'Februari',
									'03' => 'Maret',
									'04' => 'April',
									'05' => 'Mei',
									'06' => 'Juni',
									'07' => 'Juli',
									'08' => 'Agustus',
									'09' => 'September',
									'10' => 'Oktober',
									'11' => 'November',
									'12' => 'Desember'
								);

								foreach ($bulanList as $key => $value) {
									echo '<option value="' . $key . '">' . $value . '</option>';
								}
							?>
                        </select>
                    </div>

                    <!-- Dropdown Tahun -->
                    <div class="form-group col-md-6">
                        <label>Tahun</label>
                        <select name="tahun" class="form-control">
                            <option value="">-- Pilih Tahun --</option>
                            <?php
								$tahunSekarang = date('Y');
								$tahunAwal = $tahunSekarang - 10; // Misalnya, pilih 10 tahun ke belakang dari tahun sekarang

								for ($tahun = $tahunSekarang; $tahun >= $tahunAwal; $tahun--) {
									echo '<option value="' . $tahun . '">' . $tahun . '</option>';
								}
							?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hadir">Jumlah Kehadiran</label>
                        <input type="text" name="hadir" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="ijin">Jumlah Ijin</label>
                        <input type="text" name="ijin" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="ijin">Jumlah Sakit</label>
                        <input type="text" name="sakit" class="form-control" value="">
                    </div>
                    <div class="form-group">
                        <label for="ijin">Jumlah Tanpa Keterangan</label>
                        <input type="text" name="alpha" class="form-control" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Simpan</button>
                        <button type="reset" class="btn btn-danger">Reset</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <!-- Tombol simpan -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>