<?php
include '../config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Ambil statistik
$totalLaporan = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM laporan_bully"))['total'];
$totalIzin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM izin_siswa"))['total'];
$totalAdmin = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM admin"))['total']; // Menambahkan query jumlah admin

// Ambil 5 laporan terbaru
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
  <style>
    body {
      background-color: #f8fafc;
    }
    .navbar {
      background-color: #343a40;
    }
    .navbar-brand, .nav-link {
      color: #fff !important;
    }
    .nav-link.active, .nav-link:hover {
      color: #ffc107 !important;
    }
    .card-summary {
      border-radius: 15px;
      padding: 20px;
      color: #fff;
    }
    .summary-laporan {
      background: #007bff;
    }
    .summary-izin {
      background: #28a745;
    }
    .summary-admin { /* Style untuk card admin */
      background: #ffc107;
    }
    .card-data {
      border-radius: 15px;
      margin-top: 2rem;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    footer {
      margin-top: 40px;
      text-align: center;
      font-size: 0.9rem;
      color: #aaa;
    }
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
          <li class="nav-item"><a class="nav-link" href="input_izin.php"><i class="fas fa-pencil-alt me-1"></i> Input Izin</a></li>
          <li class="nav-item"><a class="nav-link" href="data_izin.php"><i class="fas fa-calendar-check me-1"></i> Data Izin</a></li>
          <li class="nav-item"><a class="nav-link" href="tambah_admin.php"><i class="fas fa-user-plus me-1"></i> Tambah Admin</a></li>
          <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt me-1"></i> Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card-summary summary-laporan">
          <h5><i class="fas fa-bullhorn me-2"></i>Total Laporan Bullying</h5>
          <h2><?= $totalLaporan ?></h2>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card-summary summary-izin">
          <h5><i class="fas fa-user-check me-2"></i>Total Data Izin</h5>
          <h2><?= $totalIzin ?></h2>
        </div>
      </div>
      <div class="col-md-4">
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
          <tbody>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($laporanTerbaru)): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_pelapor']) ?></td>
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

  <footer>
    <p>&copy; <?= date('Y') ?> Panic Bully Admin Dashboard</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
