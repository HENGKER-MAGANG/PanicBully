<?php
session_start();
include 'config.php';

$token = "mrDCnGqnLfihKSXNbsfh";
$target = "6282261325895,6282349273941,6285241419991";
$responseDetail = '';
$errorDetail = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['latitude']) && isset($_POST['longitude'])) {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $mapsLink = "https://www.google.com/maps?q=$latitude,$longitude";

    $lokasi = $mapsLink;
    $nama = '';
    $deskripsi = 'Laporan otomatis dari tombol panic.';
    $tingkat = 'tinggi';
    $tanggal = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO laporan_bully (nama, lokasi, deskripsi, tingkat, tanggal) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $lokasi, $deskripsi, $tingkat, $tanggal);
    $stmt->execute();
    $stmt->close();

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://api.fonnte.com/send',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => array(
            'target' => $target,
            'message' => "Tolong Saya Kena Bully, Lokasi Saya Di Sini $mapsLink",
        ),
        CURLOPT_HTTPHEADER => array("Authorization: $token"),
    ));
    $response = curl_exec($curl);
    $curlError = curl_error($curl);
    curl_close($curl);

    if ($response && !$curlError) {
        $responseDetail = "✅ Laporan berhasil dikirim dan disimpan! Tim akan segera menindaklanjuti.";
    } else {
        $errorDetail = "❌ Gagal mengirim pesan ke WhatsApp. Tapi laporan tetap disimpan.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Panic Bully</title>
  <link rel="icon" href="assets/logo_smkn2pinrang.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet" />
  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to right, #e3f2fd, #ffffff);
      min-height: 100vh;
      display: flex;
      flex-direction: column;
    }

    .header {
      background: linear-gradient(to right, #0d47a1, #1565c0);
      color: white;
      padding: 1.2rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    .logo {
      height: 55px;
      transition: transform 0.3s ease;
    }

    .logo:hover {
      transform: scale(1.05);
    }

    .header-title {
      font-size: 1.75rem;
      font-weight: 700;
      flex: 1;
      text-align: center;
      min-width: 200px;
      color: #ffffff;
      text-shadow: 1px 1px 2px rgba(0,0,0,0.2);
    }

    main {
      flex-grow: 1;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 2rem 1rem;
    }

    .card-report {
      background: #ffffff;
      border-radius: 1rem;
      padding: 2.5rem 2rem;
      width: 100%;
      max-width: 600px;
      box-shadow: 0 12px 30px rgba(0,0,0,0.12);
      text-align: center;
      animation: fadeIn 0.8s ease;
    }

    h2 {
      color: #d32f2f;
      margin-bottom: 1rem;
      font-weight: bold;
    }

    p {
      font-size: 1.05rem;
      color: #444;
      margin-bottom: 2rem;
    }

    #panic-btn {
      padding: 14px 36px;
      font-size: 1.1rem;
      background: #d32f2f;
      color: #fff;
      border: none;
      border-radius: 50px;
      box-shadow: 0 8px 16px rgba(211, 47, 47, 0.4);
      transition: 0.3s ease;
      animation: pulse 1.5s infinite;
    }

    #panic-btn:hover {
      background: #b71c1c;
      transform: scale(1.05);
    }

    #panic-btn:disabled {
      background: #888;
      cursor: not-allowed;
      animation: none;
    }

    footer {
      background: #0a1929;
      color: #ccc;
      text-align: center;
      padding: 1rem;
      font-size: 0.95rem;
      box-shadow: 0 -2px 6px rgba(0, 0, 0, 0.08);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(40px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes pulse {
      0% { transform: scale(1); box-shadow: 0 0 0 0 rgba(211, 47, 47, 0.6); }
      70% { transform: scale(1.05); box-shadow: 0 0 0 20px rgba(211, 47, 47, 0); }
      100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(211, 47, 47, 0); }
    }

    @media (max-width: 576px) {
      .header {
        flex-direction: row;
        justify-content: center;
      }

      .logo {
        height: 40px;
        margin: 5px;
      }

      .header-title {
        order: 1;
        width: 100%;
        font-size: 1.3rem;
        text-align: center;
        margin: 0.5rem 0;
      }

      h2 {
        font-size: 1.3rem;
      }

      p {
        font-size: 0.95rem;
      }
    }
  </style>
</head>
<body>

  <!-- Header Responsive -->
  <header class="header d-flex justify-content-between align-items-center flex-wrap px-3">
    <img src="assets/logo-sulsel.png" class="logo me-3" alt="Logo Sulsel">
    <div class="header-title text-center flex-grow-1 my-2 my-md-0">
      <i class="fa-solid fa-bell"></i> Panic Bully Button
    </div>
    <img src="assets/logo_smkn2pinrang.png" class="logo ms-3" alt="Logo SMKN 2 Pinrang">
  </header>

  <main>
    <div class="card-report">
      <h2>🚨 Laporkan Tindakan Bullying</h2>
      <p>Merasa tidak aman? Klik tombol di bawah untuk mengirim laporan darurat dengan lokasi Anda.</p>
      <form id="panic-form" method="POST">
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
        <button type="button" id="panic-btn" onclick="getLocation()">LAPORKAN SEKARANG</button>
      </form>
    </div>
  </main>

  <footer>
    &copy; 2025 Community Programmer | Ikhsan Pratama - SMKN 2 Pinrang
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
    function getLocation() {
      Swal.fire({
        title: 'Konfirmasi Laporan',
        text: "❗ Apakah Anda yakin ingin mengirim laporan bullying sekarang?",
        icon: 'warning',
        showCancelButton: false,
        confirmButtonText: 'Kirim Laporan Sekarang',
        confirmButtonColor: '#d32f2f',
      }).then((result) => {
        if (result.isConfirmed) {
          const btn = document.getElementById('panic-btn');
          btn.innerText = 'Mengirim...';
          btn.disabled = true;

          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(showPosition, showError, { timeout: 5000 });
          } else {
            showError();
          }
        }
      });
    }

    function showPosition(position) {
      document.getElementById("latitude").value = position.coords.latitude;
      document.getElementById("longitude").value = position.coords.longitude;
      document.getElementById("panic-form").submit();
    }

    function showError() {
      Swal.fire({
        icon: 'error',
        title: 'Gagal Mengambil Lokasi',
        text: '❌ Pastikan GPS aktif dan izin lokasi diberikan.'
      });
      resetButton();
    }

    function resetButton() {
      const btn = document.getElementById('panic-btn');
      btn.innerText = 'LAPORKAN SEKARANG';
      btn.disabled = false;
    }

    <?php if ($responseDetail): ?>
    window.onload = function () {
      Swal.fire({
        icon: 'success',
        title: 'Laporan Terkirim',
        text: '<?= $responseDetail ?>',
        confirmButtonText: 'OK',
        confirmButtonColor: '#0d47a1'
      });
    };
    <?php elseif ($errorDetail): ?>
    window.onload = function () {
      Swal.fire({
        icon: 'error',
        title: 'Gagal Mengirim Pesan',
        text: '<?= $errorDetail ?>',
        confirmButtonText: 'OK',
        confirmButtonColor: '#b71c1c'
      });
    };
    <?php endif; ?>
  </script>
</body>
</html>
