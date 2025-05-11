<?php
include '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$filter_kelas = $_GET['kelas'] ?? '';
$filter_status = $_GET['status'] ?? '';
$search_nama = $_GET['nama'] ?? '';

$sql = "SELECT * FROM izin_siswa WHERE 1=1";
if ($filter_kelas !== '') {
    $sql .= " AND kelas = '" . mysqli_real_escape_string($conn, $filter_kelas) . "'";
}
if ($filter_status !== '') {
    $sql .= " AND status = '" . mysqli_real_escape_string($conn, $filter_status) . "'";
}
if ($search_nama !== '') {
    $sql .= " AND nama_lengkap LIKE '%" . mysqli_real_escape_string($conn, $search_nama) . "%'";
}
$sql .= " ORDER BY tanggal DESC";
$result = mysqli_query($conn, $sql);

$kelas_result = mysqli_query($conn, "SELECT DISTINCT kelas FROM izin_siswa ORDER BY kelas ASC");
$kelas_grouped = ['X' => [], 'XI' => [], 'XII' => [], 'Lainnya' => []];
while ($row = mysqli_fetch_assoc($kelas_result)) {
    $kelas = $row['kelas'];
    if (preg_match('/^X\b/i', $kelas)) $kelas_grouped['X'][] = $kelas;
    elseif (preg_match('/^XI\b/i', $kelas)) $kelas_grouped['XI'][] = $kelas;
    elseif (preg_match('/^XII\b/i', $kelas)) $kelas_grouped['XII'][] = $kelas;
    else $kelas_grouped['Lainnya'][] = $kelas;
}

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    if (mysqli_query($conn, "DELETE FROM izin_siswa WHERE id = $id")) {
        $_SESSION['message'] = 'Data izin berhasil dihapus.';
    }
    header("Location: data_izin.php");
    exit;
}

if (isset($_GET['return'])) {
    $id = $_GET['return'];
    if (mysqli_query($conn, "UPDATE izin_siswa SET status = 'Kembali' WHERE id = $id")) {
        $_SESSION['message'] = 'Status izin diperbarui.';
    }
    header("Location: data_izin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Data Izin Siswa - Panic Bully</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <style>
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
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="satpamDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user-shield me-1"></i> Satpam
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="satpamDropdown">
              <li><a class="dropdown-item" href="data_satpam.php"><i class="fas fa-user-shield me-1"></i> Data Satpam</a></li>
              <li><a class="dropdown-item" href="tambah_satpam.php"><i class="fas fa-user-plus me-1"></i> Tambah Satpam</a></li>
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
  </nav

<div class="container">
  <div class="card p-4">
    <h4 class="mb-3">Data Izin Siswa</h4>

    <?php if (isset($_SESSION['message'])): ?>
      <div class="alert alert-info"><?= $_SESSION['message'] ?></div>
      <?php unset($_SESSION['message']); ?>
    <?php endif; ?>

    <!-- Filter -->
    <form method="GET" class="row row-cols-lg-auto g-3 align-items-end mb-3">
      <div class="col">
        <label for="kelas" class="form-label">Filter Kelas</label>
        <select name="kelas" id="kelas" class="form-select" onchange="this.form.submit()">
          <option value="">Semua Kelas</option>
          <?php foreach ($kelas_grouped as $tingkat => $daftar_kelas): ?>
            <?php if (!empty($daftar_kelas)): ?>
              <optgroup label="<?= $tingkat ?>">
                <?php foreach ($daftar_kelas as $kelas): ?>
                  <option value="<?= $kelas ?>" <?= $filter_kelas === $kelas ? 'selected' : '' ?>><?= $kelas ?></option>
                <?php endforeach; ?>
              </optgroup>
            <?php endif; ?>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col">
        <label for="status" class="form-label">Status</label>
        <select name="status" id="status" class="form-select" onchange="this.form.submit()">
          <option value="">Semua</option>
          <option value="Belum Kembali" <?= $filter_status === 'Belum Kembali' ? 'selected' : '' ?>>Belum Kembali</option>
          <option value="Kembali" <?= $filter_status === 'Kembali' ? 'selected' : '' ?>>Kembali</option>
        </select>
      </div>
      <div class="col">
        <label for="nama" class="form-label">Cari Nama</label>
        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama" value="<?= htmlspecialchars($search_nama) ?>">
      </div>
      <div class="col">
        <button type="submit" class="btn btn-primary"><i class="fas fa-search me-1"></i> Cari</button>
      </div>
    </form>

    <!-- Tombol Export & Print -->
    <div class="d-flex justify-content-end mb-3 gap-2">
      <button onclick="printTable()" class="btn btn-outline-dark">
        <i class="fas fa-print me-1"></i> Print
      </button>
      <button onclick="exportToExcel()" class="btn btn-outline-success">
        <i class="fas fa-file-excel me-1"></i> Export Excel
      </button>
    </div>

    <!-- Tabel -->
    <div class="table-responsive">
      <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark text-center">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Kelas</th>
            <th>Tanggal</th>
            <th>Alasan</th>
            <th>Status</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php if (mysqli_num_rows($result) > 0): $no = 1; ?>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
                <td><?= htmlspecialchars($row['kelas']) ?></td>
                <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
                <td><?= htmlspecialchars($row['alasan_keluar']) ?></td>
                <td class="text-center">
                  <?php if ($row['status'] === 'Belum Kembali'): ?>
                    <span class="badge bg-warning text-dark"><?= $row['status'] ?></span>
                  <?php else: ?>
                    <span class="badge bg-success"><?= $row['status'] ?></span>
                  <?php endif; ?>
                </td>
                <td class="text-center">
                  <?php if ($row['status'] === 'Belum Kembali'): ?>
                    <a href="?return=<?= $row['id'] ?>" class="btn btn-sm btn-success" onclick="return confirm('Tandai sudah kembali?')">Kembali</a>
                  <?php endif; ?>
                  <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Hapus data ini?')">Hapus</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr><td colspan="7" class="text-center">Tidak ada data ditemukan.</td></tr>
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
<script>
function printTable() {
  const printContent = document.querySelector('.table-responsive').innerHTML;
  const originalContent = document.body.innerHTML;

  document.body.innerHTML = `
    <html>
      <head>
        <title>Print Data Izin</title>
        <style>
          table { width: 100%; border-collapse: collapse; }
          th, td { border: 1px solid #000; padding: 8px; text-align: center; }
          th { background-color: #f2f2f2; }
        </style>
      </head>
      <body>
        <h2 style="text-align:center;">Data Izin Siswa</h2>
        ${printContent}
      </body>
    </html>
  `;
  window.print();
  document.body.innerHTML = originalContent;
  window.location.reload();
}

function exportToExcel() {
  const table = document.querySelector("table").outerHTML;
  const filename = "data_izin_siswa.xls";
  const dataType = 'application/vnd.ms-excel';
  const blob = new Blob(['\ufeff', table], { type: dataType });

  const link = document.createElement('a');
  link.href = URL.createObjectURL(blob);
  link.download = filename;
  link.click();
}
</script>
</body>
</html>
