<?php
session_start();
include 'config.php';


// Ambil semua data user dari tabel login
$sql = "SELECT * FROM login";
$result = $conn->query($sql);

// Ambil jumlah user login dari tabel login
$sql_count = "SELECT COUNT(*) AS total_user FROM login";
$result_count = $conn->query($sql_count);
$data_count = $result_count->fetch_assoc();
$total_user = $data_count['total_user'];

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
         <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Bootstrap Icons CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            .profile-header {
                position: relative;
            }
            .profile-pic {
                width: 100px;
                height: 100px;
                object-fit: cover;
                position: absolute;
                bottom: -50px;
                left: 20px;
                border: 3px solid white;
            }
            .edit-btn {
                position: absolute;
                bottom: 10px;
                right: 10px;
            }
            .card-body {
                margin-top: 60px;
            }
            .dropdown-toggle::after {
                display: none; /* hilangkan panah kecil */
            }

        </style>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">Dashbroad Admin</a>
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
                            <a class="nav-link" href="jadwalAdmin.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-calendar2-plus-fill"></i></div>
                                Atur Jadwal
                            </a>
                            <a class="nav-link" href="#">
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
                                <h1 class="m-0">Data Semua Pengguna</h1>
                                <a>
                                    <input type="text" id="searchBox" class="form-control" placeholder="Cari data...">
                                </a>
                            </div>
                        <hr>
                        <div class="row">
                            <div class="col-xl-20 col-md-20 mb-4">
                                <div class="card shadow-sm" style="background-image: url('img/sampul3.jpg'); background-size: cover; background-position: center; color: white;">
                                    <div class="card-body d-flex align-items-center" style="background-color: rgba(0, 0, 0, 1); border-radius: 0.5rem;">
                                        <!-- ICON -->
                                        <div class="me-3">
                                            <i class="bi bi-people-fill fs-1 text-white"></i>
                                        </div>
                                        <!-- TEXT -->
                                        <div >
                                            <h5 class="card-title mb-1">Total Pengguna</h5>
                                            <h3 class="mb-0"><?= $total_user ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <?php while ($data = $result->fetch_assoc()) { ?>
                            <div class="col-xl-4 col-md-4 mb-4 user-card" data-search="<?= strtolower($data['nama_lengkap'] . ' ' . $data['jenis_kelamin'] . ' ' . $data['no_telepon'] . ' ' . $data['email'] . ' ' . $data['role']) ?>">
                                <div class="card shadow-sm">
                                    <div class="profile-header position-relative">
                                        <img src="img/sampul2.jpg" class="card-img-top" alt="Cover">

                                        <!-- Tombol tiga titik dengan dropdown -->
                                        <div class="dropdown position-absolute top-0 end-0 m-2">
                                            <button class="btn btn-dark rounded-circle dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                                                <li>
                                                    <a class="dropdown-item text-danger" href="hapus_profil.php?id=<?= $data['id'] ?>" onclick="return confirm('Yakin ingin menghapus profil ini?')">
                                                        <i class="bi bi-trash-fill me-2"></i>Hapus Profil
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>

                                        <!-- Foto profil -->
                                        <img src="img/profil.jpg" class="rounded-circle profile-pic" alt="Foto Profil">
                                    </div>
                                    
                                    <div class="card-body">
                                        <h4 class="card-title mb-3"><?= htmlspecialchars($data['nama_lengkap']) ?></h4>
                                        <p class="mb-2"><i class="bi bi-person-fill"></i> : <?= $data['jenis_kelamin'] ?></p>
                                        <p class="mb-2"><i class="bi bi-telephone-fill"></i> : <?= $data['no_telepon'] ?></p>
                                        <p><i class="bi bi-envelope-fill"></i> : <?= $data['email'] ?></p>
                                        <p><i class="bi bi-door-closed-fill"></i> : <?= $data['tanggal_masuk'] ?></p>
                                        <p><i class="bi bi-clock-history"></i> Terakhir diubah : <?= $data['updated_at'] ?></p>
                                        <p><i class="bi bi-door-open"></i> : <?= $data['tanggal_keluar'] ?></p>
                                        <p><i class="bi bi-shield-lock-fill"></i> Member : 
                                            <?= ($data['role'] === 'yes') ? '<span class="text-success fw-bold">Admin</span>' : '<span class="text-danger fw-bold">User</span>'; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
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
        </script>
       <script>
  const searchBox = document.getElementById("searchBox");
  const searchBtn = document.getElementById("searchBtn");
  const cards = document.querySelectorAll(".user-card");

  function filterCards() {
    const keyword = searchBox.value.toLowerCase();
    cards.forEach(function (card) {
      const text = card.getAttribute("data-search");
      if (text.includes(keyword)) {
        card.style.display = "";
      } else {
        card.style.display = "none";
      }
    });
  }

  // Realtime: saat mengetik
  searchBox.addEventListener("input", filterCards);

  // Manual: saat tombol diklik
  searchBtn.addEventListener("click", filterCards);
</script>


    </body>
</html>
