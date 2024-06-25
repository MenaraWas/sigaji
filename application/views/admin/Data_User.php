<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
    </div>
</div>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead class="thead-dark">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Password</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no=1; foreach($user as $p) : ?>
                        <tr>
                            <td class="text-center"><?php echo $no++ ?></td>
                            <td class="text-center"><?php echo $p->email ?></td>
                            <td class="text-center"><?php echo $p->password ?></td>
                            <td class="text-center"><?php echo $p->Level ?></td>
                            <td>
                                <center>
                                    <a class="btn btn-sm btn-info"
                                        href="<?php echo base_url('admin/data_pegawai/update_data/'.$p->nip) ?>"><i
                                            class="fas fa-edit"></i></a>
                                    <a onclick="return confirm('Yakin Hapus?')" class="btn btn-sm btn-danger"
                                        href="<?php echo base_url('admin/data_pegawai/delete_data/'.$p->nip) ?>"><i
                                            class="fas fa-trash"></i></a>
                                </center>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
