<?php
include 'config.php'; // koneksi ke database

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal       = $_POST['tanggal'];
    $jam_mulai     = $_POST['jam_mulai'];
    $jam_selesai   = $_POST['jam_selesai'];
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $tempat        = $_POST['tempat'];
    $materi        = $_POST['materi'];
    $deskripsi     = $_POST['deskripsi'];

    $sql = "INSERT INTO jadwal (tanggal, jam_mulai, jam_selesai, nama_kegiatan, tempat, materi, deskripsi)
            VALUES ('$tanggal', '$jam_mulai', '$jam_selesai', '$nama_kegiatan', '$tempat', '$materi', '$deskripsi')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Jadwal berhasil disimpan!'); window.location.href='jadwalAdmin.php';</script>";
    } else {
        echo "Terjadi kesalahan: " . $conn->error;
    }
} else {
    echo "Metode tidak valid.";
}
?>
