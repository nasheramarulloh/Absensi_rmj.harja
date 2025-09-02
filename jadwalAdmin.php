<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Halaman Utama</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
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
            <a class="navbar-brand ps-3" href="#">Dashbroad Atur Jadwal</a>
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
                            <a class="nav-link" href="dataPraRemaja.php">
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
                            <a class="nav-link" href="#">
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
                        <h1 class="mt-3">Halaman Membuat Jadwal</h1>
                        <hr>
                        <div class="row">
                            <div class="col-xl-20 col-md-20">
                                <div class="card bg-dark text-white mb-2">
                                   <button type="button" class="btn btn-dark" onclick="window.location.href='buatJadwal.php'">Buat Jadwal Baru</button>
                                </div>
                            </div>
                            <div class="mb-3 col-md-20 mt-2">
                                <input type="text" id="searchBox" class="form-control" placeholder="Cari data...">
                            </div>
                            <div class="table-responsive">
                                <table id="example" class="col-md-20 table table-bordered table-striped table-hover ">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">Hari & Tanggal</th>
                                        <th scope="col">Jam</th>
                                        <th scope="col">Nama Kegiatan</th>
                                        <th scope="col">Tempat</th>
                                        <th scope="col">Materi</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Opsi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include 'config.php'; // Koneksi ke database

                                    $sql = "SELECT * FROM jadwal ORDER BY tanggal ASC, jam_mulai ASC";
                                    $result = $conn->query($sql);

                                    if ($result && $result->num_rows > 0):
                                        while($row = $result->fetch_assoc()):
                                    ?>
                                    <tr>
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
                                        <td><?= substr($row['jam_mulai'], 0, 5) . ' - ' . substr($row['jam_selesai'], 0, 5) ?></td>
                                        <td><?= htmlspecialchars($row['nama_kegiatan']) ?></td>
                                        <td><?= htmlspecialchars($row['tempat']) ?></td>
                                        <td><?= htmlspecialchars($row['materi']) ?></td>
                                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                                        <td>
                                            <a href="edit_jadwal.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning m-1">Edit</a>
                                             <a href="hapus_jadwal.php?id=<?= $row['id']; ?>" 
                                                class="btn btn-sm btn-danger"
                                                onclick="return confirm('Yakin ingin menghapus jadwal ini?');">Hapus</a>
                                            </td>
                                    </tr>
                                    <?php
                                        endwhile;
                                    else:
                                    ?>
                                    <tr>
                                        <td colspan="7">Belum ada jadwal yang tersedia.</td>
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
