<?php
include 'db_connection.php'; // Include file koneksi ke database

if (isset($_GET['kd_barang'])) {
    $kd_barang = $_GET['kd_barang'];
    $sql_select = "SELECT * FROM tb_barang WHERE kd_barang = $kd_barang";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
} else {
    echo "Data tidak valid.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Detail Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .print-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .print-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .print-header img {
            width: 100px;
            height: 150px;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .print-content p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
<div class="print-container">
    <div class="print-header">
        <h2>Detail Barang</h2>
        <img src="images/<?php echo $row['gambar']; ?>" alt="<?php echo $row['nama_barang']; ?>">
    </div>
    <div class="print-content">
        <p><strong>Nama Barang:</strong> <?php echo $row['nama_barang']; ?></p>
        <p><strong>Jenis Barang:</strong> <?php echo $row['jenis_barang']; ?></p>
        <p><strong>Harga:</strong> Rp. <?php echo $row['harga']; ?></p>
        <p><strong>Jumlah:</strong> <?php echo $row['jumlah']; ?></p>
        <p><strong>Keterangan:</strong> <?php echo $row['keterangan']; ?></p>
    </div>
</div>

<script>
window.print();
</script>
</body>
</html>

<?php
$conn->close(); // Tutup koneksi database
?>
