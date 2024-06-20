<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>

 <div class="card" style="width: 65%">
    <div class="card-body">

    <form method="POST" action="<?php echo base_url('admin/Data_Tunjangan/tambahDataAksi') ?>">

    <div class="form-group">
        <label>Kode Tunjangan</label>
        <input type="number" name="Kode_Tunjangan" class="form-control" readonly value="<?php echo $newKodeTunjangan; ?>">
        <?php echo form_error('Kode_Tunjangan') ?>
    </div>

    <div class="form-group">
        <label>Nama Tunjangan</label>
        <input type="text" name="Nama_Tunjangan" class="
        form-control">
        <?php echo form_error('Nama_Tunjangan','<div 
        class="text-small text-danger"></div>') ?>
    </div>

    <div class="form-group">
        <label>Jumlah Tunjangan</label>
        <input type="text" name="Jumlah_Tunjangan" class="
        form-control">
        <?php echo form_error('Jumlah_Tunjangan','<div 
        class="text-small text-danger"></div>') ?>
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="Keterangan" class="
        form-control">
        <?php echo form_error('Keterangan','<div 
        class="text-small text-danger"></div>') ?>
    </div>
    <button type="submit" class="btn btn-success">Submit</button>
</form>
    </div>
 </div>
</div>
