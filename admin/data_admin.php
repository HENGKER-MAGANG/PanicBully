<?php
include '../config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}
$data = mysqli_query($conn, "SELECT * FROM admin");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Data Admin - Panic Bully</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
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
    .card-data {
      border-radius: 15px;
      margin-top: 2rem;
      box-shadow: 0 0 10px rgba(0,0,0,0.05);
    }
    .btn-action {
      margin: 0 2px;
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
  <!-- NAVBAR -->
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
          <li class="nav-item"><a class="nav-link" href="dashboard.php"><i class="fas fa-home me-1"></i> Dashboard</a></li>
          <li class="nav-item"><a class="nav-link" href="input_laporan.php"><i class="fas fa-pencil-alt me-1"></i> Input Laporan</a></li>
          <li class="nav-item"><a class="nav-link" href="data_diagram.php"><i class="fas fa-chart-line me-1"></i> Diagram</a></li>
          <li class="nav-item"><a class="nav-link" href="data_laporan.php"><i class="fas fa-table me-1"></i> Data</a></li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle active" href="#" id="adminDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-user-cog me-1"></i> Admin
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item active" href="data_admin.php"><i class="fas fa-users me-1"></i> Data Admin</a></li>
              <li><a class="dropdown-item" href="tambah_admin.php"><i class="fas fa-user-plus me-1"></i> Tambah Admin</a></li>
            </ul>
          </li>
          <li class="nav-item"><a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt me-1"></i> Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- CONTENT -->
  <div class="container mt-4">
    <div class="card card-data p-4">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">Daftar Admin</h4>
        <a href="tambah_admin.php" class="btn btn-primary">
          <i class="fas fa-plus"></i> Tambah Admin
        </a>
      </div>
      <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle">
          <thead class="table-dark text-center">
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Password</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; while($row = mysqli_fetch_assoc($data)): ?>
            <tr>
              <td class="text-center"><?= $no++ ?></td>
              <td><?= htmlspecialchars($row['username']) ?></td>
              <td><?= htmlspecialchars($row['password']) ?></td>
              <td class="text-center">
                <a href="edit_admin.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning btn-action">
                  <i class="fas fa-edit"></i> Edit
                </a>
                <button class="btn btn-sm btn-danger btn-action" onclick="confirmDelete(<?= $row['id'] ?>)">
                  <i class="fas fa-trash-alt"></i> Hapus
                </button>
              </td>
            </tr>
            <?php endwhile; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- FOOTER -->
  <footer>
    <p>&copy; <?= date('Y') ?> Panic Bully Admin Dashboard</p>
  </footer>

  <!-- SCRIPT -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function confirmDelete(id) {
      Swal.fire({
        title: 'Yakin ingin menghapus admin ini?',
        text: "Tindakan ini tidak bisa dibatalkan.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = 'hapus_admin.php?id=' + id;
        }
      });
    }

    <?php if (isset($_SESSION['message'])): ?>
    Swal.fire({
      icon: "<?= strpos($_SESSION['message'], 'berhasil') !== false ? 'success' : 'error' ?>",
      title: "<?= $_SESSION['message'] ?>",
      showConfirmButton: false,
      timer: 2000
    });
    <?php unset($_SESSION['message']); endif; ?>
  </script>
</body>
</html>
