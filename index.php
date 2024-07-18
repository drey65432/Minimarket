<?php
include 'db_connection.php';

// Proses tambah data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $nama_barang = $_POST["nama_barang"];
    $jenis_barang = $_POST["jenis_barang"];
    $harga = $_POST["harga"];
    $jumlah = $_POST["jumlah"];
    $keterangan = $_POST["keterangan"];

    $sql = "INSERT INTO tb_barang (nama_barang, jenis_barang, harga, jumlah, keterangan) VALUES ('$nama_barang', '$jenis_barang', '$harga', '$jumlah', '$keterangan')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Proses hapus data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $kd_barang = $_POST["kd_barang"];

    $sql = "DELETE FROM tb_barang WHERE kd_barang=$kd_barang";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil data dari database
$sql = "SELECT * FROM tb_barang";
$result = $conn->query($sql);
?>
<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minimarket</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Data Produk</h1>

    <!-- Form tambah data -->
    <form action="" method="post" class="mt-3">
        <div class="mb-3">
            <label for="nama_barang" class="form-label">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang" required>
        </div>
        <div class="mb-3">
            <label for="jenis_barang" class="form-label">Jenis Barang</label>
            <input type="text" class="form-control" id="jenis_barang" name="jenis_barang">
        </div>
        <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" required>
        </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" id="jumlah" name="jumlah" required>
        </div>
        <div class="mb-3">
            <label for="keterangan" class="form-label">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan"></textarea>
        </div>
        <button type="submit" name="add" class="btn btn-primary">Simpan</button>
    </form>

    <!-- Tabel data barang -->
    <h2 class="mt-5">List Barang</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jenis Barang</th>
                <th>Harga</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["kd_barang"]; ?></td>
                        <td><?php echo $row["nama_barang"]; ?></td>
                        <td><?php echo $row["jenis_barang"]; ?></td>
                        <td><?php echo $row["harga"]; ?></td>
                        <td><?php echo $row["jumlah"]; ?></td>
                        <td><?php echo $row["keterangan"]; ?></td>
                        <td>
                            <form action="" method="post" style="display:inline-block;">
                                <input type="hidden" name="kd_barang" value="<?php echo $row["kd_barang"]; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                            <a href="edit.php?kd_barang=<?php echo $row["kd_barang"]; ?>" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
</body>
</html>

<?php
$conn->close();
?>
