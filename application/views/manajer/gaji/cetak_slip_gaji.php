<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title?></title>
    <style type="text/css">
        body {
            font-family: Arial;
            color: black;
        }
        .container {
            width: 80%;
            margin: 0 auto;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .header h1, .header h2 {
            margin: 5px 0;
        }
        .header hr {
            width: 50%;
            border-width: 5px;
            color: black;
        }
        .address {
            float: left;
            width: 40%;
        }
        .address p {
            margin-bottom: 5px;
        }
        .details {
            width: 60%;
            float: right;
        }
        .details table {
            width: 100%;
        } 
        .details table td {
            padding: 5px;
        }
        .summary {
            width: 100%;
            margin-top: 20px;
        }
        .summary table {
            width: 100%;
            border-collapse: collapse;
        }
        .summary table th, .summary table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>PT. Pandam Adiwastra Janaloka</h1>
            <a href="www.pandamjanaloka.com">www.pandamjanaloka.com</a>
            <hr>
            <h3>SLIP GAJI</h3>
            <hr>
        </div>

        <?php foreach($print_slip as $ps) : ?>
        <div class="details">
            <p>Nama Pegawai : <?php echo $ps->nama_pegawai?> <br>
        NIP          : <?php echo $ps->nip?> <br>
        Jabatan      : <?php echo $ps->jabatan?> <br>
        Bulan        : <?php echo substr($ps->bulan, 0,2) ?><br>
        </div>
 
        <div class="address">
            <p>JL. Langenarjan Kidul no.7A,<br> Panembahan, <br>Kecamatan Kraton,<br> D.I. Yogyakarta, 55131</p>
        </div>
        

        <?php endforeach ;?>
        
        <?php foreach($print_slip as $ps) : ?>

        

        <h3><b>Penerimaan</b></h3>
        <p>Gaji Pokok : Rp. <?php echo number_format($ps->tot_gapok, 0, ',', '.'); ?><br>
        Tunjangan : Rp. <?php echo number_format($ps->id_tunjangan, 0, ',', '.'); ?> <br>
        Bonus : Rp. <?php echo number_format($ps->id_bonus, 0, ',', '.'); ?> </p>
        <h6><b>Penghasilan Kotor : Rp. <?php echo number_format($ps->gaji_kotor, 0, ',', '.'); ?> </b></h6>
        <h3><b>Pengurangan</b></h3>
        <p>Alpha : Rp. <?php echo number_format($ps->id_potongan, 0, ',', '.'); ?><br>
        <h6><b>Total Potongan: Rp. <?php echo number_format($ps->id_potongan, 0, ',', '.'); ?> </b></h6>
        <br>
        <h3><b>Gaji Bersih : Rp. <?php echo number_format($ps->gaji_bersih, 0, ',', '.'); ?></b></h3>




        <div style="clear: both;"></div>

        <table width="100%">
            <tr>
                <td></td>
                <td>
                    <p>Pegawai</p>
                    <br>
                    <br>
                    <p class="font-weight-bold"><?php echo $ps->nama_pegawai?></p>
                </td>

                <td width="200px">
                    <p>Yogyakarta, <?php echo date("d M Y")?> <br> Finance,</p>
                    <br>
                    <br>
                    <p>___________________</p>
                </td>
            </tr>
        </table>
        <?php endforeach ;?>
    </div>
</body>
</html>

<script type="text/javascript">
    window.print();
</script>
