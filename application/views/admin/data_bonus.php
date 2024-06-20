<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>

  <?php echo $this->session->flashdata('pesan') ?>

  <a class="btn btn-sm btn-success mb-2 mt-2" href="<?php echo 
  base_url('admin/data_bonus/tambahdata') ?>"><i 
  class="fas fa-plus"></i>Tambah Data</a>

  <table class="table table-bordered table-striped">
    <tr>
      <th class="text-center">Kode Bonus</th>
      <th class="text-center">Nama Bonus</th>
      <th class="text-center">Jumlah Bonus</th>
      <th class="text-center">Keterangan</th>
      <th class="text-center">Action</th>
    </tr>

    <?php $no=1; foreach($bonus as $b) : ?>
      <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $b->Nama_Bonus ?></td>
        <td>Rp. <?php echo number_format($b->Jumlah_Bonus,0,',','.') ?></td>
        <td><?php echo $b->Keterangan ?></td>

        <td>
          <center>
          <a class="btn btn-sm btn-primary" href="<?php echo 
            base_url('admin/data_bonus/updatedata/'.$b->Kode_Bonus) ?>"><i 
            class="fas fa-edit"></i></a>
          <a onclick="return confirm('Yakin Hapus?')"class="btn btn-sm btn-danger" href="<?php echo 
            base_url('admin/data_bonus/deletedata/'.$b->Kode_Bonus) ?>"><i 
            class="fas fa-trash"></i></a>
          </center>
        </td>

      </tr>
      <?php endforeach;?>
  </table>
</div>