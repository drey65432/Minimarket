<?php
include 'navbar.php'; // Include navbar
include 'db_connection.php'; // Include file koneksi ke database

// Query untuk mengambil data suplayer dari database
$sql_suplayer = "SELECT * FROM tb_suplayer";
$result_suplayer = $conn->query($sql_suplayer);

// Query untuk mengambil data order dari database
$sql_order = "SELECT * FROM tb_order";
$result_order = $conn->query($sql_order);

// Query untuk mengambil data return dari database
$sql_return = "SELECT * FROM tb_return";
$result_return = $conn->query($sql_return);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Suplayer, Order & Return</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .print-container {
            display: none;
        }
        @media print {
            .print-container {
                display: block;
            }
            .no-print {
                display: none;
            }
            
        }
    </style>
    <script>
    function confirmDelete() {
        return confirm('Apakah Anda yakin ingin menghapus data ini?');
    }

    function printDetail(detailId) {
        var detailContent = document.getElementById(detailId).innerHTML;
        var originalContent = document.body.innerHTML;

        document.body.innerHTML = detailContent;
        window.print();
        document.body.innerHTML = originalContent;
    }
    </script>
</head>
<body>
<div class="container">
    <h1 class="container text-center mt-5">Informasi Suplayer, Order & Return</h1>
    
    <!-- Informasi Suplayer -->
    <h2 class="mt-4">Suplayer</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Kode Suplayer</th>
                <th>Nama Suplayer</th>
                <th>Alamat</th>
                <th>NO Handphone</th>
                <th class="no-print">Aksi</th> <!-- Kolom untuk aksi -->
            </tr>
        </thead>
        <tbody>
            <?php if ($result_suplayer->num_rows > 0): ?>
                <?php while($row = $result_suplayer->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["kd_suplayer"]; ?></td>
                        <td><?php echo $row["nm_suplayer"]; ?></td>
                        <td><?php echo $row["alamat"]; ?></td>
                        <td><?php echo $row["hp"]; ?></td>
                        <td class="no-print">
                            <a href="edit_suplayer.php?kd_suplayer=<?php echo $row["kd_suplayer"]; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form action="hapus_suplayer.php" method="post" style="display:inline-block;">
                                <input type="hidden" name="kd_suplayer" value="<?php echo $row["kd_suplayer"]; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirmDelete()">Hapus</button>
                            </form>
                            <button class="btn btn-info btn-sm" onclick="printDetail('suplayer-<?php echo $row['kd_suplayer']; ?>')">Cetak</button>
                        </td>
                    </tr>
                    <!-- Konten Detail untuk Cetak -->
                    <tr class="print-container" id="suplayer-<?php echo $row['kd_suplayer']; ?>">
                        <td colspan="5">
                            <h3>Detail Suplayer</h3>
                            <p><strong>Kode Suplayer:</strong> <?php echo $row["kd_suplayer"]; ?></p>
                            <p><strong>Nama Suplayer:</strong> <?php echo $row["nm_suplayer"]; ?></p>
                            <p><strong>Alamat:</strong> <?php echo $row["alamat"]; ?></p>
                            <p><strong>NO Handphone:</strong> <?php echo $row["hp"]; ?></p>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Tidak ada data Suplayer.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Informasi Order -->
    <h2 class="mt-4">Order</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Tanggal Order</th>
                <th>Kode Suplayer</th>
                <th class="no-print">Aksi</th> <!-- Kolom untuk aksi -->
            </tr>
        </thead>
        <tbody>
            <?php if ($result_order->num_rows > 0): ?>
                <?php while($row = $result_order->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["kd_barang"]; ?></td>
                        <td><?php echo $row["nama_barang"]; ?></td>
                        <td><?php echo $row["jumlah"]; ?></td>
                        <td><?php echo $row["tgl_order"]; ?></td>
                        <td><?php echo $row["kd_suplayer"]; ?></td>
                        <td class="no-print">
                            <a href="edit_order.php?kd_order=<?php echo $row["kd_order"]; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form action="hapus_order.php" method="post" style="display:inline-block;">
                                <input type="hidden" name="kd_order" value="<?php echo $row["kd_order"]; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirmDelete()">Hapus</button>
                            </form>
                            <button class="btn btn-info btn-sm" onclick="printDetail('order-<?php echo $row['kd_order']; ?>')">Cetak</button>
                        </td>
                    </tr>
                    <!-- Konten Detail untuk Cetak -->
                    <tr class="print-container" id="order-<?php echo $row['kd_order']; ?>">
                        <td colspan="6">
                            <h3>Detail Order</h3>
                            <p><strong>Kode Barang:</strong> <?php echo $row["kd_barang"]; ?></p>
                            <p><strong>Nama Barang:</strong> <?php echo $row["nama_barang"]; ?></p>
                            <p><strong>Jumlah:</strong> <?php echo $row["jumlah"]; ?></p>
                            <p><strong>Tanggal Order:</strong> <?php echo $row["tgl_order"]; ?></p>
                            <p><strong>Kode Suplayer:</strong> <?php echo $row["kd_suplayer"]; ?></p>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada data order.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Informasi Return -->
    <h2 class="mt-5">Return</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
                <th>Alasan</th>
                <th>Tanggal Return</th>
                <th class="no-print">Aksi</th> <!-- Kolom untuk aksi -->
            </tr>
        </thead>
        <tbody>
            <?php if ($result_return->num_rows > 0): ?>
                <?php while($row = $result_return->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["kd_barang"]; ?></td>
                        <td><?php echo $row["nama_barang"]; ?></td>
                        <td><?php echo $row["jumlah"]; ?></td>
                        <td><?php echo $row["keterangan"]; ?></td>
                        <td><?php echo $row["tgl_return"]; ?></td>
                        <td class="no-print">
                            <a href="edit_return.php?kd_return=<?php echo $row["kd_return"]; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <form action="hapus_return.php" method="post" style="display:inline-block;">
                                <input type="hidden" name="kd_return" value="<?php echo $row["kd_return"]; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="return confirmDelete()">Hapus</button>
                            </form>
                            <button class="btn btn-info btn-sm" onclick="printDetail('return-<?php echo $row['kd_return']; ?>')">Cetak</button>
                        </td>
                    </tr>
                    <!-- Konten Detail untuk Cetak -->
                    <tr class="print-container" id="return-<?php echo $row['kd_return']; ?>">
                        <td colspan="6">
                            <h3>Detail Return</h3>
                            <p><strong>Kode Barang:</strong> <?php echo $row["kd_barang"]; ?></p>
                            <p><strong>Nama Barang:</strong> <?php echo $row["nama_barang"]; ?></p>
                            <p><strong>Jumlah:</strong> <?php echo $row["jumlah"]; ?></p>
                            <p><strong>Alasan:</strong> <?php echo $row["keterangan"]; ?></p>
                            <p><strong>Tanggal Return:</strong> <?php echo $row["tgl_return"]; ?></p>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">Tidak ada data return.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
$conn->close(); // Tutup koneksi database
?>

