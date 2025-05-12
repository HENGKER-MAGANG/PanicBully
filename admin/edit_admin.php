<?php
include '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    $_SESSION['message'] = 'ID admin tidak ditemukan.';
    header("Location: data_admin.php");
    exit;
}

$id = $_GET['id'];

// Ambil data admin berdasarkan ID
$result = mysqli_query($conn, "SELECT * FROM admin WHERE id = $id");
$admin = mysqli_fetch_assoc($result);

if (!$admin) {
    $_SESSION['message'] = 'Admin tidak ditemukan.';
    header("Location: data_admin.php");
    exit;
}

// Proses form
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    if (empty($username) || empty($password)) {
        $_SESSION['message'] = 'Username dan password tidak boleh kosong.';
    } else {
        $update = mysqli_query($conn, "UPDATE admin SET username = '$username', password = '$password' WHERE id = $id");

        if ($update) {
            $_SESSION['message'] = 'Data admin berhasil diperbarui.';
        } else {
            $_SESSION['message'] = 'Gagal memperbarui data admin.';
        }
        header("Location: data_admin.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Edit Admin - Panic Bully</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container mt-5">
    <div class="card shadow p-4">
      <h3 class="mb-4">Edit Data Admin</h3>
      <form method="post">
        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" name="username" class="form-control" value="<?= htmlspecialchars($admin['username']) ?>" required>
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="text" name="password" class="form-control" value="<?= htmlspecialchars($admin['password']) ?>" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        <a href="data_admin.php" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</body>
</html>
