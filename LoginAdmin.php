<?php
session_start();
include "config.php";

date_default_timezone_set("Asia/Jakarta"); // Set zona waktu

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Query login admin berdasarkan nama_lengkap dan password
    $sql = "SELECT * FROM login WHERE nama_lengkap = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare gagal: " . $conn->error);
    }
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        // Simpan session
        $_SESSION['nama_lengkap'] = $user['nama_lengkap'];
        $_SESSION['email'] = $user['email']; // tambahkan email
        $_SESSION['role'] = $user['role'];

        // Redirect sesuai role
        if ($user['role'] === 'yes') { // yes = admin
            header("Location: indexAdmin.php");
            exit;
        } else { // jika bukan admin
            header("Location: login.php");
            exit;
        }
    } else {
        $error = "Login gagal. Username atau password salah.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - PPG Digital Web</title>
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
    <h2 class="mb-4">Login Admin</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <form action="LoginAdmin.php" method="post">
        <div class="mb-3 text-start">
            <label for="username" class="form-label">Username :</label>
            <input type="text" name="username" id="username" class="form-control" required>
        </div>
        <div class="mb-3 text-start">
            <label for="password" class="form-label">Password :</label>
            <input type="password" name="password" id="password" class="form-control" required>
        </div>
        <button type="submit" name="login" class="btn btn-dark w-100">Masuk</button>
        <hr>
        <a class="text-dark" href="login.php">Masuk sebagai user</a>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
