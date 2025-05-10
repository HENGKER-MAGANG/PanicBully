<?php
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
  <title>Tambah Admin</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container mt-5">
    <h3 class="mb-4">Tambah Admin Baru</h3>

    <?php if ($error): ?>
      <div class="alert alert-danger"><?= $error ?></div>
    <?php endif; ?>

    <?php if ($success): ?>
      <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <form method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username Admin</label>
        <input type="text" class="form-control" id="username" name="username" required>
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>

      <div class="mb-3">
        <label for="confirm" class="form-label">Konfirmasi Password</label>
        <input type="password" class="form-control" id="confirm" name="confirm" required>
      </div>

      <button type="submit" class="btn btn-primary"><i class="fas fa-user-plus me-1"></i> Tambah Admin</button>
      <a href="dashboard.php" class="btn btn-secondary ms-2">Kembali</a>
    </form>
  </div>
</body>
</html>
