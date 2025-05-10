<?php
include '../config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Mengambil data izin siswa yang belum kembali dari database
$sql_belum_kembali = "SELECT * FROM izin_siswa WHERE status = 'Belum Kembali' ORDER BY tanggal DESC";
$result_belum_kembali = mysqli_query($conn, $sql_belum_kembali);

// Mengambil data izin siswa yang sudah kembali dari database
$sql_sudah_kembali = "SELECT * FROM izin_siswa WHERE status = 'Kembali' ORDER BY tanggal DESC";
$result_sudah_kembali = mysqli_query($conn, $sql_sudah_kembali);

// Menghapus data izin siswa jika tombol hapus ditekan
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql_delete = "DELETE FROM izin_siswa WHERE id = $id";
    if (mysqli_query($conn, $sql_delete)) {
        $_SESSION['message'] = 'Data izin siswa berhasil dihapus.';
    } else {
        $_SESSION['message'] = 'Gagal menghapus data izin: ' . mysqli_error($conn);
    }
    header("Location: data_izin.php");
    exit;
}

// Menandai izin sebagai "Sudah Kembali"
if (isset($_GET['return'])) {
    $id = $_GET['return'];
    $sql_update = "UPDATE izin_siswa SET status = 'Kembali' WHERE id = $id";
    if (mysqli_query($conn, $sql_update)) {
        $_SESSION['message'] = 'Izin siswa telah ditandai sebagai sudah kembali.';
    } else {
        $_SESSION['message'] = 'Gagal menandai izin siswa: ' . mysqli_error($conn);
    }
    header("Location: data_izin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Izin Siswa - Panic Bully</title>
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

  <div class="container">
    <?php if (isset($_SESSION['message'])): ?>
      <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
        <?= $_SESSION['message'] ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <div class="card">
      <h5 class="mb-3">Data Izin Siswa - Belum Kembali</h5>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Lengkap</th>
            <th>Kelas</th>
            <th>Alasan Keluar</th>
            <th>Tanggal Izin</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($result_belum_kembali) > 0): ?>
            <?php $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result_belum_kembali)): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($row['kelas']) ?></td>
                <td><?= htmlspecialchars($row['alasan_keluar']) ?></td>
                <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])) ?></td>
                <td><?= htmlspecialchars($row['status'] ?? 'Belum Kembali') ?></td>
                <td>
                  <a href="data_izin.php?return=<?= $row['id'] ?>" class="btn btn-success btn-sm">Sudah Kembali</a>
                  <a href="data_izin.php?delete=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="7" class="text-center">Tidak ada data izin siswa yang belum kembali.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>

    <div class="card">
      <h5 class="mb-3">Data Izin Siswa - Sudah Kembali</h5>
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>#</th>
            <th>Nama Lengkap</th>
            <th>Kelas</th>
            <th>Alasan Keluar</th>
            <th>Tanggal Izin</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($result_sudah_kembali) > 0): ?>
            <?php $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result_sudah_kembali)): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($row['kelas']) ?></td>
                <td><?= htmlspecialchars($row['alasan_keluar']) ?></td>
                <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])) ?></td>
                <td><?= htmlspecialchars($row['status']) ?></td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="6" class="text-center">Tidak ada data izin siswa yang sudah kembali.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>

  <footer>
    <p>&copy; <?= date('Y') ?> Panic Bully Admin Dashboard</p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
