<?php
include 'navbar.php'; // Include navbar

// Include file koneksi ke database
include 'db_connection.php';

// Ambil kd_barang dari parameter GET
if (isset($_GET['kd_barang'])) {
    $kd_barang = $_GET['kd_barang'];

    // Query untuk mengambil data barang berdasarkan kd_barang
    $sql_select = "SELECT * FROM tb_barang WHERE kd_barang = $kd_barang";
    $result = $conn->query($sql_select);

    if ($result->num_rows > 0) {
        // Ambil data dari hasil query
        $row = $result->fetch_assoc();
        $nama_barang = $row["nama_barang"];
        $jenis_barang = $row["jenis_barang"];
        $harga = $row["harga"];
        $jumlah = $row["jumlah"];
        $keterangan = $row["keterangan"];
        $gambar = $row["gambar"];
    } else {
        echo "<div class='alert alert-danger' role='alert'>Data barang tidak ditemukan.</div>";
        exit; // Keluar dari script jika data tidak ditemukan
    }
}

$conn->close(); // Tutup koneksi database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <!-- Form edit data barang -->
    <h1 class="mt-5">Edit Data Barang</h1>
    <form action="update_barang.php" method="post" enctype="multipart/form-data" class="mt-3">
        <input type="hidden" name="kd_barang" value="<?php echo $kd_barang; ?>">
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $nama_barang; ?>" required>
        </div>
        <div class="mb-3">
            <label for="jenis_barang" class="form-label">Jenis Barang</label>
            <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" value="<?php echo $jenis_barang; ?>" required>
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="text" class="form-control" id="harga" name="harga" value="<?php echo $harga; ?>" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $jumlah; ?>" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan"><?php echo $keterangan; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="gambar" class="form-label">Gambar Barang</label>
            <br>
            <img src="images/<?php echo $gambar; ?>" class="img-thumbnail" width="150" alt="Gambar Barang">
            <br><br>
            <input type="file" class="form-control" id="gambar" name="gambar">
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update Data Barang</button>
        <a href="barang.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
