<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Panic Bully - SMKN 2 Pinrang</title>
  <link rel="icon" href="assets/logo_smkn2pinrang.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    :root {
      --bg-body: #f9f9f9;
      --bg-navbar: rgba(33, 37, 41, 0.7);
      --bg-footer: rgba(33, 37, 41, 0.7);
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
      background-color: transparent !important;
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

    .hero {
      flex: 1;
      background: url('assets/hero-smk2.jpg') no-repeat center center / cover;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      position: relative;
      padding-top: 70px;
    }

    .hero::before {
      content: "";
      position: absolute;
      inset: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 1;
    }

    .hero-content {
      position: relative;
      z-index: 2;
      background: rgba(255, 255, 255, 0.08);
      backdrop-filter: blur(10px);
      border-radius: 20px;
      padding: 2rem;
      max-width: 700px;
      color: var(--text-light);
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
      opacity: 0;
      transform: translateY(20px);
      animation: fadeInUp 1s ease-out 0.3s forwards;
    }

    @keyframes fadeInUp {
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    .hero-content img.logo {
      width: 80px;
      margin-bottom: 1rem;
    }

    .hero-content h1 {
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 1rem;
    }

    .hero-content p {
      font-size: 1.1rem;
      margin-bottom: 2rem;
      color: var(--text-muted);
    }

    .btn-custom {
      background: linear-gradient(to right, #e53935, #f4511e);
      color: #fff;
      padding: 12px 30px;
      border: none;
      border-radius: 30px;
      font-size: 1rem;
      margin: 0.3rem;
      transition: 0.3s ease;
      text-decoration: none;
    }

    .btn-custom:hover {
      background: linear-gradient(to right, #b71c1c, #ef6c00);
      transform: scale(1.05);
    }

    footer {
      color: var(--text-muted);
      text-align: center;
      padding: 1rem 0;
      font-size: 0.9rem;
    }

    section {
      padding: 60px 20px;
    }

    .section-title {
      text-align: center;
      margin-bottom: 40px;
      font-size: 2rem;
      font-weight: 700;
    }

    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 2rem;
      }
      .hero-content p {
        font-size: 1rem;
      }
      .btn-custom {
        font-size: 0.95rem;
        padding: 10px 25px;
      }
    }
    @media (max-width: 480px) {
      .hero-content h1 {
        font-size: 1.5rem;
      }
      .hero-content p {
        font-size: 0.95rem;
      }
      .btn-custom {
        font-size: 0.85rem;
        padding: 8px 20px;
      }
    }
  </style>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark fixed-top shadow-sm">
    <div class="container">
      <a class="navbar-brand" href="#">
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

  <section class="hero">
    <div class="hero-content">
      <img src="assets/logo_smkn2pinrang.png" alt="Logo SMKN 2 Pinrang" class="logo" />
      <h1>Welcome To Website PanicBully</h1>
      <p>Website ini membantu teman-teman yang merasa tidak aman dan mengalami <strong>bullying</strong>. Layanan ini mengirim <strong>pesan darurat & lokasi</strong> ke Cabang Dinas, Kepala Sekolah, dan Guru BK.</p>
      <a href="report.php" class="btn btn-custom"><i class="fas fa-rocket me-2"></i>Laporkan Sekarang</a>
      <a href="edukasi.php" class="btn btn-custom"><i class="fas fa-book me-2"></i>Edukasi</a>
      <a href="tentang.php" class="btn btn-custom"><i class="fas fa-info-circle me-2"></i>Pelajari Lebih Lanjut</a>
      <a href="profil.php" class="btn btn-custom"><i class="fas fa-school me-2"></i>Profil & Dokumentasi</a>
    </div>
  </section>

  <!-- Edukasi Section -->
  <section id="edukasi">
    <div class="container">
      <h2 class="section-title">Apa Itu Bullying?</h2>
      <p class="text-center mx-auto" style="max-width: 700px;">Bullying adalah tindakan agresif yang dilakukan secara sengaja dan berulang-ulang terhadap seseorang yang lebih lemah. Bentuk bullying bisa berupa fisik, verbal, sosial, maupun cyberbullying.</p>
    </div>
  </section>

  <!-- Testimoni Section -->
  <section id="testimoni" class="bg-light">
    <div class="container">
      <h2 class="section-title">Apa Kata Mereka?</h2>
      <div class="row g-4 justify-content-center">
        <div class="col-md-4">
          <div class="p-4 border rounded bg-white shadow-sm">
            <p>"Panic Bully membantu saya merasa aman saat ada ancaman bullying. Terima kasih!"</p>
            <strong>- Siswa Kelas XI</strong>
          </div>
        </div>
        <div class="col-md-4">
          <div class="p-4 border rounded bg-white shadow-sm">
            <p>"Sistem ini sangat membantu kami untuk merespons laporan dengan cepat."</p>
            <strong>- Guru BK</strong>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    &copy; 2025 Panic Bully | Ikhsan Pratama - SMKN 2 Pinrang
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
