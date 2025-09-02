<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Control Timer</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body {
    background-color: #f8f9fa;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
}
.card {
    min-width: 350px;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 0 15px rgba(0,0,0,0.3);
}
</style>
</head>
<body>
<div class="card">
    <h2 class="text-center mb-4">Form Kontrol Timer Absensi</h2>

   <form id="timerForm" class="row g-3">
    <div class="col-4">
        <label for="hours" class="form-label">Jam</label>
        <input type="number" id="hours" class="form-control" min="0" max="23" value="0">
    </div>

    <div class="col-4">
        <label for="minutes" class="form-label">Menit</label>
        <input type="number" id="minutes" class="form-control" min="0" max="59" value="0">
    </div>

    <div class="col-4">
        <label for="seconds" class="form-label">Detik</label>
        <input type="number" id="seconds" class="form-control" min="0" max="59" value="0">
    </div>

    <div class="col-12 d-flex justify-content-center gap-2 mt-3">
        <button type="button" id="startBtn" class="btn btn-success">Mulai</button>
        <button type="button" id="cancelBtn" class="btn btn-secondary">Batalkan</button>
        <a href="ruangcontrol.php" class="btn btn-danger">Kembali</a>
    </div>
</form>

</div>

<script>
const startBtn = document.getElementById('startBtn');
const cancelBtn = document.getElementById('cancelBtn');
const hoursSelect = document.getElementById('hours');
const minutesSelect = document.getElementById('minutes');
const secondsSelect = document.getElementById('seconds');

startBtn.addEventListener('click', () => {
    let hours = parseInt(hoursSelect.value);
    let minutes = parseInt(minutesSelect.value);
    let seconds = parseInt(secondsSelect.value);

    let targetTime = Date.now() + ((hours*3600 + minutes*60 + seconds)*1000);
    localStorage.setItem('targetTime', targetTime);
    localStorage.setItem('action', 'start');
    alert("Timer dimulai!");
});

cancelBtn.addEventListener('click', () => {
    localStorage.removeItem('targetTime');        // hapus targetTime
    localStorage.setItem('action', 'cancel');     // flag agar halaman lain tahu dibatalkan
    localStorage.setItem('timerExpired', 'false'); // reset expired, tombol absen bisa aktif kembali
    alert("Timer dibatalkan!");
});

</script>
</body>
</html>
