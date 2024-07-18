<?php
// Include file koneksi ke database
include 'db_connection.php';

// Proses hapus data barang
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $kd_barang = $_POST["kd_barang"];

    $sql_delete = "DELETE FROM tb_barang WHERE kd_barang = $kd_barang";

    if ($conn->query($sql_delete) === TRUE) {
        echo "<div class='alert alert-success' role='alert'>Barang berhasil dihapus.</div>";
        // Redirect kembali ke halaman barang.php setelah hapus
        echo "<meta http-equiv='refresh' content='2;url=barang.php'>";
    } else {
        echo "Error: " . $sql_delete . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hapus Barang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <!-- Konfirmasi hapus data barang -->
    <h1 class="mt-5">Hapus Data Barang</h1>
    <form action="" method="post" class="mt-3">
        <p>Anda yakin ingin menghapus barang ini?</p>
        <input type="hidden" name="kd_barang" value="<?php echo $_POST['kd_barang']; ?>">
        <button type="submit" name="delete" class="btn btn-danger">Hapus</button>
        <a href="barang.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>

<?php
$conn->close(); // Tutup koneksi database
?>
