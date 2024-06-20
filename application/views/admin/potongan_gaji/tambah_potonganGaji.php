<form method="post" id="form">
<div class="form-group">
        <label for="kode">Kode</label>
        <input type="text" class="form-control" name="id" value="<?php echo isset($kode_unik) ? $kode_unik : ''; ?>" readonly>
    </div>
    <div class="form-group">
        <label for="email">Potongan</label>
        <input type="text" class="form-control"  name="potongan" placeholder="Masukan Potongan">
    </div>
    <div class="form-group">
        <label for="email">Jumlah</label>
        <input type="text" class="form-control"  name="jml_potongan" placeholder="Masukan Jumlah Potongan">
    </div>
    <div class="form-group">
        <label for="email">Keterangan</label>
        <input type="text" class="form-control"  name="keterangan" placeholder="Masukan keterangan">
    </div>
    <button id="tombol_tambah" type="button" class="btn btn-primary" data-dismiss="modal" >Tambah</button>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $("#tombol_tambah").click(function(){
            var data = $('#form').serialize();
            $.ajax({
                type	: 'POST',
                url	: "<?php echo base_url(); ?>admin/potongan_gaji/simpanPotongan",
                data: data,
                cache	: false,
                success	: function(data){
                    $('#tampil').load("<?php echo base_url(); ?>admin/potongan_gaji/tampilPotongan", function() {
                    $('#myModal').modal('hide'); // Tutup modal setelah berhasil
                    });
                }
            });
        });
    });
</script> 