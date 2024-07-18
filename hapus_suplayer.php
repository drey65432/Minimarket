<?php
include 'db_connection.php'; // Include file koneksi ke database

if (isset($_POST['kd_suplayer'])) {
    $kd_suplayer = $_POST['kd_suplayer'];

    // Query hapus data suplayer berdasarkan kd_suplayer
    $sql = "DELETE FROM tb_suplayer WHERE kd_suplayer = '$kd_suplayer'";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to informasi.php after successful deletion
        header("Location: informasi.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close(); // Tutup koneksi database
?>
