<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$filter_tingkat = isset($_GET['tingkat']) ? $_GET['tingkat'] : '';
$cari_nama = isset($_GET['cari_nama']) ? $_GET['cari_nama'] : '';

$query = "SELECT * FROM laporan_bully WHERE 1=1";
if (!empty($filter_tingkat)) {
    $query .= " AND tingkat = '" . mysqli_real_escape_string($conn, $filter_tingkat) . "'";
}
if (!empty($cari_nama)) {
    $query .= " AND nama LIKE '%" . mysqli_real_escape_string($conn, $cari_nama) . "%'";
}
$query .= " ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Laporan Bully - Panic Bully</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <style>
    @media print {
      .no-print { display: none !important; }

      body {
        font-size: 14pt;
        background: white;
      }

      table {
        font-size: 13pt;
      }

      th, td {
        padding: 12px !important;
      }

      .card {
        box-shadow: none !important;
        border: none !important;
      }

      .container {
        width: 100%;
        max-width: 100%;
        margin: 0;
        padding: 0;
      }
    }

    body { background-color: #f8fafc; }
    .navbar { background-color: #343a40; }
    .navbar-brand, .nav-link { color: #fff !important; }
    .nav-link.active, .nav-link:hover { color: #ffc107 !important; }
    .card { border-radius: 15px; margin-top: 2rem; box-shadow: 0 0 10px rgba(0,0,0,0.05); }
    table { border-radius: 10px; overflow: hidden; }
    footer { margin-top: 40px; text-align: center; font-size: 0.9rem; color: #aaa; }
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
  <div class="card p-4">
    <h4 class="mb-3">Data Laporan Bullying</h4>
    <form class="row g-3 align-items-end mb-4 no-print" method="GET">
      <div class="col-md-3">
        <label for="tingkat" class="form-label">Filter Tingkat</label>
        <select name="tingkat" id="tingkat" class="form-select">
          <option value="">Semua</option>
          <option value="rendah" <?= $filter_tingkat == 'rendah' ? 'selected' : '' ?>>Rendah</option>
          <option value="sedang" <?= $filter_tingkat == 'sedang' ? 'selected' : '' ?>>Sedang</option>
          <option value="tinggi" <?= $filter_tingkat == 'tinggi' ? 'selected' : '' ?>>Tinggi</option>
        </select>
      </div>
      <div class="col-md-4">
        <label for="cari_nama" class="form-label">Cari Nama</label>
        <input type="text" name="cari_nama" id="cari_nama" class="form-control" value="<?= htmlspecialchars($cari_nama) ?>" placeholder="Masukkan nama pelapor">
      </div>
      <div class="col-md-2 d-grid">
        <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Cari</button>
      </div>
      <div class="col-md-1 d-grid">
        <button type="button" onclick="window.print()" class="btn btn-warning"><i class="fas fa-print"></i></button>
      </div>
      <div class="col-md-2 d-grid">
        <button type="button" class="btn btn-success" onclick="confirmExportExcel()">
          <i class="fas fa-file-excel"></i> Export Excel
        </button>
      </div>
    </form>

    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark text-center">
          <tr>
            <th>No</th>
            <th>Nama Pelapor</th>
            <th>Lokasi</th>
            <th>Deskripsi</th>
            <th>Tingkat</th>
            <th>Tanggal</th>
            <th class="no-print">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($result) > 0): ?>
            <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama']) ?: 'Anonim' ?></td>
                <td><?= htmlspecialchars($row['lokasi']) ?></td>
                <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                <td class="text-capitalize"><?= $row['tingkat'] ?></td>
                <td><?= date('d-m-Y H:i', strtotime($row['tanggal'])) ?></td>
                <td class="text-center no-print">
                  <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $row['id'] ?>)">
                    <i class="fas fa-trash-alt"></i> Hapus
                  </button>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="7" class="text-center">Tidak ada data sesuai pencarian.</td></tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<footer>
  <p>&copy; <?= date('Y') ?> Panic Bully Admin Dashboard</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function confirmDelete(id) {
    Swal.fire({
      title: 'Yakin ingin menghapus?',
      text: 'Data akan dihapus secara permanen!',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, hapus!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = 'hapus_laporan.php?id=' + id;
      }
    });
  }

  function confirmExportExcel() {
    Swal.fire({
      title: 'Ekspor ke Excel?',
      text: "Data akan diunduh dalam format Excel.",
      icon: 'question',
      showCancelButton: true,
      confirmButtonColor: '#28a745',
      cancelButtonColor: '#6c757d',
      confirmButtonText: 'Ya, ekspor!',
      cancelButtonText: 'Batal'
    }).then((result) => {
      if (result.isConfirmed) {
        const params = new URLSearchParams(window.location.search);
        const url = 'export_excel.php?' + params.toString();
        window.location.href = url;
      }
    });
  }
</script>
</body>
</html>
