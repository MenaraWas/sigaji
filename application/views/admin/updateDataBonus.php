<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>

 <div class="card" style="width: 65%">
    <div class="card-body">

    <?php foreach ($bonus as $b): ?>
    <form method="POST" action="<?php echo base_url('admin/data_bonus/updateDataAksi') ?>">

    <div class="form-group">
        <label>Kode Bonus</label>
        <input type="number" name="Kode_Bonus" class="form-control" value="<?php echo $b->Kode_Bonus ?>" readonly>
        <?php echo form_error('Kode_Bonus') ?>
    </div>
    
    <div class="form-group">
        <label>Nama Bonus</label>
        <input type="text" name="Nama_Bonus" class="form-control" value="<?php echo $b->Nama_Bonus ?>">
        <?php echo form_error('Nama_Bonus') ?>
    </div>

    <div class="form-group">
        <label>Jumlah Bonus</label>
        <input type="number" name="Jumlah_Bonus" class="form-control" value="<?php echo trim($b->Jumlah_Bonus); ?>">
        <?php echo form_error('Jumlah_Bonus'); ?>
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="Keterangan" class="form-control" value="<?php echo $b->Keterangan ?>">
        <?php echo form_error('Keterangan') ?>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
<?php endforeach; ?>
    </div>
 </div>
</div>
