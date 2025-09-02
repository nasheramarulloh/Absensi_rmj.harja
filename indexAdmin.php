
<?php
session_start();
include "config.php"; // <-- pastikan ini ada di atas

// cek session role
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'yes') {
    session_unset();
    session_destroy();
    header("Location: LoginAdmin.php");
    exit;
}

// contoh ambil role terbaru dari database
$nama_lengkap = $_SESSION['nama_lengkap'];
$sql = "SELECT role FROM login WHERE nama_lengkap = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nama_lengkap);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user || $user['role'] !== 'yes') {
    session_unset();
    session_destroy();
    header("Location: LoginAdmin.php");
    exit;
}

$remaja = getSummaryRemaja($conn);
$pra_remaja = getSummaryPraRemaja($conn);
$pra_nika = getSummaryPraNika($conn); // ← Diganti dari pra_nikah menjadi pra_nika

function getSummaryRemaja($conn) {
    return getSummary($conn, 'remaja');
}

function getSummaryPraRemaja($conn) {
    return getSummary($conn, 'pra_remaja');
}

function getSummaryPraNika($conn) { // ← Nama fungsi diganti
    return getSummary($conn, 'pra_nika'); // ← Nama tabel juga disesuaikan
}

// Fungsi umum
function getSummary($conn, $table) {
    $summary = [
        'total' => 0,
        'today' => 0
    ];

    $today = date('Y-m-d');

    // Hitung total unik berdasarkan nama + tanggal
    $sqlTotal = "SELECT COUNT(DISTINCT nama_lengkap, tanggal) AS total FROM $table";
    $resultTotal = $conn->query($sqlTotal);
    if ($resultTotal && $row = $resultTotal->fetch_assoc()) {
        $summary['total'] = $row['total'];
    }

    // Hitung jumlah hari ini berdasarkan nama_lengkap unik
    $sqlToday = "SELECT COUNT(DISTINCT nama_lengkap) AS total FROM $table WHERE tanggal = '$today'";
    $resultToday = $conn->query($sqlToday);
    if ($resultToday && $row = $resultToday->fetch_assoc()) {
        $summary['today'] = $row['total'];
    }

    return $summary;
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <!-- Bootstrap Icons CDN -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <style>
            .shadow-card {
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4); /* bayangan luar card */
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.shadow-card:hover {
    transform: scale(1.02); /* sedikit membesar saat hover */
    box-shadow: 0 14px 35px rgba(0, 0, 0, 0.5);
}
            .title-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.85);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    font-weight: bold;
    border-radius: 0.375rem; /* biar sesuai card */
    z-index: 10;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
    transition: opacity 0.3s ease;
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
            <div id="countdown" class="fs-4 fw-bold text-light me-1">00:00:00</div>
            <!-- Navbar-->
            <a href="indexAdmin.php" class="btn btn-light ms-3 text-dark" onclick="checkAdminPassword(event)"><i class="bi bi-gear"></i>
            </a>
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
                            <a class="nav-link" href="#">
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
                                <h1 class="m-0">Halaman Absensi</h1>
                                <a href="absensi_per_acara.xlsx" download class="btn btn-success shadow-sm">
                                    <i class="bi bi-file-earmark-arrow-down"></i> Download File Absensi
                                </a>
                            </div>
                        <hr>
                        <div class="row">
                           <div class="col-xl-20 col-md-20">
                                <div class="card bg-dark text-white mb-4">
                                    <div class="card-body text-center fs-1">
                                        Tekan (+) untuk absen
                                        <div>
                                            <a id="absenBtn" class="font text-white" href="absensi_admin.php">
                                                <i class="bi bi-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-danger text-white mb-2">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-center">
                                              <i class="bi bi-alarm-fill mt-1 fs-1"></i><span id="clock" class="fs-1 pt-1 m-2 text-center text-white">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <i class="bi bi-calendar2-minus mt-1 fs-1"></i><span id="date" class="fs-1 pt-1 m-2 text-center text-white">Loading...</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-20">
                                <h2>Jumlah Peserta</h2>
                                <hr>
                            </div>
                            <div class="col-xl-3 col-md-3 mb-3">
                                <div class="card bg-info text-dark remaja-card shadow-card" onclick="toggleTitle(this)">
                                    <div class="card-body text-center position-relative">
                                        <div class="title-overlay d-none">Remaja</div>
                                        <p class="fs-1 m-0"><?= $remaja['total'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-3 mb-3">
                                <div class="card bg-success text-dark remaja-card shadow-card" onclick="toggleTitle(this)">
                                    <div class="card-body text-center position-relative">
                                        <div class="title-overlay d-none">Pra Remaja</div>
                                        <p class="fs-1 m-0"><?= $pra_remaja['total'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-3  mb-3">
                                <div class="card bg-warning text-dark remaja-card shadow-card" onclick="toggleTitle(this)">
                                    <div class="card-body text-center position-relative">
                                        <div class="title-overlay d-none">Pra Nikah</div>
                                        <p class="fs-1 m-0"><?= $pra_nika['total'] ?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-3 mb-3">
                                <div class="card bg-danger text-dark remaja-card shadow-card" onclick="toggleTitle(this)">
                                    <div class="card-body text-center position-relative">
                                        <div class="title-overlay d-none">Total</div>
                                        <p class="fs-1 m-0"><?= $remaja['today'] + $pra_remaja['today'] + $pra_nika['today'] ?></p>
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
function toggleTitle(card) {
    const title = card.querySelector('.title-overlay');
    title.classList.toggle('d-none');
    
    // Sembunyakan otomatis setelah 2 detik
    setTimeout(() => {
        title.classList.add('d-none');
    }, 2000);
}
</script>
<script>
function checkAdminPassword(e) {
    e.preventDefault(); // mencegah link langsung diakses
    const password = prompt("Masukkan password admin:");
    if (password === "masjidkhoirunnajah354313") {
        // Password benar, arahkan ke halaman admin
        window.location.href = "ruangcontrol.php";
    } else {
        alert("Password salah! Akses ditolak.");
    }
}
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
