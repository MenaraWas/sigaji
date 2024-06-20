<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800"><?php echo $title?></h1>
  </div>

 <div class="card" style="width: 65%">
    <div class="card-body">

    <form method="POST" action="<?php echo base_url('admin/data_bonus/tambahDataAksi') ?>">

    <div class="form-group">
        <label>Kode Bonus</label>
        <input type="number" name="Kode_Bonus" class="form-control" readonly value="<?php echo $newKodeBonus; ?>">
        <?php echo form_error('Kode_Bonus') ?>
    </div>
    
    <div class="form-group">
        <label>Nama Bonus</label>
        <input type="text" name="Nama_Bonus" class="
        form-control">
        <?php echo form_error('Nama_Bonus') ?>
    </div>

    <div class="form-group">
        <label>Jumlah Bonus</label>
        <input type="number" name="Jumlah_Bonus" class="
        form-control">
        <?php echo form_error('Jumlah_Bonus') ?>
    </div>

    <div class="form-group">
        <label>Keterangan</label>
        <input type="text" name="Keterangan" class="
        form-control">
        <?php echo form_error('Keterangan') ?>
    </div>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>


 </div>
</div>
