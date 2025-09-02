<?php
session_start();
include "config.php"; // Koneksi ke database

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Update status menjadi offline
    $update_sql = "UPDATE login SET status = 'Offline' WHERE email = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("s", $email);
    $update_stmt->execute();
    $update_stmt->close();
}
?>
