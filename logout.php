<?php
session_start();
include "config.php"; // Koneksi ke database

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // Query hanya menyimpan tanggal & jam keluar
    $update_sql = "UPDATE login SET tanggal_keluar = NOW() WHERE email = ?";
    $update_stmt = $conn->prepare($update_sql);

    if ($update_stmt) {
        $update_stmt->bind_param("s", $email);
        $update_stmt->execute();
        $update_stmt->close();
    } else {
        die("Query error: " . $conn->error);
    }
}

// Hapus sesi user
session_unset();
session_destroy();
header("Location: login.php");
exit();
?>
