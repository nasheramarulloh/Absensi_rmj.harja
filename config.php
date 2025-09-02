<?php
$host = "localhost"; // Host database (biasanya "localhost")
$user = "root"; // Username MySQL (default: "root" jika di XAMPP)
$password = ""; // Password MySQL (kosong jika di XAMPP)
$database = "remaja_hrj"; // Nama database yang digunakan

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $database, 3307);

// Cek apakah koneksi berhasil
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
