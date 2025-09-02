<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query hapus data dari tabel login
    $sql = "DELETE FROM login WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect kembali ke halaman data login
        header("Location: dataLogin.php?hapus=berhasil");
        exit();
    } else {
        echo "Gagal menghapus data: " . $conn->error;
    }
} else {
    echo "ID tidak ditemukan!";
}
?>
