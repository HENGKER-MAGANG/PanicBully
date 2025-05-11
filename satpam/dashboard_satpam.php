<?php
include '../config.php';

if (!isset($_SESSION['satpam'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard Satpam - Panic Bully</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet"/>
  <style>
    body {
      background-color: #f0f2f5;
    }
    .navbar {
      background-color: #1e293b;
    }
    .navbar-brand, .nav-link {
      color: #fff !important;
    }
    .nav-link.active, .nav-link:hover {
      color: #ffc107 !important;
    }
    .card-box {
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }
    .notification-box {
      position: relative;
    }
    .notification-count {
      position: absolute;
      top: -8px;
      right: -8px;
      background: red;
      color: white;
      font-size: 12px;
      padding: 2px 6px;
      border-radius: 50%;
      display: none;
    }
  </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
  <div class="container">
    <a class="navbar-brand fw-bold" href="#">
      <img src="../assets/logo_smkn2pinrang.png" alt="Logo" style="height: 30px; margin-right: 10px;">
      Panic Bully Satpam
    </a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item"><a href="dashboard_satpam.php" class="nav-link">Dashboard</a></li>
        <li class="nav-item"><a href="data_izin_satpam.php" class="nav-link active">Data Izin</a></li>
        <li class="nav-item"><a href="logout.php" class="nav-link">Logout</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <div class="alert alert-info" role="alert">
    Selamat datang di Dashboard Satpam! Anda akan menerima notifikasi otomatis jika ada laporan bullying terbaru.
  </div>

  <!-- Contoh konten lain -->
  <div class="row mt-4">
    <div class="col-md-6">
      <div class="card card-box p-4">
        <h5>Data Izin Siswa</h5>
        <p>Lihat dan verifikasi siswa yang keluar dan kembali ke sekolah.</p>
        <a href="data_izin_satpam.php" class="btn btn-primary">Lihat Data Izin</a>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  let lastLaporanId = 0;

  function cekLaporanBaru() {
    $.ajax({
      url: 'cek_laporan_baru.php',
      type: 'GET',
      dataType: 'json',
      data: { last_id: lastLaporanId },
      success: function(response) {
        if (response.has_new) {
          $('#notif-count').text(response.new_count).show();
          lastLaporanId = response.latest_id;
        }
      }
    });
  }

  $(document).ready(function() {
    cekLaporanBaru(); // Cek pertama kali
    setInterval(cekLaporanBaru, 10000); // Cek setiap 10 detik
  });
</script>

</body>
</html>
