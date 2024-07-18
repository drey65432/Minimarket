<?php
include 'db_connection.php'; // Include file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET["kd_suplayer"])) {
    $kd_suplayer = $_GET["kd_suplayer"];

    // Query untuk mengambil data suplayer berdasarkan kd_suplayer
    $sql = "SELECT * FROM tb_suplayer WHERE kd_suplayer = '$kd_suplayer'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $suplayer = $result->fetch_assoc();
    } else {
        echo "Data suplayer tidak ditemukan.";
        exit();
    }
} elseif ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kd_suplayer = $_POST["kd_suplayer"];
    $nm_suplayer = $_POST["nm_suplayer"];
    $alamat = $_POST["alamat"];
    $hp = $_POST["hp"];

    // Query untuk mengupdate data suplayer
    $sql = "UPDATE tb_suplayer SET nm_suplayer = '$nm_suplayer', alamat = '$alamat', hp = '$hp' WHERE kd_suplayer = '$kd_suplayer'";

    if ($conn->query($sql) === TRUE) {
        echo "Data suplayer berhasil diperbarui.";
        header("Location: informasi.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close(); // Tutup koneksi database
    exit();
} else {
    echo "Permintaan tidak valid.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Suplayer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <h1 class="container text-center mt-5">Edit Data Suplayer</h1>
    
    <form action="" method="post">
        <input type="hidden" name="kd_suplayer" value="<?php echo $suplayer["kd_suplayer"]; ?>">
        <div class="mb-3">
            <label for="nm_suplayer" class="form-label">Nama Suplayer</label>
            <input type="text" class="form-control" id="nm_suplayer" name="nm_suplayer" value="<?php echo $suplayer["nm_suplayer"]; ?>" required>
        </div>
        <div class="mb-3">
            <label for="alamat" class="form-label">Alamat</label>
            <textarea class="form-control" id="alamat" name="alamat" rows="3" required><?php echo $suplayer["alamat"]; ?></textarea>
        </div>
        <div class="mb-3">
            <label for="hp" class="form-label">NO Handphone</label>
            <input type="text" class="form-control" id="hp" name="hp" value="<?php echo $suplayer["hp"]; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="informasi.php" class="btn btn-secondary">Batal</a>
    </form>
</div>
</body>
</html>
