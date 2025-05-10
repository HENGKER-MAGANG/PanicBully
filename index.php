<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Panic Bully - SMKN 2 Pinrang</title>
  <link rel="icon" href="assets/logo_smkn2pinrang.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    html, body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      padding: 0;
      height: 100%;
      overflow: hidden;
    }

    .hero {
      background: url('assets/hero-smk2.jpg') no-repeat center center / cover;
      position: relative;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 20px;
      color: #fff;
    }

    .hero::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.5);
      z-index: 0;
    }

    .hero-content {
      position: relative;
      z-index: 1;
      max-width: 700px;
      width: 100%;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
    }

    .hero img.logo {
      width: 80px;
      margin-bottom: 1rem;
    }

    .hero h1 {
      font-size: 2.5rem;
      font-weight: 700;
      color: #fff;
      margin-bottom: 1rem;
    }

    .hero p {
      font-size: 1.1rem;
      color: #eee;
      margin-bottom: 2rem;
    }

    .btn-custom {
      padding: 12px 30px;
      font-size: 1rem;
      border-radius: 30px;
      border: none;
      background: linear-gradient(to right, #e53935, #f4511e);
      color: white;
      transition: all 0.3s ease;
      margin: 0.3rem;
    }

    .btn-custom:hover {
      background: linear-gradient(to right, #b71c1c, #ef6c00);
      transform: scale(1.05);
    }

    footer {
      position: absolute;
      bottom: 0;
      width: 100%;
      padding: 1rem;
      text-align: center;
      background: rgba(0,0,0,0.1);
      font-size: 0.9rem;
      color: #f0f0f0;
    }

    @media (max-width: 768px) {
      .hero h1 {
        font-size: 1.8rem;
      }
      .hero p {
        font-size: 1rem;
      }
      .btn-custom {
        font-size: 0.95rem;
        padding: 10px 25px;
      }
    }
  </style>
</head>
<body>

  <section class="hero">
    <div class="hero-content">
      <img src="assets/logo_smkn2pinrang.png" alt="Logo SMKN 2 Pinrang" class="logo" />
      <h1>Welcome To Website PanicBully</h1>
      <p>
        Website ini membantu teman-teman yang merasa tidak aman dan mengalami <strong>bullying</strong>. Layanan ini mengirim <strong>pesan darurat & lokasi</strong> ke Cabang Dinas, Kepala Sekolah, dan Guru BK.
      </p>
      <a href="report.php" class="btn btn-custom"><i class="fas fa-rocket me-2"></i>Laporkan Sekarang</a>
      <a href="edukasi.php" class="btn btn-custom"><i class="fas fa-rocket me-2"></i>Edukasi</a>
      <a href="tentang.php" class="btn btn-custom"><i class="fas fa-info-circle me-2"></i>Pelajari Lebih Lanjut</a>
      <a href="profil.php" class="btn btn-custom"><i class="fas fa-school me-2"></i>Profil dan Dokumentasi SMK Negeri 2 Pinrang</a>
    </div>
  </section>

  <footer>
    &copy; 2025 Panic Bully | Ikhsan Pratama - SMKN 2 Pinrang
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
