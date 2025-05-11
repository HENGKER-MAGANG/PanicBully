<?php
include '../config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nama_lengkap = $_POST['nama_lengkap'];
    $kelas = $_POST['kelas'];
    $alasan_keluar = $_POST['alasan_keluar'];
    $jam_keluar = $_POST['jam_keluar'];

    $sql = "INSERT INTO izin_siswa (nama_lengkap, kelas, alasan_keluar, jam_keluar, tanggal) 
            VALUES ('$nama_lengkap', '$kelas', '$alasan_keluar', '$jam_keluar', NOW())";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['message'] = 'Izin berhasil dicatat!';
    } else {
        $_SESSION['message'] = 'Gagal mencatat izin: ' . mysqli_error($conn);
    }

    header("Location: dashboard.php");
    exit;
}

$kelas_options = [
  'X TJKT 1', 'X TJKT 2', 'X TJKT 3', 'X TJKT 4',
  'X PPLG 1', 'X PPLG 2', 'X PPLG 3',
  'X APHP 1', 'X APHP 2',
  'X AP 1', 'X AP 2',
  'X PH 1', 'X PH 2',
  'X UPW',
  'XI TKJ 1', 'XI TKJ 2', 'XI TKJ 3', 'XI TKJ 4',
  'XI RPL 1', 'XI RPL 2', 'XI RPL 3',
  'XI APHP 1', 'XI APHP 2', 'XI APHP 3',
  'XI AP 1', 'XI AP 2', 'XI AP 3',
  'XI PH 1', 'XI PH 2',
  'XI UPW'
];
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Input Izin Siswa - Panic Bully</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
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
    .form-control, .form-select {
      border-radius: 10px;
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
          <li class="nav-item">
            <a class="nav-link active" href="dashboard.php">
              <i class="fas fa-home me-1"></i> Dashboard
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="input_laporan.php">
              <i class="fas fa-pencil-alt me-1"></i> Input Laporan
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data_diagram.php">
              <i class="fas fa-chart-line me-1"></i> Diagram
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="data_laporan.php">
              <i class="fas fa-table me-1"></i> Data
            </a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="izinDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-calendar-check me-1"></i> Izin
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="izinDropdown">
              <li><a class="dropdown-item" href="input_izin.php"><i class="fas fa-pencil-alt me-1"></i> Input Izin</a></li>
              <li><a class="dropdown-item" href="data_izin.php"><i class="fas fa-calendar-check me-1"></i> Data Izin</a></li>
            </ul>
          </li>
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
            <a class="nav-link" href="logout.php">
              <i class="fas fa-sign-out-alt me-1"></i> Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <?php if (isset($_SESSION['message'])): ?>
      <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
        <?= $_SESSION['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="card">
      <h5 class="mb-3">Input Izin Siswa</h5>
      <form action="input_izin.php" method="POST">
        <div class="mb-3">
          <label for="nama_lengkap" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" required />
        </div>
        <div class="mb-3">
          <label for="kelas" class="form-label">Kelas</label>
          <select class="form-select" id="kelas" name="kelas" required>
            <option value="" selected disabled>Pilih Kelas</option>
            <?php foreach ($kelas_options as $k): ?>
              <option value="<?= $k ?>"><?= $k ?></option>
            <?php endforeach; ?>
          </select>
        </div>
        <div class="mb-3">
          <label for="alasan_keluar" class="form-label">Alasan Keluar</label>
          <textarea class="form-control" id="alasan_keluar" name="alasan_keluar" rows="3" required></textarea>
        </div>
        <div class="mb-3">
          <label for="jam_keluar" class="form-label">Jam Keluar</label>
          <input type="time" class="form-control" id="jam_keluar" name="jam_keluar" required />
        </div>
        <button type="submit" class="btn btn-warning"><i class="fas fa-paper-plane me-1"></i> Kirim Izin</button>
      </form>
    </div>
  </div>

  <footer>
    <p>&copy; <?= date('Y') ?> Panic Bully Admin Dashboard</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
