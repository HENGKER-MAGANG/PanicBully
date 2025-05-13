<?php
session_start();
include '../config.php';
if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

    if ($password !== $confirm) {
        $error = "Password dan konfirmasi tidak sama.";
    } elseif (strlen($password) < 6) {
        $error = "Password minimal 6 karakter.";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $check = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username'");
        if (mysqli_num_rows($check) > 0) {
            $error = "Username sudah digunakan.";
        } else {
            $insert = mysqli_query($conn, "INSERT INTO admin (username, password) VALUES ('$username', '$hash')");
            if ($insert) {
                $success = "Admin berhasil ditambahkan.";
            } else {
                $error = "Terjadi kesalahan saat menyimpan data.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Tambah Admin - Panic Bully</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8fafc;
    }
    .card-form {
      max-width: 600px;
      margin: auto;
      margin-top: 60px;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.08);
      background-color: #fff;
    }
    .alert {
      border-radius: 10px;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="card card-form">
      <h4 class="text-center mb-4"><i class="fas fa-user-plus me-2"></i>Tambah Admin Baru</h4>

      <?php if ($error): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <i class="fas fa-exclamation-circle me-1"></i> <?= $error ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <?php if ($success): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <i class="fas fa-check-circle me-1"></i> <?= $success ?>
          <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
      <?php endif; ?>

      <form method="POST">
        <div class="mb-3">
          <label for="username" class="form-label">Username Admin</label>
          <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username..." required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password..." required>
        </div>

        <div class="mb-3">
          <label for="confirm" class="form-label">Konfirmasi Password</label>
          <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Ulangi password..." required>
        </div>

        <div class="d-flex justify-content-between">
          <a href="data_admin.php" class="btn btn-secondary"><i class="fas fa-arrow-left me-1"></i> Kembali</a>
          <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus me-1"></i> Tambah Admin</button>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
