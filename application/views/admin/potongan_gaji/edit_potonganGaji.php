<form method="post" id="form">
    <div class="form-group">
        <label for="kode">Kode</label>
        <input type="text" class="form-control" value="<?php echo $hasil->id; ?>" name="id" readonly>
    </div>
    <div class="form-group">
        <label for="potongan">Potongan</label>
        <input type="text" class="form-control" value="<?php echo $hasil->potongan; ?>" name="potongan_baru" placeholder="Masukan Potongan">
    </div>
    <div class="form-group">
         <label for="jml_potongan">Jumlah Potongan</label>
        <input type="text" class="form-control" value="<?php echo $hasil->jml_potongan; ?>" name="jml_potongan" placeholder="Masukan Jumlah Potongan" >
    </div>
    <div class="form-group">
        <label for="keterangan">Keterangan</label>
        <input type="text" class="form-control" value="<?php echo $hasil->keterangan; ?>" name="keterangan" placeholder="Masukan keterangan">
    </div>
    <input type="hidden" name="potongan_lama" value="<?php echo $hasil->potongan;?>">
    <button id="tombol_edit" type="button" class="btn btn-sm btn-info" data-dismiss="modal" ><i class="fas fa-edit"></i>simpan</button>
</form>
<script type="text/javascript">
        $(document).ready(function(){
            $("#tombol_edit").click(function(){
                var data = $('#form').serialize();
                console.log(data);
                $.ajax({
                    type	: 'POST',
                    url	: "<?php echo base_url(); ?>admin/potongan_gaji/editPotongan",
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