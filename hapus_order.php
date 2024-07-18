<?php
include 'db_connection.php'; // Include file koneksi ke database

if (isset($_POST['kd_order'])) {
    $kd_order = $_POST['kd_order'];

    // Query hapus data order berdasarkan kd_order
    $sql = "DELETE FROM tb_order WHERE kd_order = '$kd_order'";

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
