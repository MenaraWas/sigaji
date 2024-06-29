<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?php echo $title; ?></h1>
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
                <button class="btn btn-sm btn-info" data-toggle="modal" data-target="#modal_edit_jurnal_<?php echo $ju->id_jurnal; ?>"><i class="fas fa-edit"></i></button>
                    <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger"
                        href="<?php echo base_url('admin/jurnal_umum/delete_data/'.$ju->id_jurnal) ?>"><i
                            class="fas fa-trash"></i></a> 
                </td>
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
                                    <label for="ref">Ref</label>
                                    <input type="text" class="form-control" id="ref" name="ref" value="<?php echo $ju->ref; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="debit">Debit</label>
                                    <input type="number" class="form-control" id="debit" name="debit" value="<?php echo $ju->debit; ?>">
                                </div>
                                <div class="form-group">
                                    <label for="kredit">Kredit</label>
                                    <input type="number" class="form-control" id="kredit" name="kredit" value="<?php echo $ju->kredit; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Modal Delete Jurnal Umum -->
            <div class="modal fade" id="modal_delete_jurnal_<?php echo $ju->id_jurnal; ?>" tabindex="-1" role="dialog"
                aria-labelledby="modal_delete_jurnalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modal_delete_jurnalLabel">Hapus Jurnal Umum</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                            <form method="post"
                                action="<?php echo base_url('admin/jurnal_umum/delete_data_aksi/'.$ju->id_jurnal); ?>">
                                <button type="submit" class="btn btn-danger">Hapus</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>