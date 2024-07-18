<?php
include 'db_connection.php'; // Include file koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update"])) {
    // Ambil data yang dikirim dari form
    $kd_barang = $_POST["kd_barang"];
    $nama_barang = $_POST["nama_barang"];
    $jenis_barang = $_POST["jenis_barang"];
    $harga = $_POST["harga"];
    $jumlah = $_POST["jumlah"];
    $keterangan = $_POST["keterangan"];

    // Penanganan gambar
    $gambar = $_FILES["gambar"]["name"];
    $gambar_tmp = $_FILES["gambar"]["tmp_name"];
    $folder = "images/";

    // Jika pengguna mengunggah gambar baru
    if ($gambar) {
        // Hapus gambar lama jika ada
        $sql_select_gambar = "SELECT gambar FROM tb_barang WHERE kd_barang = $kd_barang";
        $result = $conn->query($sql_select_gambar);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $gambar_lama = $row["gambar"];
            if ($gambar_lama != "default.jpg") {
                unlink($folder . $gambar_lama); // Hapus gambar lama dari direktori
            }
        }

        // Upload gambar baru
        move_uploaded_file($gambar_tmp, $folder . $gambar);

        // Query untuk update data barang termasuk gambar baru
        $sql_update = "UPDATE tb_barang SET 
                        nama_barang = '$nama_barang', 
                        jenis_barang = '$jenis_barang', 
                        harga = '$harga', 
                        jumlah = '$jumlah', 
                        keterangan = '$keterangan', 
                        gambar = '$gambar' 
                        WHERE kd_barang = $kd_barang";
    } else {
        // Jika tidak mengunggah gambar baru, update data tanpa mengubah gambar
        $sql_update = "UPDATE tb_barang SET 
                        nama_barang = '$nama_barang', 
                        jenis_barang = '$jenis_barang', 
                        harga = '$harga', 
                        jumlah = '$jumlah', 
                        keterangan = '$keterangan' 
                        WHERE kd_barang = $kd_barang";
    }

    if ($conn->query($sql_update) === TRUE) {
        // Redirect kembali ke halaman barang.php setelah berhasil update
        header("Location: barang.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close(); // Tutup koneksi database
?>
