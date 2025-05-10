<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dokumentasi SMK Negeri 2 Pinrang</title>
  <link rel="icon" href="assets/logo_smkn2pinrang.png" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: #f7f9fb;
      color: #333;
      margin: 0;
      padding: 0;
      overflow-x: hidden;
    }

    .hero-header {
      background: linear-gradient(to right, #206478, #0c3d4a);
      color: white;
      padding: 6rem 1rem 4rem;
      text-align: center;
      position: relative;
      overflow: hidden;
    }

    .hero-header::after {
      content: "";
      position: absolute;
      bottom: -20px;
      left: 0;
      width: 100%;
      height: 40px;
      background: white;
      border-top-left-radius: 50% 20px;
      border-top-right-radius: 50% 20px;
    }

    .hero-header img {
      width: 100px;
      height: auto;
      margin-bottom: 20px;
    }

    .hero-header h1 {
      font-size: 3.8rem;
      font-weight: bold;
      margin: 20px 0;
      animation: slideUp 1s ease-out;
    }

    .hero-header p {
      font-size: 1.3rem;
      margin-top: 1rem;
      opacity: 0.95;
      animation: fadeInUp 1.5s ease-out;
    }

    .content-section {
      padding: 4rem 2rem;
      animation: fadeIn 2s ease-in-out;
    }

    .content-section h2 {
      font-weight: 700;
      color: #164e63;
      margin-bottom: 1rem;
      animation: slideLeft 1s ease-out;
    }

    .content-section p,
    .content-section ul {
      font-size: 1.15rem;
      line-height: 1.8;
      color: #555;
      animation: fadeInUp 1.5s ease-out;
    }

    .content-section ul {
      padding-left: 1.5rem;
    }

    .content-section ul li {
      opacity: 0;
      transform: translateY(30px);
      animation: fadeInUp 1.5s ease-out forwards;
    }

    .content-section ul li:nth-child(1) {
      animation-delay: 0.3s;
    }

    .content-section ul li:nth-child(2) {
      animation-delay: 0.6s;
    }

    .content-section ul li:nth-child(3) {
      animation-delay: 0.9s;
    }

    .content-section ul li:nth-child(4) {
      animation-delay: 1.2s;
    }

    .content-section ul li:nth-child(5) {
      animation-delay: 1.5s;
    }

    .content-section ul li:nth-child(6) {
      animation-delay: 1.8s;
    }

    .image-gallery {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 1.8rem;
      margin-top: 2rem;
      animation: fadeInUp 2.5s ease-out;
    }

    .image-gallery img {
      width: 100%;
      border-radius: 12px;
      box-shadow: 0 12px 25px rgba(0, 0, 0, 0.1);
      transition: all 0.4s ease;
    }

    .image-gallery img:hover {
      transform: scale(1.05) rotateZ(1deg);
      box-shadow: 0 18px 30px rgba(0, 0, 0, 0.2);
    }

    .btn-primary {
      background-color: #206478;
      border: none;
      padding: 0.75rem 2rem;
      font-weight: bold;
      border-radius: 8px;
      transition: background 0.3s ease, transform 0.3s ease;
    }

    .btn-primary:hover {
      background: #154552;
      transform: translateY(-3px);
    }

    footer {
      background: #1a1a1a;
      color: #ccc;
      padding: 2.5rem 1rem;
      text-align: center;
      margin-top: 4rem;
      animation: fadeIn 2s ease-in-out;
    }

    footer p {
      margin: 0;
      font-size: 0.95rem;
    }

    /* Animasi */
    @keyframes fadeIn {
      from { opacity: 0; }
      to { opacity: 1; }
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
      from { transform: translateY(50px); opacity: 0; }
      to { transform: translateY(0); opacity: 1; }
    }

    @keyframes slideLeft {
      from { transform: translateX(-50px); opacity: 0; }
      to { transform: translateX(0); opacity: 1; }
    }

    /* Responsive Mobile */
    @media (max-width: 576px) {
      .hero-header h1 {
        font-size: 2.5rem;
      }

      .hero-header p {
        font-size: 1rem;
      }

      .image-gallery {
        grid-template-columns: 1fr;
      }

      .content-section {
        padding: 2rem 1rem;
      }

      footer p {
        font-size: 0.9rem;
      }
    }
  </style>
</head>
<body>

  <header class="hero-header">
    <img src="assets/logo_smkn2pinrang.png" alt="Logo SMK Negeri 2 Pinrang">
    <h1>Dokumentasi SMK Negeri 2 Pinrang</h1>
    <p>Berbagai dokumentasi kegiatan, fasilitas, dan prestasi yang ada di SMK Negeri 2 Pinrang</p>
  </header>

  <main class="content-section container">

    <section>
      <h2>Sejarah SMK Negeri 2 Pinrang</h2>
      <p>SMK Negeri 2 Pinrang didirikan pada tahun 2003 dan menjadi salah satu sekolah menengah kejuruan terkemuka di Kabupaten Pinrang. Sekolah ini bertujuan untuk menyediakan pendidikan yang berkualitas dengan fokus pada kejuruan yang dibutuhkan oleh dunia industri.</p>
      <p>Sejak berdiri, SMK Negeri 2 Pinrang telah menjadi pilihan utama bagi banyak siswa yang ingin mengembangkan keterampilan praktis yang berguna di dunia kerja. Dengan fasilitas modern dan pengajaran berbasis kompetensi, sekolah ini terus berinovasi untuk memenuhi kebutuhan pendidikan di era globalisasi.</p>
    </section>

    <section>
      <h2>Visi dan Misi</h2>
      <p><strong>Visi:</strong> Menjadi sekolah vokasi yang unggul dan berwawasan global dengan menghasilkan lulusan yang siap menghadapi tantangan dunia kerja.</p>
      <ul>
        <li>Menyelenggarakan pendidikan dan pelatihan kejuruan yang berkualitas.</li>
        <li>Menjalin kemitraan dengan dunia usaha dan industri untuk menciptakan peluang kerja bagi lulusan.</li>
        <li>Mengembangkan budaya sekolah yang positif dan mendukung pembentukan karakter siswa.</li>
      </ul>
    </section>

    <section>
      <h2>Fasilitas Sekolah</h2>
      <p>SMK Negeri 2 Pinrang memiliki berbagai fasilitas pendukung yang memungkinkan siswa untuk mendapatkan pengalaman praktis yang relevan dengan bidang keahlian mereka. Fasilitas yang ada antara lain:</p>
      <ul>
        <li>Laboratorium Komputer dan Jaringan</li>
        <li>Laboratorium Agreteknologi Pengolahan Hasil Pertanian</li>
        <li>Ruang Praktik Perhotelan dan Pariwisata</li>
        <li>Perpustakaan dan Ruang Belajar</li>
        <li>Area Olahraga dan Lapangan Sepak Bola</li>
        <li>Area Parkir dan Fasilitas Umum</li>
      </ul>
    </section>

    <section>
      <h2>Dokumentasi Kegiatan</h2>
      <p>Berikut adalah beberapa foto dokumentasi kegiatan dan fasilitas yang ada di SMK Negeri 2 Pinrang:</p>
      <div class="image-gallery">
        <img src="assets/belajar.jpeg" alt="Kegiatan Belajar Mengajar">
        <img src="assets/ph.jpeg" alt="Siswa Praktik Perhotelan">
        <img src="assets/lks.jpeg" alt="Lomba Kompetensi Siswa">
        <img src="assets/lks1.jpeg" alt="Lomba Kompetensi Siswa">
        <img src="assets/lks2.jpeg" alt="Lomba Kompetensi Siswa">
        <img src="assets/praktik.jpeg" alt="Eksperimen di Laboratorium">
        <img src="assets/mengaji.jpeg" alt="Pendidikan Karakter Siswa">
        <img src="assets/penanaman-pohon.jpeg" alt="Penanaman Pohon">
        <img src="assets/olahraga.jpeg" alt="Kegiatan Olahraga Siswa">
      </div>
    </section>

    <section>
      <h2>Prestasi SMK Negeri 2 Pinrang</h2>
      <p>SMK Negeri 2 Pinrang telah berhasil meraih berbagai prestasi di tingkat provinsi dan nasional, di antaranya:</p>
      <ul>
        <li>Juara 3 Lomba Kompetensi Siswa (LKS) Tingkat Provinsi Sulawesi Selatan</li>
        <li>Juara 1 Undipa Goes To School Tingkat Provinsi Sulawesi Selatan</li>
        <li>Juara 2 Undipa Goes To School Tingkat Provinsi Sulawesi Selatan</li>
        <li>Juara 3 Lomba Keterampilan Industri</li>
        <li>Penghargaan Sekolah Berprestasi dari Dinas Pendidikan Provinsi Sulawesi Selatan</li>
      </ul>
    </section>

    <div class="text-center mt-4">
      <a href="index.php" class="btn btn-primary">Kembali ke Beranda</a>
    </div>

  </main>

  <footer>
  <p>&copy; 2025 Ikhsan Pratama | <a href="https://www.smkn2pinrang.sch.id" target="_blank" style="color: #ccc; text-decoration: none;">SMKN 2 PINRANG</a></p>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
