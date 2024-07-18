<?php
include 'navbar.php'; // Include navbar
include 'db_connection.php'; // Include file koneksi ke database

// Ambil nilai parameter dari URL
if (isset($_GET['kd_barang']) && isset($_GET['nama_barang'])) {
    $kd_barang = $_GET['kd_barang'];
    $nama_barang = $_GET['nama_barang'];
} else {
    // Jika parameter tidak ditemukan, bisa diarahkan ke halaman lain atau tindakan lainnya
    echo "<div class='alert alert-danger' role='alert'>Parameter tidak valid.</div>";
    exit;
}

// Proses simpan return barang
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Pastikan variabel jumlah tersedia dan memiliki nilai
    $jumlah = isset($_POST["jumlah"]) ? $_POST["jumlah"] : '';
    $tgl_return = $_POST["tgl_return"];
    $keterangan = $_POST["keterangan"];

    // Proses simpan ke database
    $sql_insert_return = "INSERT INTO tb_return (tgl_return, kd_barang, nama_barang, jumlah, keterangan) VALUES ('$tgl_return', '$kd_barang', '$nama_barang', '$jumlah', '$keterangan')";
    
    if ($conn->query($sql_insert_return) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Return barang berhasil disimpan.</div>";
    } else {
        echo "Error: " . $sql_insert_return . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Return Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Return Barang</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . "?kd_barang=$kd_barang&nama_barang=" . urlencode($nama_barang); ?>" method="post" class="mt-3">
        <div class="mb-3">
            <label for="tgl_return" class="form-label">Tanggal Return</label>
            <input type="date" class="form-control" id="tgl_return" name="tgl_return" required>
        </div>
        <div class="mb-3">
            <label for="kd_barang" class="form-label">Kode Barang</label>
            <input type="text" class="form-control" id="kd_barang" name="kd_barang" value="<?php echo htmlspecialchars($kd_barang); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo htmlspecialchars($nama_barang); ?>" readonly>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah Return</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Alasan Return</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$conn->close(); // Tutup koneksi database
?>
