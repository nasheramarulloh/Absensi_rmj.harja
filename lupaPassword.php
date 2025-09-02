<?php
session_start();
include "config.php"; // Koneksi ke database

// Jika form dikirim (POST)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Cek apakah password dan konfirmasi password sama
    if ($new_password !== $confirm_password) {
        echo "<script>alert('Konfirmasi password tidak sesuai!');</script>";
    } else {
        // Cek apakah email terdaftar
        $sql = "SELECT * FROM login WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Update password
            $sql_update = "UPDATE login SET password = ? WHERE email = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("ss", $new_password, $email);
            
            if ($stmt_update->execute()) {
                echo "<script>alert('Password berhasil diubah! Silakan login.'); window.location.href = 'login.php';</script>";
            } else {
                echo "<script>alert('Gagal mengubah password!');</script>";
            }
            
            $stmt_update->close();
        } else {
            echo "<script>alert('Email tidak ditemukan!');</script>";
        }
        
        $stmt->close();
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - PPG Digital Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .reset-container {
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

    <div class="reset-container text-center">
        <h2 class="mb-4">Reset Password</h2>
        <form action="lupaPassword.php" method="post">
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email :</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3 text-start">
                <label for="new_password" class="form-label">Password Baru :</label>
                <input type="password" name="new_password" id="new_password" class="form-control" required>
            </div>
            <div class="mb-3 text-start">
                <label for="confirm_password" class="form-label">Konfirmasi Password :</label>
                <input type="password" name="confirm_password" id="confirm_password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-dark w-100">Ubah Password</button>
            <a href="login.php" class="btn btn-outline-dark w-100 mt-2">Kembali ke Login</a>
        </form>
    </div>

</body>
</html>
