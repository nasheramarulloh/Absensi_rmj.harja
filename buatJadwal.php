<!DOCTYPE html>
<html>
<head>
    <title>Atur Jadwal</title>
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
        <h2 class="mb-4 text-center">Atur Jadwal Baru</h2>
        <form method="POST" action="proses_tambah_jadwal.php">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="tanggal" class="form-label">Hari dan Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="nama_kegiatan" class="form-label">Nama Kegiatan</label>
                    <input type="text" name="nama_kegiatan" id="nama_kegiatan" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jam_mulai" class="form-label">Jam Mulai</label>
                    <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="jam_selesai" class="form-label">Jam Selesai</label>
                    <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="tempat" class="form-label">Tempat</label>
                    <input type="text" name="tempat" id="tempat" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="materi" class="form-label">Materi</label>
                    <input type="text" name="materi" id="materi" class="form-control" required>
                </div>

                <div class="col-12 mb-4">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary me-3">Simpan Jadwal</button>
                <button type="button" class="btn btn-danger" onclick="window.location.href='jadwalAdmin.php'">Batal Simpan</button>
            </div>
        </form>
    </div>
</body>
</html>
