<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>

 <div class="card" style="width: 65%">
    <div class="card-body">
<?php foreach ($tunjangan as $t): ?>
    <form method="POST" action="<?php echo base_url('admin/Data_Tunjangan/updateDataAksi') ?>">

    <div class="form-group">
        <label>Kode Tunjangan</label>
        <input type="number" name="Tunjangan" class="form-control" value
        ="<?php echo $t->Tunjangan ?>" readonly>
        <?php echo form_error('Tunjangan','<div 
        class="text-small text-danger"></div>') ?>
    </div>

    <div class="form-group">
        <label>Nama Tunjangan</label>
        <input type="text" name="Tunjangan" class="form-control" value
        ="<?php echo $t->Tunjangan ?>">
        <?php echo form_error('Tunjangan','<div 
        class="text-small text-danger"></div>') ?>
    </div>

    <div class="form-group">
        <label>Jumlah Tunjangan</label>
        <input type="number" name="Jumlah_Tunjangan" class="form-control" value
        ="<?php echo $t->Jumlah_Tunjangan ?>">
        <?php echo form_error('Jumlah_Tunjangan','<div 
        class="text-small text-danger"></div>') ?>
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="Keterangan" class="form-control" value
        ="<?php echo $t->Keterangan ?>">
        <?php echo form_error('Keterangan','<div 
        class="text-small text-danger"></div>') ?>
    </div>
    <button type="submit" class="btn btn-success">Update</button>
</form>
<?php endforeach; ?>
    </div>
 </div>
</div>
