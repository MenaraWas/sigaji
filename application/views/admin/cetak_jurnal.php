<!-- views/jurnal_umum/cetak.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <style>
        /* CSS untuk format cetak jurnal umum */
        /* Misalnya, atur tata letak, warna, dan ukuran font untuk mencetak */
    </style>
</head>
<body>
    <h2><?php echo $title; ?></h2>
    <table border="1" cellpadding="5" cellspacing="0">
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
                    <td><?php echo $row->debit; ?></td>
                    <td><?php echo $row->kredit; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <script>
        // JavaScript opsional untuk keperluan cetak
        // Misalnya, mengatur pengaturan pencetakan atau fungsi cetak tambahan
    </script>
</body>
</html>

<script>
    window.print();
</script>
