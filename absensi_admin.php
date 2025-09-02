<?php
include "config.php"; // Koneksi ke database
require 'vendor/autoload.php'; // Autoload untuk PhpSpreadsheet

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\IOFactory;

// Mulai membuat spreadsheet
$spreadsheet = new Spreadsheet();
// ... isi datanya
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = htmlspecialchars($_POST['nama_lengkap'] ?? "");
    $jenis_kelamin = htmlspecialchars($_POST['jenis_kelamin'] ?? "");
    $usia = $_POST['usia'] ?? "";
    $kategori = htmlspecialchars($_POST['kategori'] ?? "");
    $status = htmlspecialchars($_POST['status'] ?? "");
    $acara = htmlspecialchars($_POST['acara'] ?? "");
    $keterangan = htmlspecialchars($_POST['keterangan'] ?? "");
    $alasan = htmlspecialchars($_POST['alasan'] ?? "");
    $tanggal = htmlspecialchars($_POST['tanggal'] ?? "");
    $jam = htmlspecialchars($_POST['jam'] ?? "");

    // Validasi input wajib diisi
    if (empty($nama) || empty($jenis_kelamin) || empty($usia) || empty($kategori) || empty($status) || empty($acara) || empty($keterangan) || empty($tanggal) || empty($jam)) {
        echo "<script>alert('Semua field harus diisi!'); window.location='absensi_admin.php';</script>";
        exit();
    }

    // Validasi jika memilih "Izin" atau "Sakit", alasan harus diisi
    if (($keterangan == "Izin" || $keterangan == "Sakit") && empty($alasan)) {
        echo "<script>alert('Harap isi alasan jika memilih Izin atau Sakit!'); window.location='absensi_admin.php';</script>";
        exit();
    }

    // Validasi usia harus angka positif
    if (!is_numeric($usia) || $usia <= 0) {
        echo "<script>alert('Usia harus berupa angka positif!'); window.location='absensi_admin.php';</script>";
        exit();
    }

    // Jika status "Sudah Menikah", otomatis pindahkan ke kategori "Lainnya"
    if ($status == "Sudah Menikah") {
        $kategori = "Lainnya";
    }

    // Amankan nama tabel
    $tabel = preg_replace("/[^a-zA-Z0-9_]/", "", strtolower(str_replace(" ", "_", $kategori)));

    // Periksa apakah tabel ada
    $checkTable = $conn->query("SHOW TABLES LIKE '$tabel'");
    if ($checkTable->num_rows == 0) {
        die("Error: Tabel '$tabel' tidak ditemukan.");
    }

    // Simpan data ke tabel
    $sql = "INSERT INTO $tabel (nama_lengkap, jenis_kelamin, usia, status, acara, keterangan, alasan, tanggal, jam) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssissssss", $nama, $jenis_kelamin, $usia, $status, $acara, $keterangan, $alasan, $tanggal, $jam);
        if (!$stmt->execute()) {
            die("Error eksekusi query: " . $stmt->error);
        }
        $stmt->close();
    } else {
        die("Error dalam query: " . $conn->error);
    }

    function formatTanggalIndonesia($tanggal) {
    $hari = [
        'Sunday' => 'Minggu', 'Monday' => 'Senin', 'Tuesday' => 'Selasa',
        'Wednesday' => 'Rabu', 'Thursday' => 'Kamis', 'Friday' => 'Jumat',
        'Saturday' => 'Sabtu'
    ];
    $bulan = [
        '01'=>'Januari', '02'=>'Februari', '03'=>'Maret', '04'=>'April',
        '05'=>'Mei', '06'=>'Juni', '07'=>'Juli', '08'=>'Agustus',
        '09'=>'September', '10'=>'Oktober', '11'=>'November', '12'=>'Desember'
    ];

    $time = strtotime($tanggal);
    $hari_indo = $hari[date('l', $time)];
    $tanggal_indo = date('d', $time);
    $bulan_indo = $bulan[date('m', $time)];
    $tahun = date('Y', $time);

    return "$hari_indo, $tanggal_indo $bulan_indo $tahun";
}


    // --------------------- EXCEL ---------------------
    $fileExcel = 'absensi_per_acara.xlsx';

    if (file_exists($fileExcel)) {
        $spreadsheet = IOFactory::load($fileExcel);
    } else {
        $spreadsheet = new Spreadsheet();
        $spreadsheet->removeSheetByIndex(0); // Hapus default sheet
    }

    $sheetName = preg_replace('/[^A-Za-z0-9 ]/', '', $acara);
    $sheetName = substr($sheetName, 0, 31); // Maksimal 31 karakter

    $sheet = null;
    foreach ($spreadsheet->getSheetNames() as $name) {
        if ($name === $sheetName) {
            $sheet = $spreadsheet->getSheetByName($name);
            break;
        }
    }

    if (!$sheet) {
        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle($sheetName);

        $headers = ['Nama Lengkap', 'Jenis Kelamin', 'Usia', 'Status', 'Acara', 'Keterangan', 'Alasan', 'Tanggal', 'Jam'];
        foreach ($headers as $i => $header) {
            $col = chr(65 + $i);
            $sheet->setCellValue($col . '1', $header);
            $sheet->getStyle($col . '1')->applyFromArray([
                'font' => ['bold' => true],
                'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'D9D9D9']],
                'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER],
                'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            ]);
        }
    }

    $lastRow = $sheet->getHighestRow() + 1;
    $data = [$nama, $jenis_kelamin, $usia, $status, $acara, $keterangan, $alasan, $tanggal, formatTanggalIndonesia($tanggal)];

    foreach ($data as $i => $value) {
        $col = chr(65 + $i);
        $sheet->setCellValue($col . $lastRow, $value);
        $sheet->getStyle($col . $lastRow)->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
        ]);
    }

    foreach (range('A', chr(65 + count($data) - 1)) as $col) {
        $sheet->getColumnDimension($col)->setAutoSize(true);
    }

    $writer = new Xlsx($spreadsheet);
    $writer->save($fileExcel);

    echo "<script>alert('Absensi berhasil disimpan!'); window.location='indexAdmin.php';</script>";
    exit();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Absensi Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
        }
        .absensi-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }
        
    </style>
</head>
<body>

<div class="absensi-container text-center bg-white">
    <h2 class="mb-4">Form Absensi Siswa</h2>
    <form action="absensi_admin.php" method="post" onsubmit="setLocalTime()">
        <div class="mb-2 form-floating">
            <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control" placeholder="Nama Lengkap" required>
            <label for="nama_lengkap">Nama Lengkap</label>
        </div>

        <div class="mb-2 form-floating">
            <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                <option value="" selected disabled>Pilih Jenis Kelamin</option>
                <option value="Laki-laki">Laki-laki</option>
                <option value="Perempuan">Perempuan</option>
            </select>
            <label for="jenis_kelamin">Jenis Kelamin</label>
        </div>

        <div class="mb-2 form-floating">
            <input type="number" name="usia" id="usia" class="form-control" placeholder="Usia" required>
            <label for="usia">Usia</label>
        </div>

        <div class="mb-2 form-floating">
            <select name="kategori" id="kategori" class="form-select" required>
                <option value="" selected disabled>Pilih Kategori</option>
                <option value="Pra Remaja">Pra Remaja</option>
                <option value="Remaja">Remaja</option>
                <option value="Pra Nika">Pra Nika</option>
            </select>
            <label for="kategori">Kategori</label>
        </div>

        <div class="mb-2 form-floating">
            <select name="status" id="status" class="form-select" required>
                <option value="" selected disabled>Pilih Status</option>
                <option value="Belum Menikah">Belum Menikah</option>
                <option value="Sudah Menikah">Sudah Menikah</option>
            </select>
            <label for="status">Status</label>
        </div>

        <div class="mb-2 form-floating">
            <select name="acara" id="acara" class="form-select" required>
                <option value="" selected disabled>Pilih Acara</option>
                <option value="Kelompok">Kelompok</option>
                <option value="Desa">Desa</option>
                <option value="Daerah">Daerah</option>
                <option value="Lainnya">Lainnya</option>
            </select>
            <label for="acara">Acara</label>
        </div>

        <div class="mb-2 form-floating">
            <select name="keterangan" id="keterangan" class="form-select" required>
                <option value="Hadir">Hadir</option>
                <option value="Izin">Izin</option>
                <option value="Sakit">Sakit</option>
            </select>
            <label for="keterangan">Keterangan</label>
        </div>

        <div class="mb-3 form-floating" id="alasan-container" style="display: none;">
            <input type="text" name="alasan" id="alasan" class="form-control" placeholder="Alasan">
            <label for="alasan">Alasan</label>
        </div>

        <input type="hidden" name="tanggal" id="tanggal">
        <input type="hidden" name="jam" id="jam">

        <button type="submit" class="btn btn-primary w-100">Simpan Absensi</button>
        <a href="index.php" class="btn btn-danger w-100 mt-1">Batal</a>
    </form>
</div>

<script>
    function setLocalTime() {
        let now = new Date();
        document.getElementById('tanggal').value = now.toISOString().split('T')[0];
        document.getElementById('jam').value = now.toTimeString().split(' ')[0];
    }

    $("#keterangan").change(function() {
        if ($(this).val() == "Izin" || $(this).val() == "Sakit") {
            $("#alasan-container").show();
        } else {
            $("#alasan-container").hide();
        }
    });
</script>

</body>
</html>
