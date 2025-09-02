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
    .star-rating i {
        font-size: 1.5rem;
        color: #ccc;
        cursor: pointer;
        }
        .star-rating .active {
        color: #ffc107;
        }
        .review {
        background: #f8f9fa;
        padding: 15px;
        border-radius: 5px;
        margin-top: 10px;
        }
            </style>
        </head>
        <body class="sb-nav-fixed">
            <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
                <!-- Navbar Brand-->
                <a class="navbar-brand ps-3" href="#">Dashbroad Ulasan</a>
                <!-- Sidebar Toggle-->
                <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="bi bi-justify"></i></button>
                <!-- Navbar Search-->
                <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                </form>
                <!-- Navbar-->
                 <div id="countdown" class="fs-4 fw-bold text-light me-1">00:00:00</div>
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
                                <a class="nav-link" href="index.php">
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
                             <a class="nav-link" href="#">
                                <div class="sb-nav-link-icon"><i class="bi bi-star-half"></i></div>
                                Ulasan
                            </a>
                            </div>
                        </div>
                    </nav>
                </div>
                <div id="layoutSidenav_content">
                    <main>  
                        <div class="container-fluid px-4">
                            <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
                                    <h1 class="m-0">Halaman ulasan</h1>
                                    
                                </div>
                            <hr>
                            <div class="col-md-20 xl-md-20">
                                <div class="mb-3">
                                <input type="text" class="form-control" id="nama" placeholder="Masukkan nama Anda">
                            </div>
                            <div class="mb-3">
        <textarea class="form-control" id="ulasan" rows="3" placeholder="Bagikan pendapat Anda..."></textarea>
    </div>
    <div class="mb-3">
        <div class="star-rating">
        <i class="bi bi-star-fill"data-value="1"></i>
        <i class="bi bi-star-fill" data-value="2"></i>
        <i class="bi bi-star-fill" data-value="3"></i>
        <i class="bi bi-star-fill" data-value="4"></i>
        <i class="bi bi-star-fill" data-value="5"></i>
        </div>
    </div>
    <button class="btn btn-primary" onclick="kirimUlasan()">Kirim Ulasan</button>

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
                    let rating = 0;

    // Tampilkan bintang aktif
    document.querySelectorAll('.star-rating i').forEach(star => {
        star.addEventListener('click', function () {
        rating = this.getAttribute('data-value');
        updateStars(rating);
        });
    });

    function updateStars(r) {
        document.querySelectorAll('.star-rating i').forEach(star => {
        const val = star.getAttribute('data-value');
        star.classList.remove('active');
        if (val <= r) star.classList.add('active');
        });
    }

    function kirimUlasan() {
    const nama = document.getElementById('nama').value.trim();
    const ulasan = document.getElementById('ulasan').value.trim();

    if (!nama || !ulasan || rating === 0) {
        alert('Harap lengkapi semua kolom dan beri rating.');
        return;
    }

    const review = {
        nama: nama,
        ulasan: ulasan,
        rating: rating,
        timestamp: new Date().toISOString()  // ✅ disimpan dengan nama "timestamp"
    };

    const ulasanSebelumnya = JSON.parse(localStorage.getItem('ulasan')) || [];
    ulasanSebelumnya.unshift(review);
    localStorage.setItem('ulasan', JSON.stringify(ulasanSebelumnya));

    document.getElementById('nama').value = '';
    document.getElementById('ulasan').value = '';
    rating = 0;
    updateStars(0);

    tampilkanUlasan();
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
 