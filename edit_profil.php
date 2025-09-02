<?php
include 'config.php';

if (!isset($_GET['id'])) {
    echo "ID tidak ditemukan!";
    exit();
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM login WHERE id = $id";
$result = $conn->query($sql);

if (!$result || $result->num_rows != 1) {
    echo "Data tidak ditemukan!";
    exit();
}

$data = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .form-container {
            width: 100%;
            max-width: 600px; /* Lebar form */
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100 bg-light">

    <div class="form-container">
        <h2 class="text-center mb-4">Edit Profil</h2>
        <form method="POST" action="proses_edit.php">
            <input type="hidden" name="id" value="<?= $data['id'] ?>">

            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama_lengkap" class="form-control" value="<?= $data['nama_lengkap'] ?>" required>
            </div>

            <div class="mb-3">
                <label>Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki" <?= $data['jenis_kelamin'] == 'Laki-laki' ? 'selected' : '' ?>>Laki-laki</option>
                    <option value="Perempuan" <?= $data['jenis_kelamin'] == 'Perempuan' ? 'selected' : '' ?>>Perempuan</option>
                </select>
            </div>

            <div class="mb-3">
                <label>No. Telepon</label>
                <input type="text" name="no_telepon" class="form-control" value="<?= $data['no_telepon'] ?>" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>" required>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">Simpan</button>
                <button type="button" class="btn btn-danger" onclick="window.location.href='profil.php?id=<?= $data['id'] ?>'">Batal</button>
            </div>
        </form>
    </div>

</body>
</html>
