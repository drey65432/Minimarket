<?php
include 'db_connection.php';

$kd_barang = $_GET["kd_barang"];

// Ambil data barang berdasarkan kd_barang
$sql = "SELECT * FROM tb_barang WHERE kd_barang=$kd_barang";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Proses update data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_barang = $_POST["nama_barang"];
    $jenis_barang = $_POST["jenis_barang"];
    $harga = $_POST["harga"];
    $jumlah = $_POST["jumlah"];
    $keterangan = $_POST["keterangan"];

    $sql = "UPDATE tb_barang SET nama_barang='$nama_barang', jenis_barang='$jenis_barang', harga='$harga', jumlah='$jumlah', keterangan='$keterangan' WHERE kd_barang=$kd_barang";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    header("Location: index.php");
    exit();
}

$conn->close();
?>
<?php include 'navbar.php'; ?>
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
    <h1 class="mt-5">Edit Barang</h1>

    <!-- Form edit data -->
    <form action="" method="post" class="mt-3">
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $row['nama_barang']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="jenis_barang" class="form-label">Jenis Barang</label>
            <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" value="<?php echo $row['jenis_barang']; ?>">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="<?php echo $row['harga']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" value="<?php echo $row['jumlah']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan"><?php echo $row['keterangan']; ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
