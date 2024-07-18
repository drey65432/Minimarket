<?php
include 'db_connection.php'; // Include file koneksi ke database

if (isset($_POST['kd_return'])) {
    $kd_return = $_POST['kd_return'];

    // Query hapus data return berdasarkan kd_return
    $sql = "DELETE FROM tb_return WHERE kd_return = '$kd_return'";

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
