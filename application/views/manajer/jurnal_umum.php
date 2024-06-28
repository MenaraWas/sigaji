<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
    
    <button class="btn btn-sm btn-success mb-3" data-toggle="modal" data-target="#modal_tambah_jurnal"><i class="fas fa-plus"></i> Tambah Data</button>

    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class="thead-dark">
            <tr>
                <th class="text-center">No</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Keterangan</th>
                <th class="text-center">Ref</th>
                <th class="text-center">Debit</th>
                <th class="text-center">Kredit</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1; foreach ($jurnal_umum as $ju) : ?>
            <tr>
                <td class="text-center"><?php echo $no++; ?></td>
                <td class="text-center"><?php echo $ju->tanggal; ?></td>
                <td class="text-center"><?php echo $ju->keterangan; ?></td>
                <td class="text-center"><?php echo $ju->ref; ?></td>
                <td class="text-center"><?php echo $ju->debit; ?></td>
                <td class="text-center"><?php echo $ju->kredit; ?></td>
                <td class="text-center">
                    <a class="btn btn-sm btn-info" href="#"><i class="fas fa-edit"></i></a>
                    <a class="btn btn-sm btn-danger" href="#" onclick="return confirm('Yakin ingin menghapus data?');"><i class="fas fa-trash"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal Tambah Jurnal Umum -->
<div class="modal fade" id="modal_tambah_jurnal" tabindex="-1" role="dialog" aria-labelledby="modal_tambah_jurnalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_tambah_jurnalLabel">Tambah Jurnal Umum</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_tambah_jurnal" method="post" action="<?php echo base_url('admin/jurnal_umum/tambah_data_aksi'); ?>">
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label for="keterangan">Keterangan</label>
                        <input type="text" class="form-control" id="keterangan" name="keterangan">
                    </div>
                    <div class="form-group">
                        <label for="ref">Ref</label>
                        <input type="text" class="form-control" id="ref" name="ref">
                    </div>
                    <div class="form-group">
                        <label for="debit">Debit</label>
                        <input type="number" class="form-control" id="debit" name="debit">
                    </div>
                    <div class="form-group">
                        <label for="kredit">Kredit</label>
                        <input type="number" class="form-control" id="kredit" name="kredit">
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>
