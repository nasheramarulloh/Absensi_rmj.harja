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
                                <a class="nav-link" href="dataLogin.php">
                                    <div class="sb-nav-link-icon"><i class="bi bi-database-check"></i></div>
                                    Data Login
                                </a>
                                <a class="nav-link" href="#">
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
                                    <h1 class="m-0">Halaman Ulasan User</h1>
                                    
                                </div>
                            <hr>
                            <div class="col-md-20 xl-md-20">
                                <div class="d-flex justify-content-between align-items-center mb-2">
  <h4 class="m-0">Ulasan Terbaru (<span id="jumlahUlasan">0</span>)</h4>
  <hr>
  <input type="text" id="searchUlasan" class="form-control w-25" placeholder="Cari nama...">
</div>

    <div id="daftarUlasan"></div>
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
                function tampilkanUlasan() {
    const daftarUlasan = document.getElementById('daftarUlasan');
    daftarUlasan.innerHTML = '';

    const semuaUlasan = JSON.parse(localStorage.getItem('ulasan')) || [];

    semuaUlasan.forEach(item => {
        const waktuSekarang = new Date();
        const waktuUlasan = new Date(item.timestamp);
        const selisihMenit = Math.floor((waktuSekarang - waktuUlasan) / 60000);

        let tampilWaktu = '';
        if (selisihMenit < 1) {
        tampilWaktu = 'Baru saja';
        } else if (selisihMenit === 1) {
        tampilWaktu = '1 menit lalu';
        } else {
        tampilWaktu = `${selisihMenit} menit lalu`;
        }

        const elemen = document.createElement('div');
        elemen.classList.add('review');
        elemen.innerHTML = `
        <div style="display:flex; justify-content:space-between;">
            <b>${item.nama}</b>
            <small class="text-muted">${tampilWaktu}</small>
        </div>
        <span>${'★'.repeat(item.rating)}${'☆'.repeat(5 - item.rating)}</span><br>
        ${item.ulasan}
        `;
        daftarUlasan.appendChild(elemen);
    });
    }

    function hapusUlasan(index) {
  const semuaUlasan = JSON.parse(localStorage.getItem('ulasan')) || [];
  semuaUlasan.splice(index, 1); // Hapus 1 elemen pada index
  localStorage.setItem('ulasan', JSON.stringify(semuaUlasan));
  tampilkanUlasan(document.getElementById('searchUlasan').value);
}

    document.addEventListener('DOMContentLoaded', function () {
    tampilkanUlasan();
    });

    function tampilkanUlasan(filter = '') {
  const daftarUlasan = document.getElementById('daftarUlasan');
  daftarUlasan.innerHTML = '';

  const semuaUlasan = JSON.parse(localStorage.getItem('ulasan')) || [];

  // Filter ulasan berdasarkan nama jika ada filter
  const filtered = semuaUlasan.filter(item =>
    item.nama.toLowerCase().includes(filter.toLowerCase())
  );

  // Tampilkan jumlah total ulasan
  document.getElementById('jumlahUlasan').innerText = filtered.length;

  filtered.forEach((item, index) => {
    const waktuSekarang = new Date();
    const waktuUlasan = new Date(item.timestamp);
    const selisihMenit = Math.floor((waktuSekarang - waktuUlasan) / 60000);

    let tampilWaktu = '';
    if (selisihMenit < 1) {
      tampilWaktu = 'Baru saja';
    } else if (selisihMenit === 1) {
      tampilWaktu = '1 menit lalu';
    } else {
      tampilWaktu = `${selisihMenit} menit lalu`;
    }

    const elemen = document.createElement('div');
    elemen.classList.add('review');
    elemen.innerHTML = `
      <div style="display:flex; justify-content:space-between; align-items:center;">
        <div>
          <b>${item.nama}</b>
          <small class="text-muted ms-2">${tampilWaktu}</small>
        </div>
        <button class="btn btn-sm btn-danger" onclick="hapusUlasan(${index})">
          <i class="bi bi-trash"></i>
        </button>
      </div>
      <span>${'★'.repeat(item.rating)}${'☆'.repeat(5 - item.rating)}</span><br>
      ${item.ulasan}
    `;
    daftarUlasan.appendChild(elemen);
  });
}

// Pencarian dinamis berdasarkan nama
document.getElementById('searchUlasan').addEventListener('input', function () {
  tampilkanUlasan(this.value);
});
            </script>
        </body>
    </html>
