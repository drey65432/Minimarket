<?php
include 'navbar.php'; // Include navbar
include 'db_connection.php'; // Include file koneksi ke database

// Tangkap data barang dari URL
$kd_barang = isset($_GET['kd_barang']) ? $_GET['kd_barang'] : '';
$nama_barang = isset($_GET['nama_barang']) ? $_GET['nama_barang'] : '';
$harga = isset($_GET['harga']) ? $_GET['harga'] : '';

// Proses penyimpanan order
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kd_barang = $_POST["kd_barang"];
    $nama_barang = $_POST["nama_barang"];
    $harga = $_POST["harga"];
    $jumlah = $_POST["jumlah"];
    $tgl_order = $_POST["tgl_order"];
    $kd_suplayer = $_POST["kd_suplayer"];

    $sql_insert = "INSERT INTO tb_order (kd_barang, nama_barang, harga, jumlah, tgl_order, kd_suplayer) VALUES ('$kd_barang', '$nama_barang', '$harga', '$jumlah', '$tgl_order', '$kd_suplayer')";

    if ($conn->query($sql_insert) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Order berhasil disimpan.</div>";
    } else {
        echo "Error: " . $sql_insert . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Form Order</h1>
    <form action="order.php" method="post" class="mt-3">
        <div class="mb-3">
            <label for="kd_barang" class="form-label">Kode Barang</label>
            <input type="text" class="form-control" id="kd_barang" name="kd_barang" value="<?php echo htmlspecialchars($kd_barang); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo htmlspecialchars($nama_barang); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" value="<?php echo htmlspecialchars($harga); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>
        <div class="mb-3">
            <label for="tgl_order" class="form-label">Tanggal Order</label>
            <input type="date" class="form-control" id="tgl_order" name="tgl_order" required>
        </div>
        <div class="mb-3">
            <label for="kd_suplayer" class="form-label">Kode Suplayer</label>
            <input type="text" class="form-control" id="kd_suplayer" name="kd_suplayer" required>
        </div>
        <button type="submit" class="btn btn-primary">Order</button>
    </form>
</div>
</body>
</html>

<?php
$conn->close(); // Tutup koneksi database
?>
