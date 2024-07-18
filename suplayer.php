<?php
include 'db_connection.php';

// Proses tambah data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add"])) {
    $kd_suplayer = $_POST["kd_suplayer"];
    $nm_suplayer = $_POST["nm_suplayer"];
    $alamat = $_POST["alamat"];
    $hp = $_POST["hp"];

    $sql = "INSERT INTO tb_suplayer (kd_suplayer, nm_suplayer, alamat, hp) VALUES ('$kd_suplayer', '$nm_suplayer', '$alamat', '$hp')";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Suplayer berhasil ditambahkan</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Proses hapus data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete"])) {
    $kd_suplayer = $_POST["kd_suplayer"];

    $sql = "DELETE FROM tb_suplayer WHERE kd_suplayer=$kd_suplayer";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='alert alert-success'>Suplayer berhasil dihapus</div>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Ambil data dari database
$sql = "SELECT * FROM tb_suplayer";
$result = $conn->query($sql);
?>

<?php include 'navbar.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suplayer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Data Suplayer</h1>


    <!-- Tabel data suplayer -->
    <h2 class="mt-5">List Suplayer</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Kode Suplayer</th>
                <th>Nama Suplayer</th>
                <th>Alamat</th>
                <th>Nomor HP</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row["kd_suplayer"]; ?></td>
                        <td><?php echo $row["nm_suplayer"]; ?></td>
                        <td><?php echo $row["alamat"]; ?></td>
                        <td><?php echo $row["hp"]; ?></td>
                        <td>
                            <form action="suplayer.php" method="post" style="display:inline-block;">
                                <input type="hidden" name="kd_suplayer" value="<?php echo $row["kd_suplayer"]; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                            <a href="edit_suplayer.php?kd_suplayer=<?php echo $row["kd_suplayer"]; ?>" class="btn btn-warning btn-sm">Edit</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">Tidak ada data</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
 <!-- Form tambah data -->
  <h2 class="mt-5">Tambah Data Suplayer</h2>
 <form action="suplayer.php" method="post" class="mt-3">
        <div class="mb-3">
            <label for="kd_suplayer" class="form-label">Kode Suplayer</label>
            <input type="text" class="form-control" id="kd_suplayer" name="kd_suplayer" required>
        </div>
        <div class="mb-3">
            <label for="nm_suplayer" class="form-label">Nama Suplayer</label>
            <input type="text" class="form-control" id="nm_suplayer" name="nm_suplayer" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat"></textarea>
        </div>
        <div class="mb-3">
            <label for="hp" class="form-label">Nomor HP</label>
            <input type="text" class="form-control" id="hp" name="hp">
        </div>
        <button type="submit" name="add" class="btn btn-primary">Simpan</button>
    </form>

</div>
</body>
</html>

<?php
$conn->close();
?>
