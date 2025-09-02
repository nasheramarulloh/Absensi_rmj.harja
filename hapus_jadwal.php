<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Hapus data
    $query = "DELETE FROM jadwal WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        header("Location: jadwalAdmin.php?status=sukses");
        exit();
    } else {
        echo "Gagal menghapus data: " . mysqli_error($conn);
    }
} else {
    echo "ID tidak ditemukan.";
}
?>
