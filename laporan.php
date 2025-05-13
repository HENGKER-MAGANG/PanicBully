<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <title>Laporkan Bullying - Panic Bully</title>
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
      overflow-x: hidden;
    }

    .report {
      background: url('assets/hero-smk2.jpg') no-repeat center center / cover;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      position: relative;
      color: #fff;
    }

    .report::before {
      content: '';
      position: absolute;
      top: 0; left: 0; right: 0; bottom: 0;
      background: rgba(0, 0, 0, 0.6);
      z-index: 0;
    }

    .report-form {
      position: relative;
      z-index: 1;
      background: rgba(255, 255, 255, 0.1);
      backdrop-filter: blur(10px);
      padding: 2rem;
      border-radius: 20px;
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 600px;
    }

    .report-form h2 {
      text-align: center;
      margin-bottom: 1.5rem;
      font-weight: 700;
      color: #fff;
    }

    .form-control, .form-select {
      background-color: rgba(255,255,255,0.2);
      border: none;
      color: #fff;
    }

    .form-control::placeholder {
      color: #eee;
    }

    .form-control:focus, .form-select:focus {
      box-shadow: none;
      border: 2px solid #f4511e;
      background-color: rgba(255,255,255,0.3);
    }

    .form-select {
      appearance: none;
      padding-right: 2.5rem;
      background-image: url("data:image/svg+xml;charset=UTF-8,%3Csvg viewBox='0 0 140 140' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M70 100 L40 60 H100 Z' fill='white'/%3E%3C/svg%3E");
      background-repeat: no-repeat;
      background-position: right 1rem center;
      background-size: 1rem;
    }

    .form-select option {
      background-color: #222;
      color: #fff;
    }

    .btn-custom {
      padding: 12px 30px;
      font-size: 1rem;
      border-radius: 30px;
      border: none;
      background: linear-gradient(to right, #e53935, #f4511e);
      color: white;
      transition: all 0.3s ease;
      width: 100%;
    }

    .btn-custom:hover {
      background: linear-gradient(to right, #b71c1c, #ef6c00);
      transform: scale(1.03);
    }

    .back-btn {
      position: absolute;
      top: 20px;
      left: 20px;
      z-index: 3;
    }

    .back-btn a {
      text-decoration: none;
      color: white;
      background: rgba(0,0,0,0.4);
      padding: 8px 15px;
      border-radius: 30px;
      font-size: 0.95rem;
      transition: background 0.3s ease;
    }

    .back-btn a:hover {
      background: rgba(255, 255, 255, 0.2);
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
      z-index: 2;
    }
  </style>
</head>
<body>

  <div class="back-btn">
    <a href="index.php"><i class="fas fa-arrow-left me-1"></i> Kembali ke Beranda</a>
  </div>

  <section class="report">
    <form class="report-form" method="post" action="kirim_laporan.php">
      <h2><i class="fas fa-bullhorn me-2"></i>Form Laporan Bullying</h2>

      <div class="mb-3">
        <input type="text" class="form-control" name="nama" placeholder="Nama Pelapor (opsional)">
      </div>

      <div class="mb-3">
        <input type="text" class="form-control" name="lokasi" placeholder="Lokasi Kejadian" required>
      </div>

      <div class="mb-3">
        <textarea class="form-control" name="deskripsi" rows="4" placeholder="Deskripsikan kejadian..." required></textarea>
      </div>

      <div class="mb-3">
        <select class="form-select" name="tingkat" required>
          <option value="" disabled selected>Pilih Tingkat Urgensi</option>
          <option value="rendah">Rendah</option>
          <option value="sedang">Sedang</option>
          <option value="tinggi">Tinggi</option>
        </select>
      </div>

      <button type="submit" class="btn btn-custom"><i class="fas fa-paper-plane me-2"></i>Kirim Laporan</button>
    </form>
  </section>

  <footer>
    &copy; 2025 Panic Bully | Ikhsan Pratama - SMKN 2 Pinrang
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php if (isset($_GET['status']) && $_GET['status'] === 'sukses'): ?>
  <script>
    Swal.fire({
      icon: 'success',
      title: 'Laporan Berhasil Dikirim!',
      text: 'Terima kasih atas partisipasimu. Laporanmu akan segera ditindaklanjuti.',
      confirmButtonColor: '#f4511e'
    });
  </script>
  <?php endif; ?>

</body>
</html>
