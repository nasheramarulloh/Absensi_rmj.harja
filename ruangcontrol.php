<?php
session_start();
include 'config.php';


// Ambil semua data user dari tabel login
$sql = "SELECT * FROM login ORDER BY tanggal_masuk DESC";
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
            #countdown {
    font-size: 1.5rem;
    text-align: center;
    color: #0f0;
}

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
    <!-- Navbar Brand / Tombol Kembali -->
    <a href="indexAdmin.php" class="btn btn-light ms-3 text-dark"><i class="bi bi-box-arrow-left"></i>
        Kembali ke Halaman
    </a>
</nav>

        <div>
            <div id="layoutSidenav_content">
                <main>  
                    <div class="container-fluid pt-4 mt-4">
                         <div class="d-flex justify-content-between align-items-center mt-3 mb-3">
    <h1 class="m-0">Data Semua Pengguna</h1>

    <div class="d-flex align-items-center gap-2">
        <!-- Countdown -->
                    <div id="countdown" class=" btn btn-dark text-light me-1">00:00:00</div>

        <!-- Icon setting -->
        <a href="seettingWaktu.php">
            <i class="bi bi-gear fs-5 btn btn-dark text-light"></i>
        </a>
    </div>
</div>

                        <hr>
                        <div class="mb-2 col-md-20 mt-1">
                                <input type="text" id="searchBox" class="form-control" placeholder="Cari data...">
                        </div>
                        <di class="row">
                            <div class="table-responsive">
                                <table id="example" class="col-md-20 table table-bordered table-striped table-hover ">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">No Telepon</th>
                                        <th scope="col">Tanggal Masuk</th>
                                        <th scope="col">Tanggal_keluar</th>
                                        <th scope="col">Role</th>
                                    </tr>
                                </thead>
<tbody>
      <?php if ($result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
          <tr>
            <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
            <td><?= htmlspecialchars($row['jenis_kelamin']) ?></td>
            <td><?= htmlspecialchars($row['email']) ?></td>
            <td><?= htmlspecialchars($row['no_telepon']) ?></td>
            <td><?= htmlspecialchars($row['tanggal_masuk']) ?></td>
            <td><?= htmlspecialchars($row['tanggal_keluar']) ?></td>
            <td>
  <form action="ubah_role.php" method="POST" class="d-inline">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div class="form-check form-switch"> 
      <input class="form-check-input role-switch" type="checkbox" 
             name="role" value="yes" 
             onchange="this.form.submit()" 
             <?= ($row['role'] === 'yes') ? 'checked' : '' ?>>
      <label class="form-check-label fw-bold 
          <?= ($row['role'] === 'yes') ? 'text-success' : 'text-danger' ?>">
        <?= ($row['role'] === 'yes') ? 'Admin' : 'User' ?>
      </label>
    </div>
  </form>
</td>


          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr><td colspan="9" class="text-center">Belum ada data login.</td></tr>
      <?php endif; ?>
    </tbody>
                            </table>
                            </div>
                        </di>
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
