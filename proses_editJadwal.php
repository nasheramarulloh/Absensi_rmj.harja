<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id            = intval($_POST['id']);
    $tanggal       = $_POST['tanggal'];
    $jam_mulai     = $_POST['jam_mulai'];
    $jam_selesai   = $_POST['jam_selesai'];
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $tempat        = $_POST['tempat'];
    $materi        = $_POST['materi'];
    $deskripsi     = $_POST['deskripsi'];

    // Validasi sederhana: pastikan jam selesai lebih dari jam mulai
    if ($jam_selesai <= $jam_mulai) {
        echo "<script>alert('Jam selesai harus lebih besar dari jam mulai.'); window.history.back();</script>";
        exit;
    }

    // Update data ke database
    $sql = "UPDATE jadwal SET 
                tanggal = '$tanggal',
                jam_mulai = '$jam_mulai',
                jam_selesai = '$jam_selesai',
                nama_kegiatan = '$nama_kegiatan',
                tempat = '$tempat',
                materi = '$materi',
                deskripsi = '$deskripsi'
            WHERE id = $id";

    if (mysqli_query($conn, $sql)) {
        header('Location: buatJadwal.php');
        exit;
    } else {
        echo "Gagal menyimpan perubahan: " . mysqli_error($conn);
    }
} else {
    header('Location: buatJadwal.php');
    exit;
}
?>
