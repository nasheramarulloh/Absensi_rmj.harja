<?php
include "config.php"; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan semua input form ada
    $nama = isset($_POST['nama_lengkap']) ? $_POST['nama_lengkap'] : "";
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $nomor_telepon = isset($_POST['no_telepon']) ? $_POST['no_telepon'] : "";
    $jenis_kelamin = isset($_POST['jenis_kelamin']) ? $_POST['jenis_kelamin'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : "";

    // Jika salah satu field kosong, tampilkan pesan error
    if (empty($nama) || empty($email) || empty($nomor_telepon) || empty($jenis_kelamin) || empty($password) || empty($confirm_password)) {
        echo "<script>alert('Semua field harus diisi!'); window.location='register.php';</script>";
        exit();
    }

    // Periksa apakah password dan konfirmasi password cocok
    if ($password !== $confirm_password) {
        echo "<script>alert('Konfirmasi password tidak cocok!'); window.location='register.php';</script>";
        exit();
    }

    // Cek apakah email sudah terdaftar
    $checkEmail = "SELECT * FROM login WHERE email = ?";
    $stmtCheck = $conn->prepare($checkEmail);
    
    if (!$stmtCheck) {
        die("Error dalam query: " . $conn->error);
    }

    $stmtCheck->bind_param("s", $email);
    $stmtCheck->execute();
    $resultCheck = $stmtCheck->get_result();

    if ($resultCheck->num_rows > 0) {
        echo "<script>alert('Email sudah terdaftar! Silakan login.'); window.location='login.php';</script>";
        exit();
    }

    // Simpan password tanpa hash sesuai keinginan Anda
    $plain_password = $password;

    // Simpan ke database (tanggal_masuk otomatis ke waktu saat ini, tanggal_keluar NULL)
    $sql = "INSERT INTO login (nama_lengkap, email, no_telepon, jenis_kelamin, password, tanggal_masuk, tanggal_keluar) 
        VALUES (?, ?, ?, ?, ?, NOW(), NULL)";
    $stmt = $conn->prepare($sql);
    
    if (!$stmt) {
        die("Error dalam query: " . $conn->error);
    }

    $stmt->bind_param("sssss", $nama, $email, $nomor_telepon, $jenis_kelamin, $plain_password);

    if ($stmt->execute()) {
        // Masukkan nomor telepon ke dalam tabel kategori_akun
        $sqlKategori = "INSERT INTO kategori_akun (no_telepon) VALUES (?)";
        $stmtKategori = $conn->prepare($sqlKategori);
        
        if ($stmtKategori) {
            $stmtKategori->bind_param("s", $nomor_telepon);
            $stmtKategori->execute();
            $stmtKategori->close();
        }

        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.php';</script>";
    } else {
        echo "<script>alert('Registrasi gagal!');</script>";
    }

    // Tutup statement
    $stmt->close();
    $stmtCheck->close();
}

// Tutup koneksi database
$conn->close();
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - PPG Digital Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
        }
        .register-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>

<div class="register-container text-center bg-white">
    <h2 class="mb-4">Halaman Registrasi</h2>
    <form action="register.php" method="post">
        <div class="mb-2 text-start">
            <label class="form-label">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="form-control" required>
        </div>
        <div class="mb-2 text-start">
            <label class="form-label">Jenis Kelamin</label>
            <select name="jenis_kelamin" class="form-control" required>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
        </div>
        <div class="mb-2 text-start">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-2 text-start">
            <label class="form-label">Nomor Telepon</label>
            <input type="text" name="no_telepon" class="form-control" required>
        </div>
        <div class="mb-3 text-start">
            <label class="form-label">Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3 text-start">
            <label class="form-label">Konfirmasi Password</label>
            <input type="password" name="confirm_password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-dark w-100">Daftar</button>
        <a href="login.php" class="btn btn-outline-dark w-100 mt-2">Sudah punya akun? Login</a>
    </form>
</div>

</body>
</html>
