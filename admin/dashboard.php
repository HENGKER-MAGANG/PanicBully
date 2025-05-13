<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$totalLaporan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM laporan_bully"))['total'];
$totalAdmin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM admin"))['total'];

$laporanTerbaru = mysqli_query($conn, "SELECT * FROM laporan_bully ORDER BY tanggal DESC LIMIT 5");
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin - Panic Bully</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
  <style>
    body { background-color: #f8fafc; }
    .navbar { background-color: #343a40; }
    .navbar-brand, .nav-link { color: #fff !important; }
    .nav-link.active, .nav-link:hover { color: #ffc107 !important; }
    .card-summary { border-radius: 15px; padding: 20px; color: #fff; }
    .summary-laporan { background: #007bff; }
    .summary-admin { background: #ffc107; }
    .card-data { border-radius: 15px; margin-top: 2rem; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
    footer { margin-top: 40px; text-align: center; font-size: 0.9rem; color: #aaa; }
    #notif-icon {
      position: fixed; bottom: 30px; right: 30px;
      background: #dc3545; color: #fff; padding: 12px 18px;
      border-radius: 50px; box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      font-weight: bold; display: none; z-index: 9999;
    }
    #notif-icon i { margin-right: 8px; }
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand fw-bold" href="#">
        <img src="../assets/logo_smkn2pinrang.png" alt="Logo" style="height: 30px; margin-right: 10px;">
        Panic Bully Admin
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item"><a class="nav-link active" href="dashboard.php"><i class="fas fa-home me-1"></i> Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="input_laporan.php"><i class="fas fa-pencil-alt me-1"></i> Input Laporan</a></li>
          <li class="nav-item"><a class="nav-link" href="data_diagram.php"><i class="fas fa-chart-line me-1"></i> Diagram</a></li>
          <li class="nav-item"><a class="nav-link" href="data_laporan.php"><i class="fas fa-table me-1"></i> Data</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user-cog me-1"></i> Admin
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
              <li><a class="dropdown-item" href="data_admin.php"><i class="fas fa-users me-1"></i> Data Admin</a></li>
              <li><a class="dropdown-item" href="tambah_admin.php"><i class="fas fa-user-plus me-1"></i> Tambah Admin</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#" onclick="confirmLogout()">
              <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card-summary summary-laporan">
          <h5><i class="fas fa-bullhorn me-2"></i>Total Laporan Bullying</h5>
          <h2><?= $totalLaporan ?></h2>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card-summary summary-admin">
          <h5><i class="fas fa-users me-2"></i>Total Admin</h5>
          <h2><?= $totalAdmin ?></h2>
        </div>
      </div>
    </div>

    <div class="card card-data mt-5 p-4">
      <h5 class="mb-3">Laporan Terbaru</h5>
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark text-center">
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Lokasi</th>
              <th>Tingkat</th>
              <th>Tanggal</th>
            </tr>
          </thead>
          <tbody id="laporanTerbaruBody">
            <?php $no = 1; while ($row = mysqli_fetch_assoc($laporanTerbaru)): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?></td>
                <td><?= htmlspecialchars($row['lokasi']) ?></td>
                <td class="text-capitalize"><?= $row['tingkat'] ?></td>
                <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])) ?></td>
              </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div id="notif-icon">
    <i class="fas fa-bell"></i> Laporan Baru Masuk!
  </div>
  <audio id="notifSound" src="../assets/audio/notif.wav" preload="auto"></audio>

  <footer>
    <p>&copy; <?= date('Y') ?> Panic Bully Admin Dashboard</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    const notif = document.getElementById('notif-icon');
    const sound = document.getElementById('notifSound');
    let lastTotal = <?= $totalLaporan ?>;
    let originalTitle = document.title;

    function showNotif() {
      sound.play();
      notif.style.display = 'block';
      notif.classList.add('animate__animated', 'animate__fadeInDown');
      document.title = "🔔 Laporan Baru! | Panic Bully";

      setTimeout(() => {
        notif.classList.remove('animate__fadeInDown');
        notif.classList.add('animate__fadeOutUp');
        setTimeout(() => {
          notif.style.display = 'none';
          notif.classList.remove('animate__fadeOutUp');
          document.title = originalTitle;
        }, 1000);
      }, 4000);
    }

    function updateTable() {
      fetch('get_laporan_terbaru.php')
        .then(res => res.text())
        .then(html => {
          document.getElementById('laporanTerbaruBody').innerHTML = html;
        });
    }

    setInterval(() => {
      fetch('cek_laporan_baru.php')
        .then(res => res.json())
        .then(data => {
          if (data.total > lastTotal) {
            lastTotal = data.total;
            showNotif();
            updateTable();
          }
        });
    }, 5000);

    function confirmLogout() {
      Swal.fire({
        title: 'Yakin ingin logout?',
        text: "Sesi kamu akan diakhiri.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, logout!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'logout.php';
        }
      });
    }
  </script>
</body>
</html>
