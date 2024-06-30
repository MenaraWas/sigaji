<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>

    <!-- Filter Form -->
    <form method="get" action="<?php echo base_url('admin/jurnal_umum'); ?>">
        <div class="form-row align-items-center mb-3">
            <div class="col-auto">
                <label class="sr-only" for="bulan">Bulan</label>
                <select class="form-control" id="bulan" name="bulan">
                    <option value="">Pilih Bulan</option>
                    <?php for ($i = 1; $i <= 12; $i++) : ?>
                        <option value="<?php echo sprintf('%02d', $i); ?>" <?php echo ($bulan == sprintf('%02d', $i)) ? 'selected' : ''; ?>>
                            <?php echo DateTime::createFromFormat('!m', $i)->format('F'); ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-auto">
                <label class="sr-only" for="tahun">Tahun</label>
                <select class="form-control" id="tahun" name="tahun">
                    <option value="">Pilih Tahun</option>
                    <?php for ($i = date('Y'); $i >= 2010; $i--) : ?>
                        <option value="<?php echo $i; ?>" <?php echo ($tahun == $i) ? 'selected' : ''; ?>><?php echo $i; ?>
                        </option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filter</button>
            </div>
        </div>
    </form>

    <a href="<?php echo base_url('admin/jurnal_umum/cetak'); ?>" class="btn btn-primary">Cetak Jurnal Umum</a>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Debit (Rp)</th>
                <th class="text-center">Kredit (Rp)</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($jurnal_umum as $ju) : ?>
                <tr>
                    <td class="text-center"><?php echo $no++; ?></td>
                    <td class="text-center"><?php echo $ju->tanggal; ?></td>
                    <td><?php echo $ju->keterangan; ?></td>
                    <td class="text-right"><?php echo ($ju->jenis == 'Debit') ? number_format($ju->debit, 0, ',', '.') : ''; ?></td>
                    <td class="text-right"><?php echo ($ju->jenis == 'Kredit') ? number_format($ju->kredit, 0, ',', '.') : ''; ?></td>
                    
                </tr>

                <!-- Modal Edit Jurnal Umum -->
                <div class="modal fade" id="modal_edit_jurnal_<?php echo $ju->id_jurnal; ?>" tabindex="-1" role="dialog" aria-labelledby="modal_edit_jurnalLabel_<?php echo $ju->id_jurnal; ?>" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modal_edit_jurnalLabel_<?php echo $ju->id_jurnal; ?>">Edit Jurnal Umum</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="<?php echo base_url('admin/jurnal_umum/update_data_aksi'); ?>">
                                    <input type="hidden" name="id_jurnal" value="<?php echo $ju->id_jurnal; ?>">
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo $ju->tanggal; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <input type="text" class="form-control" id="keterangan" name="keterangan" value="<?php echo $ju->keterangan; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="debit">Debit</label>
                                        <input type="number" class="form-control" id="debit" name="debit" value="<?php echo ($ju->jenis == 'Debit') ? $ju->debit : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="kredit">Kredit</label>
                                        <input type="number" class="form-control" id="kredit" name="kredit" value="<?php echo ($ju->jenis == 'Kredit') ? $ju->kredit : ''; ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
