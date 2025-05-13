<?php
session_start();
include '../config.php';

if (isset($_POST['login'])) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM admin WHERE username='$username'");

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {
            $_SESSION['admin'] = $username;
            header("Location: dashboard.php");
            exit;
        } else {
            $error = "Username atau password salah!";
        }
    } else {
        $error = "Username atau password salah!";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Login Admin - Panic Bully</title>
  <link rel="icon" href="../assets/logo_smkn2pinrang.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: url('../assets/hero-smk2.jpg') no-repeat center center / cover;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      position: relative;
    }

    body::before {
      content: '';
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.6);
      z-index: 0;
    }

    .login-card {
      position: relative;
      z-index: 1;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(12px);
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.3);
      padding: 2rem;
      width: 100%;
      max-width: 400px;
      color: #fff;
    }

    .login-card .btn-custom {
      background: linear-gradient(to right, #e53935, #f4511e);
      border: none;
      color: white;
      padding: 10px;
      border-radius: 30px;
      width: 100%;
      transition: 0.3s;
    }

    .login-card .btn-custom:hover {
      background: linear-gradient(to right, #b71c1c, #ef6c00);
      transform: scale(1.03);
    }

    .btn-back {
      color: #fff;
      text-decoration: underline;
      display: inline-block;
      margin-top: 1rem;
    }

    .form-control {
      border-radius: 12px;
    }
  </style>
</head>
<body>
  <div class="login-card">
    <h3 class="mb-3 text-center">Login Admin</h3>
    <?php if (!empty($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
    <form method="post">
      <div class="mb-3">
        <input type="text" name="username" class="form-control" placeholder="Username" required />
      </div>
      <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required />
      </div>
      <button type="submit" name="login" class="btn btn-custom">Login</button>
    </form>
    <a href="../index.php" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Beranda</a><br>
  </div>
</body>
</html>
