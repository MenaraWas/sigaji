<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center 
  justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>

  <a class="btn btn-sm btn-success mb-2 mt-2" href="<?php echo 
  base_url('admin/Data_Tunjangan/tambahdata') ?>"><i 
  class="fas fa-plus"></i>Tambah Data</a>

<?php echo $this->session->flashdata('pesan') ?>
  <table class="table table-bordered table-striped mt-2">
    <tr>
      <th class="text-center">Kode Tunjangan</th>
      <th class="text-center">Nama Tunjangan</th>
      <th class="text-center">Jumlah Tunjangan</th>
      <th class="text-center">Keterangan</th>
      <th class="text-center">Action</th>
    </tr>
 
    <?php $no=1; foreach($tunjangan as $t) : ?>
      <tr>
        <td><?php echo $no++ ?></td>
        <td><?php echo $t->Nama_Tunjangan ?></td>
        <td>Rp. <?php echo number_format($t->Jumlah_Tunjangan,0,',','.') ?></td>
        <td><?php echo $t->Keterangan ?></td>

        <td>
          <center>
          <a class="btn btn-sm btn-primary" href="<?php echo 
            base_url('admin/Data_Tunjangan/updatedata/'.$t->Kode_Tunjangan) ?>"><i 
            class="fas fa-edit"></i></a>
          <a onclick="return confirm('Yakin Hapus?')"class="btn btn-sm btn-danger" href="<?php echo 
            base_url('admin/Data_Tunjangan/deletedata/'.$t->Kode_Tunjangan) ?>"><i 
            class="fas fa-trash"></i></a>
          </center>
        </td>

      </tr>
      <?php endforeach;?>
  </table>

</div>