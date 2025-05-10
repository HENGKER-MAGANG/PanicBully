<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Tentang Panic Bully</title>
  <link rel="icon" href="assets/logo_smkn2pinrang.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />

  <style>
    body {
      font-family: 'Roboto', sans-serif;
      margin: 0;
      background: #f4f6f9;
      color: #333;
    }

    .hero-header {
      background: linear-gradient(to right, #4CAF50, #388E3C);
      color: white;
      padding: 4rem 1rem;
      text-align: center;
      border-bottom: 5px solid #388E3C;
    }

    .hero-header h1 {
      font-size: 3rem;
      font-weight: bold;
    }

    .hero-header p {
      font-size: 1.2rem;
      opacity: 0.9;
      margin-top: 0.5rem;
    }

    .content-section {
      padding: 4rem 1rem;
    }

    .content-section h2 {
      font-weight: 700;
      color: #388E3C;
      margin-bottom: 1rem;
    }

    .content-section p {
      font-size: 1.1rem;
      line-height: 1.8;
      color: #555;
    }

    .icon-circle {
      width: 50px;
      height: 50px;
      background: #e8f5e9;
      color: #388E3C;
      display: inline-flex;
      justify-content: center;
      align-items: center;
      border-radius: 50%;
      font-size: 20px;
      margin-right: 10px;
    }

    .info-list li {
      display: flex;
      align-items: center;
      margin-bottom: 1.5rem;
      font-size: 1.05rem;
    }

    .card-info {
      background: white;
      padding: 2.5rem;
      border-radius: 16px;
      margin-top: 3rem;
      box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
      transition: transform 0.3s;
      border-top: 5px solid #388E3C;
    }

    .card-info:hover {
      transform: translateY(-5px);
    }

    .btn-back {
      margin-top: 3rem;
      display: inline-block;
      padding: 12px 30px;
      background: #388E3C;
      color: white;
      border-radius: 30px;
      text-decoration: none;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 1px;
      transition: 0.3s ease;
    }

    .btn-back:hover {
      background: #2C6E1F;
    }

    footer {
      background: #1a1a1a;
      color: #ccc;
      padding: 1rem;
      text-align: center;
      margin-top: 4rem;
    }

    @media (max-width: 768px) {
      .hero-header h1 {
        font-size: 2.2rem;
      }

      .btn-back {
        font-size: 0.9rem;
      }

      .content-section {
        padding: 3rem 1rem;
      }

      .icon-circle {
        width: 40px;
        height: 40px;
        font-size: 18px;
      }

      .info-list li {
        font-size: 1rem;
      }
    }
  </style>
</head>
<body>

  <header class="hero-header" data-aos="fade-down">
    <h1><i class="fas fa-shield-alt me-2"></i> Tentang Panic Bully</h1>
    <p>Mewujudkan sekolah yang aman, responsif, dan bebas bullying</p>
  </header>

  <main class="content-section container">

    <section data-aos="fade-up">
      <h2><i class="fas fa-info-circle me-2"></i> Apa itu Panic Bully?</h2>
      <p>
        <strong>Panic Bully</strong> adalah solusi digital yang memudahkan siswa untuk melaporkan insiden <strong>perundungan</strong> secara cepat dan aman. Sistem ini dibuat khusus untuk SMKN 2 Pinrang, memastikan setiap laporan langsung diteruskan ke pihak yang berwenang.
      </p>
    </section>

    <section class="mt-5" data-aos="fade-up" data-aos-delay="100">
      <h2><i class="fas fa-cogs me-2"></i> Bagaimana Cara Kerjanya?</h2>
      <ul class="info-list">
        <li><div class="icon-circle"><i class="fas fa-map-marker-alt"></i></div> Menyimpan lokasi pelapor (dengan izin)</li>
        <li><div class="icon-circle"><i class="fas fa-envelope"></i></div> Mengirim pesan ke Cabang Dinas, Kepsek, dan Guru BK</li>
        <li><div class="icon-circle"><i class="fas fa-bolt"></i></div> Memberikan notifikasi cepat agar segera ditindaklanjuti</li>
      </ul>
    </section>

    <section class="card-info" data-aos="fade-up" data-aos-delay="200">
      <h2><i class="fas fa-school me-2"></i> Tentang SMKN 2 Pinrang</h2>
      <p>
        SMK Negeri 2 Pinrang adalah institusi pendidikan vokasi terkemuka di Sulawesi Selatan. Dengan berbagai jurusan unggulan seperti TKJ, RPL, APHP, APAT, PH, Dan UPW sekolah ini terus berinovasi demi mencetak generasi unggul dan tangguh.
      </p>
      <p>
        Melalui program seperti <strong>Panic Bully</strong>, SMKN 2 Pinrang menegaskan komitmennya terhadap keamanan dan kenyamanan siswa dalam belajar dan beraktivitas.
      </p>
    </section>

    <div class="text-center">
      <a href="index.php" class="btn-back mt-4"><i class="fas fa-arrow-left me-2"></i> Kembali ke Beranda</a>
    </div>

  </main>

  <footer>
    &copy; 2025 Panic Bully | Ikhsan Pratama - SMKN 2 Pinrang
  </footer>

  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      once: true,
      duration: 1000
    });
  </script>
</body>
</html>
