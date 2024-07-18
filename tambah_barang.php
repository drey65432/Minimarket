<?php
include 'navbar.php'; // Include navbar

// Include file koneksi ke database
include 'db_connection.php';

// Proses tambah data barang
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $kd_barang = $_POST["kd_barang"];
    $nama_barang = $_POST["nama_barang"];
    $jenis_barang = $_POST["jenis_barang"];
    $harga = $_POST["harga"];
    $jumlah = $_POST["jumlah"];
    $keterangan = $_POST["keterangan"];

    // Handle upload gambar
    $gambar = "";
    if ($_FILES['gambar']['size'] > 0) {
        $file_name = $_FILES['gambar']['name'];
        $file_tmp = $_FILES['gambar']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $extensions = array("jpeg", "jpg", "png");

        if (in_array($file_ext, $extensions) === false) {
            echo "Ekstensi file tidak diizinkan, pilih file JPEG atau PNG.";
            exit;
        }

        $gambar = "barang_" . uniqid() . "." . $file_ext;
        move_uploaded_file($file_tmp, "images/" . $gambar);
    }

    // Query tambah data barang ke database
    $sql = "INSERT INTO tb_barang (kd_barang, nama_barang, jenis_barang, harga, jumlah, keterangan, gambar) 
            VALUES ('$kd_barang', '$nama_barang', '$jenis_barang', '$harga', '$jumlah', '$keterangan', '$gambar')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Barang berhasil ditambahkan.</div>";
        // Redirect kembali ke halaman barang.php setelah tambah
        echo "<meta http-equiv='refresh' content='2;url=barang.php'>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close(); // Tutup koneksi database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <!-- Form tambah data barang -->
    <h1 class="mt-5">Tambah Data Barang</h1>
    <form action="" method="post" enctype="multipart/form-data" class="mt-3">
        <div class="mb-3">
            <label for="kd_barang" class="form-label">Kode Barang</label>
            <input type="text" class="form-control" id="kd_barang" name="kd_barang" required>
        </div>
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
        </div>
        <div class="mb-3">
            <label for="jenis_barang" class="form-label">Jenis Barang</label>
            <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Barang</label>
            <input type="file" class="form-control" id="gambar" name="gambar">
        </div>
        <button type="submit" name="add" class="btn btn-primary">Tambah Data Barang</button>
        <a href="barang.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
