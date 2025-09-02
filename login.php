<?php
session_start();
include "config.php"; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Cek apakah email sudah terdaftar
    $sql = "SELECT * FROM login WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        
        // Cek apakah password sesuai (tanpa hashing)
        if ($password === $row['password']) {
            // Simpan sesi login
            $_SESSION['email'] = $email;
            $_SESSION['user_id'] = $row['id'];

            // **Update tanggal_masuk ke waktu saat ini**
            $update_sql = "UPDATE login SET tanggal_masuk = NOW() WHERE email = ?";
            $update_stmt = $conn->prepare($update_sql);
            $update_stmt->bind_param("s", $email);
            $update_stmt->execute();
            $update_stmt->close();

            echo "<script>
                    alert('Login berhasil! Selamat datang, $email');
                    window.location='index.php';
                  </script>";
            exit();
        } else {
            echo "<script>
                    alert('Password salah! Silakan coba lagi.');
                    window.location='login.php';
                  </script>";
        }
    } else {
        echo "<script>
                alert('Email tidak ditemukan! Silakan daftar terlebih dahulu.');
                window.location='register.php';
              </script>";
    }

    $stmt->close();
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PPG Digital Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
        }
        .login-container {
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
    <div class="login-container text-center">
        <h2 class="mb-4">Halaman Login</h2>
        <form action="login.php" method="post">
            <div class="mb-3 text-start">
                <label for="email" class="form-label">Email :</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="mb-3 text-start">
                <label for="password" class="form-label">Password :</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" name="login" class="btn btn-dark w-100">Masuk</button>
            <a href="lupaPassword.php" class="btn btn-outline-dark w-100 mt-2">Lupa Password</a>
            <a href="register.php" class="btn btn-outline-dark w-100 mt-2">Belum Punya akun? Daftar</a>
            <hr>
            <a class="text-dark" href="LoginAdmin.php">Masuk Jadi Admin</a>
        </form>
    </div>
</body>
</html>