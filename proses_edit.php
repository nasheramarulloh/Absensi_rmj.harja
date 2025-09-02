<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id            = intval($_POST['id']);
    $nama_lengkap  = $_POST['nama_lengkap'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $no_telepon    = $_POST['no_telepon'];
    $email         = $_POST['email'];

    // Cek apakah email sudah digunakan oleh user lain
    $cek = $conn->query("SELECT id FROM login WHERE email = '$email' AND id != $id");

    if ($cek && $cek->num_rows > 0) {
        // Tampilkan pesan alert dan kembali ke halaman sebelumnya
        echo "<script>
            alert('Gagal mengubah data: Email \"$email\" sudah digunakan oleh pengguna lain.');
            window.history.back();
        </script>";
        exit();
    }

    $sql = "UPDATE login SET 
                nama_lengkap = '$nama_lengkap',
                jenis_kelamin = '$jenis_kelamin',
                no_telepon = '$no_telepon',
                email = '$email',
                updated_at = NOW()
            WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        header("Location: profil.php?id=$id&status=berhasil");
        exit();
    } else {
        echo "<script>
            alert('Gagal mengubah data: " . addslashes($conn->error) . "');
            window.history.back();
        </script>";
    }
}
?>
