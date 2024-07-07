<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style type="text/css">
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .table, .table th, .table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .table th, .table td {
            text-align: left;
        }
        .text-center {
            text-align: center;
        }
        .text-right {
            text-align: right;
        }
        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
        }
        .table-container {
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="title">
        <p>LAPORAN PENGGAJIAN PEGAWAI <br>PT Pandam Adiwastra Janaloka</p>
        <a href="www.pandamjanaloka.com">www.pandamjanaloka.com</a>
    </div>
    <div class="table-container">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Keterangan</th>
                    <th>Akun Debit</th>
                    <th>Akun Kredit</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach ($transaksi as $row) : ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row->tanggal; ?></td>
                        <td><?php echo $row->keterangan; ?></td>
                        <td><?php echo 'Rp ' . number_format($row->debit, 2, ',', '.'); ?></td>
<td><?php echo 'Rp ' . number_format($row->kredit, 2, ',', '.'); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <script>
        // JavaScript opsional untuk keperluan cetak
        // Misalnya, mengatur pengaturan pencetakan atau fungsi cetak tambahan
    </script>
</body>
</html>

<script>
    window.print();
</script>
