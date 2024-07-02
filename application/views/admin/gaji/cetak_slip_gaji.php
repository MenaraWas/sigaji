<!DOCTYPE html>
<html>

<head>
    <title>Slip Gaji</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            width: 80%;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        header {
            background-color: #f0f0f0;
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: center;
        }

        header h1,
        header h2 {
            margin: 5px 0;
        }

        .employee-info {
            margin-top: 20px;
            margin-right: -650px;
            overflow: auto;
        }

        .income,
        .deduction,
        .net-income {
            margin-top: 20px;
        }

        .income table,
        .deduction table,
        .net-income table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .income th,
        .deduction th,
        .net-income th,
        .income td,
        .deduction td,
        .net-income td {
            text-align: left;
        }

        .income th,
        .deduction th,
        .net-income th {
            background-color: #f0f0f0;
        }

        .net-income h3 {
            margin-top: 10px;
        }

        footer {
            text-align: center;
            margin-top: 20px;
        }

        footer button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        footer button:hover {
            background-color: #45a049;
        }

        .address {
            float: left;
            width: 40%;
        }

        .address p {
            margin-bottom: 5px;
        }

        .details {
            float: right;
            width: 60%;
        }

        .details p {
            margin: 5px 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>PT PANDAM ADIWASTRA JANALOKA</h1>
            <p><a href="http://www.pandamjanaloka.com">www.pandamjanaloka.com</a></p>
            <hr>
            <h2>SLIP GAJI</h2>
        </header>
        <section class="employee-info">
            <?php foreach ($print_slip as $ps) : ?>
                <div class="details">
                    <p>Nama Pegawai: <?php echo $ps->nama_pegawai ?> </p>
                    <p>NIP: <?php echo $ps->nip ?> </p>
                    <p>Jabatan: <?php echo $ps->jabatan ?> </p>
                    <p>Bulan: <?php echo substr($ps->bulan, 5, 8) ?></p>
                </div>
                <div class="address">
                    <p>JL. Langenarjan Kidul no.7A,<br> Panembahan, <br>Kecamatan Kraton,<br> D.I. Yogyakarta, 55131</p>
                </div>
            <?php endforeach; ?>
        </section>

        <section class="income">
            <hr>
            <h3>PENERIMAAN</h3>
            <table>
                <tr>
                    <td>- Gaji Pokok</td>
                    <td>Rp. <?php echo number_format($ps->tot_gapok, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td>- Tunjangan Jabatan</td>
                    <td>Rp. <?php echo number_format($ps->id_tunjangan, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td>- Bonus</td>
                    <td>Rp. <?php echo number_format($ps->id_bonus, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td><strong>Total Penghasilan Kotor</strong></td>
                    <td><strong>Rp. <?php echo number_format($ps->gaji_kotor, 0, ',', '.'); ?></strong></td>
                </tr>
            </table>
        </section>

        <section class="deduction">
            <h3>PENGURANGAN</h3>
            <table>
                <tr>
                    <td>- Presensi Alpa</td>
                    <td>Rp. <?php echo number_format($ps->id_potongan, 0, ',', '.'); ?></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <hr>
                    </td>
                </tr>
                <tr>
                    <td><strong>Total Pengurangan</strong></td>
                    <td><strong>Rp. <?php echo number_format($ps->id_potongan, 0, ',', '.'); ?></strong></td>
                </tr>
            </table>
        </section>

        <section class="net-income">
            <hr>
            <table>
                <tr>
                    <td><h3>TOTAL GAJI DITERIMA BERSIH</h3></td>
                    <td><strong>Rp. <?php echo number_format($ps->gaji_bersih, 0, ',', '.'); ?></strong></td>
                </tr>
            </table>
        </section>

        <footer>
            <button onclick="window.print()">Cetak Halaman</button>
        </footer>
    </div>
</body>

</html>
