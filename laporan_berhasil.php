<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Laporan Berhasil</title>
  <link rel="icon" href="assets/logo_smkn2pinrang.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    :root {
      --bg-body: #f9f9f9;
      --text-body: #000;
      --text-light: #fff;
      --text-muted: #e0e0e0;
    }

    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      background-color: var(--bg-body);
      color: var(--text-body);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .navbar, footer {
      background-color: rgba(33, 37, 41, 0.7) !important;
      backdrop-filter: blur(10px);
    }

    .navbar-brand {
      font-weight: 700;
      display: flex;
      align-items: center;
      color: var(--text-light);
    }

    .navbar-brand img {
      margin-right: 10px;
    }

    .nav-link {
      color: var(--text-light) !important;
      transition: 0.3s ease;
    }

    .nav-link:hover {
      color: #f4511e !important;
    }

    .success-content {
      flex: 1;
      display: flex;
      align-items: center;
      justify-content: center;
      padding-top: 100px;
      text-align: center;
    }

    .success-box {
      background: white;
      padding: 2.5rem;
      border-radius: 20px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
      max-width: 600px;
      width: 90%;
      animation: fadeInUp 0.8s ease-out forwards;
      transform: translateY(20px);
      opacity: 0;
    }

    .success-box i {
      font-size: 3rem;
      color: #4caf50;
    }

    .success-box h3 {
      margin-top: 1rem;
      font-weight: bold;
    }

    .btn-custom {
      background: linear-gradient(to right, #e53935, #f4511e);
      color: #fff;
      padding: 12px 30px;
      border: none;
      border-radius: 30px;
      font-size: 1rem;
      margin-top: 1.5rem;
      text-decoration: none;
      display: inline-block;
      transition: 0.3s ease;
    }

    .btn-custom:hover {
      background: linear-gradient(to right, #b71c1c, #ef6c00);
      transform: scale(1.05);
    }

    footer {
      text-align: center;
      color: var(--text-muted);
      padding: 1rem 0;
      font-size: 0.9rem;
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <img src="assets/logo_smkn2pinrang.png" alt="Logo" width="35" height="35">
        Panic Bully
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav gap-2">
          <li class="nav-item">
            <a class="nav-link" href="laporan.php"><i class="fas fa-clipboard me-1"></i>Data Laporan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="admin/login.php"><i class="fas fa-user-shield me-1"></i>Login Admin</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <!-- Success Message -->
  <div class="success-content">
    <div class="success-box">
      <i class="fas fa-check-circle"></i>
      <h3>Laporan Berhasil Dikirim</h3>
      <p>Terima kasih telah melaporkan kejadian. Tim kami akan menindaklanjuti sesegera mungkin.</p>
      <a href="index.php" class="btn-custom"><i class="fas fa-home me-2"></i>Kembali ke Beranda</a>
    </div>
  </div>

  <!-- Footer -->
  <footer>
    &copy; 2025 Panic Bully | Ikhsan Pratama - SMKN 2 Pinrang
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
