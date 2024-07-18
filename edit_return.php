<?php
include 'db_connection.php'; // Include file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["kd_return"])) {
    $kd_return = $_GET["kd_return"];

    // Query untuk mengambil data return berdasarkan kd_return
    $sql = "SELECT * FROM tb_return WHERE kd_return = '$kd_return'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $return = $result->fetch_assoc();
    } else {
        echo "Data return tidak ditemukan.";
        exit();
    }
} else {
    echo "Permintaan tidak valid.";
    exit();
}

$conn->close(); // Tutup koneksi database
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Return</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="container text-center mt-5">Edit Data Return</h1>
    
    <form action="proses_edit_return.php" method="post">
        <input type="hidden" name="kd_return" value="<?php echo $return["kd_return"]; ?>">
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $return["nama_barang"]; ?>" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $return["jumlah"]; ?>" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Alasan Return</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3" required><?php echo $return["keterangan"]; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="tgl_return" class="form-label">Tanggal Return</label>
            <input type="date" class="form-control" id="tgl_return" name="tgl_return" value="<?php echo $return["tgl_return"]; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="informasi.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
