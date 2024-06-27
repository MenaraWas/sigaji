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
            <h1>PT. Multimedia Adiautama Asia</h1>
            <h2>Daftar Gaji Pegawai</h2>
            <hr>
        </div>

        <?php foreach($print_slip as $ps) : ?>
        <div class="details">
            <table>
                <tr>
                    <td width="30%">Nama Pegawai</td>
                    <td width="5%">:</td>
                    <td><?php echo $ps->nama_pegawai?></td>
                </tr>
                <tr>
                    <td>NIP</td>
                    <td>:</td>
                    <td><?php echo $ps->nip?></td>
                </tr>
                <tr>
                    <td>Jabatan</td>
                    <td>:</td>
                    <td><?php echo $ps->jabatan?></td>
                </tr>
                <tr>
                    <td>Bulan</td>
                    <td>:</td>
                    <td><?php echo substr($ps->bulan, 0,2) ?></td>
                </tr>
                <tr>
                    <td>Tahun</td>
                    <td>:</td>
                    <td><?php echo substr($ps->bulan, 2,4) ?></td>
                </tr>
            </table>
        </div>
 
        <div class="address">
            <p>Alamat:</p>
            <p>Jl. Contoh No. 123</p>
            <p>Kota Contoh</p>
            <p>12345</p>
        </div>

        <div class="summary">
            <table>
                <tr>
                    <th>No</th>
                    <th>Keterangan</th>
                    <th>Jumlah</th>
                </tr>
                <tr>
                    <td>1</td>
                    <td>Gaji Pokok</td>
                    <td>Rp. <?php echo number_format($ps->tot_gapok,0,',','.') ?></td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Tunjangan</td>
                    <td>Rp. <?php echo number_format($ps->id_tunjangan,0,',','.') ?></td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>Bonus</td>
                    <td>Rp. <?php echo number_format($ps->id_bonus,0,',','.') ?></td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Potongan</td>
                    <td>Rp. <?php echo number_format($ps->id_potongan,0,',','.') ?></td>
                </tr>
                <tr>
                    <th colspan="2" style="text-align: right;">Total Gaji : </th>
                    <th>Rp. <?php echo number_format($ps->gaji_bersih,0,',','.') ?></th>
                </tr>
            </table>
        </div>

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
