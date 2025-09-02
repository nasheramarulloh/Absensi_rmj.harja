<?php
session_start();
include 'auth.php';
include 'config.php';

// Cek jika belum login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Bootstrap Icons CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
        
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="#">Dashbroad User</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-2 me-lg-0" id="sidebarToggle" href="#!"><i class="bi bi-justify"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>
            <!-- Navbar-->
            <div id="countdown" class="fs-4 fw-bold text-light me-1">00:00:00</div>
            <ul class="navbar-nav ms-auto ms-md-0 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person m-1"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="logout.php"> Keluar</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="bi bi-house-door-fill"></i></div>
                                Home
                            </a>
                            <a class="nav-link" href="jadwalUser.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-calendar2-check"></i></div>
                                Jadwal
                            </a>
                            <a class="nav-link" href="profil.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-person-fill"></i></div>
                                Profil
                            </a>
                             <a class="nav-link" href="ulasan.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-robot"></i></div>
                                Ulasan
                            </a>
                        </div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-3">Halaman Absensi</h1>
                        <hr>
                        <div class="row">
                           <div class="col-xl-20 col-md-20">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body text-center fs-1">
                                        Tekan (+) untuk absen
                                        <div>
                                            <a id="absenBtn" class="font text-white" href="absensi.php">
                                                <i class="bi bi-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">
                                        <div class=" d-flex align-items-center justify-content-center">
                                              <i class="bi bi-alarm-fill fs-1 m-2"></i><span id="clock" class="fs-1 text-center text-white">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <div class=" d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar2-minus fs-1 m-2"></i><span id="date" class="fs-1 text-center text-white">Loading...</span>
                                        </div>
                                    </div>
                                </div>
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
        </script>

        <script>
        function updateClock() {
        const now = new Date();
        let hours = now.getHours().toString().padStart(2, '0');
        let minutes = now.getMinutes().toString().padStart(2, '0');
        let seconds = now.getSeconds().toString().padStart(2, '0');
        let timeString = `${hours}:${minutes}:${seconds}`;
        document.getElementById('clock').textContent = timeString;
    }

    setInterval(updateClock, 1000);
    updateClock(); // initial call
        </script>
        
        <script>
           function updateFullDate() {
        const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
        const months = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", 
                        "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        const now = new Date();
        const dayName = days[now.getDay()];
        const date = now.getDate();
        const month = months[now.getMonth()];
        const year = now.getFullYear();

        const fullDate = `${dayName}, ${date} ${month} ${year}`;
        document.getElementById('date').textContent = fullDate;
    }

    updateFullDate();
        </script>


<script>
const countdownDisplay = document.getElementById('countdown');
const absenBtn = document.getElementById('absenBtn');
let timer;

// Ambil targetTime dan expired status
let targetTime = localStorage.getItem('targetTime') ? parseInt(localStorage.getItem('targetTime')) : null;
let isExpired = localStorage.getItem('timerExpired') === 'true';

function updateDisplay(h, m, s){
    countdownDisplay.textContent = 
        String(h).padStart(2,'0') + ":" + 
        String(m).padStart(2,'0') + ":" + 
        String(s).padStart(2,'0');
}

function setAbsenState(isActive){
    if(isActive){
        absenBtn.classList.remove('disabled');
        absenBtn.style.pointerEvents = 'auto';
        absenBtn.style.opacity = 1;
    } else {
        absenBtn.classList.add('disabled');
        absenBtn.style.pointerEvents = 'none';
        absenBtn.style.opacity = 0.5;
    }
}

function startCountdown(endTime){
    clearInterval(timer);
    timer = setInterval(() => {
        let remaining = Math.floor((endTime - Date.now()) / 1000);

        if(remaining <= 0){
            clearInterval(timer);
            updateDisplay(0,0,0);
            setAbsenState(false);
            localStorage.setItem('timerExpired', 'true');
            localStorage.removeItem('targetTime');
            return;
        }

        let h = Math.floor(remaining / 3600);
        let m = Math.floor((remaining % 3600) / 60);
        let s = remaining % 60;
        updateDisplay(h, m, s);

        setAbsenState(true); // tombol aktif saat timer berjalan
    }, 1000);
}

// ===== CEK STATUS SAAT HALAMAN DIMUAT =====
if(isExpired){
    updateDisplay(0,0,0);
    setAbsenState(false);
} else if(targetTime){
    let remaining = targetTime - Date.now();
    if(remaining <= 0){
        updateDisplay(0,0,0);
        setAbsenState(false);
        localStorage.setItem('timerExpired','true');
        localStorage.removeItem('targetTime');
    } else {
        startCountdown(targetTime);
    }
} else {
    // Jika timer di-reset / batal, tombol aktif kembali
    setAbsenState(true);
}

// Listener perubahan localStorage dari halaman kontrol
window.addEventListener('storage', (event) => {
    if(event.key === 'targetTime'){
        if(event.newValue){
            startCountdown(parseInt(event.newValue));
            localStorage.setItem('timerExpired','false');
        } else {
            clearInterval(timer);
            updateDisplay(0,0,0);
            setAbsenState(true); // tombol aktif karena timer di-reset
        }
    }
});

</script>

    </body>
</html>
