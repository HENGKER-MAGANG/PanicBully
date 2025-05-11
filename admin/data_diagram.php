<?php
include '../config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$tahunFilter = date('Y');
$bulanFilter = date('n');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['tahun'])) {
        $tahunFilter = (int) $_POST['tahun'];
    }
    if (isset($_POST['bulan'])) {
        $bulanFilter = (int) $_POST['bulan'];
    }
}

// Data laporan per bulan
$bulanData = array_fill(1, 12, 0);
$result = $conn->query("SELECT MONTH(created_at) as bulan, COUNT(*) as total 
                        FROM laporan 
                        WHERE YEAR(created_at) = $tahunFilter 
                        GROUP BY MONTH(created_at)");
while ($row = $result->fetch_assoc()) {
    $bulanData[(int)$row['bulan']] = (int)$row['total'];
}

// Data laporan per hari
$laporanPerHari = [];
$resultHarian = $conn->query("SELECT DATE(created_at) as tanggal, COUNT(*) as total 
                              FROM laporan 
                              WHERE YEAR(created_at) = $tahunFilter AND MONTH(created_at) = $bulanFilter 
                              GROUP BY DATE(created_at)");
while ($row = $resultHarian->fetch_assoc()) {
    $laporanPerHari[$row['tanggal']] = $row['total'];
}
$labelsLaporanHarian = array_keys($laporanPerHari);
$dataLaporanHarian = array_values($laporanPerHari);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Diagram - Panic Bully</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f8fafc;
      color: #333;
    }
    .navbar {
      background: #343a40;
    }
    .navbar-brand, .nav-link {
      color: #ffffff !important;
    }
    .nav-link.active, .nav-link:hover {
      color: #ffc107 !important;
    }
    .navbar-brand img {
      height: 30px;
      margin-right: 10px;
    }
    .card {
      background-color: #ffffff;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.05);
      margin-top: 2rem;
      padding: 20px;
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
            <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt me-1"></i> Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <!-- Diagram laporan per bulan -->
    <div class="card">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Statistik Laporan per Bulan (<?= $tahunFilter ?>)</h5>
        <form method="POST" class="d-flex">
          <select name="tahun" class="form-select" onchange="this.form.submit()">
            <?php for ($t = date('Y'); $t >= 2022; $t--): ?>
              <option value="<?= $t ?>" <?= $t == $tahunFilter ? 'selected' : '' ?>><?= $t ?></option>
            <?php endfor; ?>
          </select>
        </form>
      </div>
      <canvas id="bulanChart" height="100"></canvas>
    </div>

    <!-- Diagram laporan per hari -->
    <div class="card mt-5">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h5 class="mb-0">Laporan per Hari - <?= date('F', mktime(0,0,0,$bulanFilter,1)) ?> <?= $tahunFilter ?></h5>
        <form method="POST" class="d-flex gap-2">
          <select name="tahun" class="form-select" onchange="this.form.submit()">
            <?php for ($t = date('Y'); $t >= 2022; $t--): ?>
              <option value="<?= $t ?>" <?= $t == $tahunFilter ? 'selected' : '' ?>><?= $t ?></option>
            <?php endfor; ?>
          </select>
          <select name="bulan" class="form-select" onchange="this.form.submit()">
            <?php for ($b = 1; $b <= 12; $b++): ?>
              <option value="<?= $b ?>" <?= $b == $bulanFilter ? 'selected' : '' ?>><?= date('F', mktime(0, 0, 0, $b, 10)) ?></option>
            <?php endfor; ?>
          </select>
        </form>
      </div>
      <canvas id="laporanHarianChart" height="100"></canvas>
    </div>
  </div>

  <footer>
    <p>&copy; <?= date('Y') ?> Panic Bully Admin Dashboard</p>
  </footer>

  <script>
    new Chart(document.getElementById('bulanChart').getContext('2d'), {
      type: 'bar',
      data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
        datasets: [{
          label: 'Jumlah Laporan',
          data: <?= json_encode(array_values($bulanData)) ?>,
          backgroundColor: '#ffc107',
          borderColor: '#ff9800',
          borderWidth: 1,
          hoverBackgroundColor: '#ffca2c'
        }]
      },
      options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });

    new Chart(document.getElementById('laporanHarianChart').getContext('2d'), {
      type: 'line',
      data: {
        labels: <?= json_encode($labelsLaporanHarian) ?>,
        datasets: [{
          label: 'Jumlah Laporan',
          data: <?= json_encode($dataLaporanHarian) ?>,
          borderColor: '#ff6384',
          backgroundColor: 'rgba(255, 99, 132, 0.2)',
          fill: true,
          tension: 0.3
        }]
      },
      options: { responsive: true, scales: { y: { beginAtZero: true } } }
    });
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
