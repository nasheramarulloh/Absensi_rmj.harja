<?php
include "config.php";


// Ambil bulan dan tahun sekarang
$bulan_ini = date('Y-m'); // contoh: 2025-08

// Ambil data peserta unik per kategori acara untuk bulan ini
$sql = "
    SELECT 
        acara,
        COUNT(DISTINCT nama_lengkap) AS total
    FROM pra_remaja
    WHERE DATE_FORMAT(tanggal, '%Y-%m') = '$bulan_ini'
    GROUP BY acara
";

$result = $conn->query($sql);

// Siapkan array default
$data = [
    'Kelompok' => 0,
    'Desa' => 0,
    'Daerah' => 0,
    'Lainnya' => 0
];

// Masukkan hasil query ke array
while ($row = $result->fetch_assoc()) {
    $acara = $row['acara'];
    $total = $row['total'];
    if (isset($data[$acara])) {
        $data[$acara] = $total;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Halaman Utama</title>
        <!-- Bootstrap CSS -->

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Bootstrap Icons CDN -->

        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        

        <style>
             table {
            text-align: center;
            vertical-align: middle;
        }
        .table-responsive {
        max-height: 400px;
        overflow-y: auto;
        position: relative;
    }
        </style>
    </head>
    <body class="sb-nav-fixed">
         <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">Dashbroad Absensi</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="bi bi-justify"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person m-1"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="logout.php">Keluar</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="indexAdmin.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-house-door-fill"></i></div>
                                Halaman Utama
                            </a>
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="bi bi-database-fill"></i></div>
                                Data Pra Remaja
                            </a>
                            <a class="nav-link" href="dataRemaja.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-database-fill"></i></div>
                                Data Remaja
                            </a>
                            <a class="nav-link" href="dataPraNikah.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-database-fill"></i></div>
                                Data Pra Nikah
                            </a>
                            <a class="nav-link" href="jadwalAdmin.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-calendar2-plus-fill"></i></div>
                                Atur Jadwal
                            </a>
                            <a class="nav-link" href="dataLogin.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-database-check"></i></div>
                                Data Login
                            </a>
                             <a class="nav-link" href="tampilanUlasan.php">
                                    <div class="sb-nav-link-icon"><i class="bi bi-star-half"></i></div>
                                    Ulasan User
                                </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                                <h1 class="m-0">Data Absensi Pra Remaja</h1>
                                <a class="btn bg-primary-subtle shadow-sm">
                                    <small class="text-black">Acara Perbulan <?= date('F Y') ?></small>
                                </a>
                            </div>
                        <hr>
                        <div class="row">
                            <?php foreach ($data as $kategori => $jumlah): ?>
                                    <div class="col-xl-3 col-md-4 mb-3">
                                        <div class="card bg-primary-subtle text-dark shadow-card h-100">
                                            <div class="card-body text-center">
                                                <h5 class="card-title mb-2"><?= htmlspecialchars($kategori) ?></h5>
                                                <p class="fs-1 m-0"><?= $jumlah ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="mb-3 col-md-20 mt-2">
                                <input type="text" id="searchBox" class="form-control" placeholder="Cari data...">
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="col-md-20 table table-bordered table-striped table-hover ">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Usia</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Keterangan</th>
                                        <th scope="col">Alasan</th>
                                        <th scope="col">Acara</th>
                                        <th scope="col">Jam</th>
                                        <th scope="col">Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'config.php'; // Koneksi ke database

                                    $query = "SELECT id, nama_lengkap, jenis_kelamin, usia, status, acara, keterangan, alasan, tanggal, jam FROM pra_remaja ORDER BY tanggal DESC";
                                        $result = $conn->query($query);

                                    if ($result && $result->num_rows > 0):
                                        while($row = $result->fetch_assoc()):
                                    ?>
                                    <tr>
                                        <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                                        <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
                                        <td><?= htmlspecialchars($row['usia']) ?></td>
                                        <td><?= htmlspecialchars($row['status']) ?></td>
                                        <td><?= htmlspecialchars($row['keterangan']) ?></td>
                                        <td><?= htmlspecialchars($row['alasan']) ?></td>
                                        <td><?= htmlspecialchars($row['acara']) ?></td>
                                        <td><?= htmlspecialchars($row['jam']) ?></td>
                                        <td>
                                            <?php
                                                $hari = ['Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa', 'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat', 'Saturday' => 'Sabtu'];
                                                $bulan = ['Jan'=>'Januari', 'Feb'=>'Februari', 'Mar'=>'Maret', 'Apr'=>'April', 'May'=>'Mei', 'Jun'=>'Juni', 'Jul'=>'Juli', 'Aug'=>'Agustus', 'Sep'=>'September', 'Oct'=>'Oktober', 'Nov'=>'November', 'Dec'=>'Desember'];

                                                $timestamp = strtotime($row['tanggal']);
                                                $hari_indo = $hari[date('l', $timestamp)];
                                                $tanggal = date('d', $timestamp);
                                                $bulan_indo = $bulan[date('M', $timestamp)];
                                                $tahun = date('Y', $timestamp);

                                                echo "$hari_indo, $tanggal $bulan_indo $tahun";
                                            ?>
                                        </td>
                                        
                                    </tr>
                                    <?php
                                        endwhile;
                                    else:
                                    ?>
                                    <tr>
                                        <td colspan="10">Belum ada jadwal yang tersedia.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>

                            </table>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
        <script>
            window.addEventListener("beforeunload", function () {
    navigator.sendBeacon("logout_ajax.php");
});

$("#searchBox").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("#example tbody tr").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
        </script>

    </body>
</html>
