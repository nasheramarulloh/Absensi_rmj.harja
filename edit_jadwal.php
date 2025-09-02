<?php
include 'config.php'; // koneksi ke database

// Ambil ID dari parameter GET
if (!isset($_GET['id'])) {
    header('Location: buatJadwal.php');
    exit;
}

$id = intval($_GET['id']);

// Ambil data dari database
$query = "SELECT * FROM jadwal WHERE id = $id";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) === 0) {
    echo "Data tidak ditemukan.";
    exit;
}

$row = mysqli_fetch_assoc($result);

// Proses update jika tombol simpan ditekan
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tanggal       = $_POST['tanggal'];
    $jam_mulai     = $_POST['jam_mulai'];
    $jam_selesai   = $_POST['jam_selesai'];
    $nama_kegiatan = $_POST['nama_kegiatan'];
    $tempat        = $_POST['tempat'];
    $materi        = $_POST['materi'];
    $deskripsi     = $_POST['deskripsi'];

    $update = "UPDATE jadwal SET 
        tanggal = '$tanggal',
        jam_mulai = '$jam_mulai',
        jam_selesai = '$jam_selesai',
        nama_kegiatan = '$nama_kegiatan',
        tempat = '$tempat',
        materi = '$materi',
        deskripsi = '$deskripsi'
        WHERE id = $id";

    if (mysqli_query($conn, $update)) {
        header('Location: jadwalAdmin.php');
        exit;
    } else {
        echo "Gagal memperbarui data.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Jadwal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
      <style>
        .form-wrapper {
            width: 100%;
            max-width: 900px; /* Lebar diperbesar */
            padding: 40px;
            background-color: #f8f9fa;
            border-radius: 12px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 2.2rem;
        }

        label {
            font-size: 1.15rem;
        }

        .btn {
            font-size: 1.1rem;
            padding: 10px 25px;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center min-vh-100 bg-light">
    <div class="form-wrapper">
        <h2 class="mb-4 text-center">Edit Jadwal</h2>
        <form method="post">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Tanggal</label>
                <input type="date" name="tanggal" class="form-control" value="<?= $row['tanggal'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Jam Mulai</label>
                <input type="time" name="jam_mulai" class="form-control" value="<?= $row['jam_mulai'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                 <label>Jam Selesai</label>
                <input type="time" name="jam_selesai" class="form-control" value="<?= $row['jam_selesai'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Nama Kegiatan</label>
                <input type="text" name="nama_kegiatan" class="form-control" value="<?= $row['nama_kegiatan'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Tempat</label>
                <input type="text" name="tempat" class="form-control" value="<?= $row['tempat'] ?>" required>
            </div>
            <div class="col-md-6 mb-3">
                <label>Materi</label>
                <input type="text" name="materi" class="form-control" value="<?= $row['materi'] ?>" required>
            </div>
            <div class="col-md-12 mb-3">
                <label>Deskripsi</label>
                <textarea name="deskripsi" class="form-control"><?= $row['deskripsi'] ?></textarea>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary me-3">Simpan</button>
                <a href="jadwalAdmin.php" class="btn btn-secondary">Batal</a>
            </div>
         </div>
        </form>
    </div>
</body>
</html>
