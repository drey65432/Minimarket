<?php
include 'db_connection.php'; // Include file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["kd_order"])) {
    $kd_order = $_GET["kd_order"];

    // Query untuk mengambil data order berdasarkan kd_order
    $sql = "SELECT * FROM tb_order WHERE kd_order = '$kd_order'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $order = $result->fetch_assoc();
    } else {
        echo "Data order tidak ditemukan.";
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
    <title>Edit Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="container text-center mt-5">Edit Data Order</h1>
    
    <form action="proses_edit_order.php" method="post">
        <input type="hidden" name="kd_order" value="<?php echo $order["kd_order"]; ?>">
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $order["nama_barang"]; ?>" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $order["jumlah"]; ?>" required>
        </div>
        <div class="mb-3">
            <label for="tgl_order" class="form-label">Tanggal Order</label>
            <input type="date" class="form-control" id="tgl_order" name="tgl_order" value="<?php echo $order["tgl_order"]; ?>" required>
        </div>
        <div class="mb-3">
            <label for="kd_suplayer" class="form-label">Kode Suplayer</label>
            <input type="text" class="form-control" id="kd_suplayer" name="kd_suplayer" value="<?php echo $order["kd_suplayer"]; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="informasi.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
