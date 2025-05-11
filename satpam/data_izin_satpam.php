<?php
include '../config.php';
if (!isset($_SESSION['satpam'])) {
    header("Location: login_satpam.php");
    exit;
}

// Ambil filter dari URL
$search = isset($_GET['search']) ? $_GET['search'] : '';
$tanggal_dari = isset($_GET['dari']) ? $_GET['dari'] : '';
$tanggal_sampai = isset($_GET['sampai']) ? $_GET['sampai'] : '';

// Query dasar
$filter = "WHERE 1=1";
if (!empty($search)) {
    $search = mysqli_real_escape_string($conn, $search);
    $filter .= " AND nama_lengkap LIKE '%$search%'";
}
if (!empty($tanggal_dari) && !empty($tanggal_sampai)) {
    $filter .= " AND DATE(tanggal) BETWEEN '$tanggal_dari' AND '$tanggal_sampai'";
}

$sql_belum_kembali = "SELECT * FROM izin_siswa $filter AND status = 'Belum Kembali' ORDER BY tanggal DESC";
$result_belum_kembali = mysqli_query($conn, $sql_belum_kembali);

$sql_sudah_kembali = "SELECT * FROM izin_siswa $filter AND status = 'Kembali' ORDER BY tanggal DESC";
$result_sudah_kembali = mysqli_query($conn, $sql_sudah_kembali);

// Menandai izin sebagai "Sudah Kembali"
if (isset($_GET['return'])) {
    $id = $_GET['return'];
    $sql_update = "UPDATE izin_siswa SET status = 'Kembali' WHERE id = $id";
    if (mysqli_query($conn, $sql_update)) {
        $_SESSION['message'] = 'Izin telah ditandai sebagai sudah kembali.';
    } else {
        $_SESSION['message'] = 'Gagal memperbarui status izin.';
    }
    header("Location: data_izin_satpam.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Izin Siswa - Dashboard Satpam</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
      background-color: #fff;
      padding: 1.5rem;
      margin-top: 1rem;
    }
    footer {
      text-align: center;
      margin-top: 3rem;
      color: #888;
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
  <?php if (isset($_SESSION['message'])): ?>
    <div class="alert alert-info"><?= $_SESSION['message']; unset($_SESSION['message']); ?></div>
  <?php endif; ?>

  <!-- Form filter -->
  <div class="card-box">
    <form class="row g-3 mb-3" method="get" action="">
      <div class="col-md-4">
        <input type="text" name="search" class="form-control" placeholder="Cari Nama Siswa" value="<?= htmlspecialchars($search) ?>">
      </div>
      <div class="col-md-3">
        <input type="date" name="dari" class="form-control" value="<?= $tanggal_dari ?>">
      </div>
      <div class="col-md-3">
        <input type="date" name="sampai" class="form-control" value="<?= $tanggal_sampai ?>">
      </div>
      <div class="col-md-2">
        <button type="submit" class="btn btn-primary w-100"><i class="fas fa-search"></i> Filter</button>
      </div>
    </form>
  </div>

  <!-- Tabel Belum Kembali -->
  <div class="card-box">
    <h5 class="mb-3">Siswa Belum Kembali</h5>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Alasan</th>
          <th>Tanggal</th>
          <th>Status</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result_belum_kembali)): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
          <td><?= htmlspecialchars($row['kelas']) ?></td>
          <td><?= htmlspecialchars($row['alasan_keluar']) ?></td>
          <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])) ?></td>
          <td><span class="badge bg-warning text-dark"><?= $row['status'] ?></span></td>
          <td>
            <a href="?return=<?= $row['id'] ?>" class="btn btn-success btn-sm">
              <i class="fas fa-check-circle"></i> Sudah Kembali
            </a>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>

  <!-- Tabel Sudah Kembali -->
  <div class="card-box mt-4">
    <h5 class="mb-3">Siswa Sudah Kembali</h5>
    <table class="table table-bordered table-striped">
      <thead class="table-dark">
        <tr>
          <th>#</th>
          <th>Nama</th>
          <th>Kelas</th>
          <th>Alasan</th>
          <th>Tanggal</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result_sudah_kembali)): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
          <td><?= htmlspecialchars($row['kelas']) ?></td>
          <td><?= htmlspecialchars($row['alasan_keluar']) ?></td>
          <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])) ?></td>
          <td><span class="badge bg-success"><?= $row['status'] ?></span></td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</div>

<footer class="mt-5 mb-3 text-center">
  &copy; <?= date('Y') ?> Panic Bully - Dashboard Satpam
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
