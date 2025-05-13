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
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => array(
            'target' => $target,
            'message' => "Tolong Saya Kena Bully, Lokasi Saya Di Sini $mapsLink",
        ),
        CURLOPT_HTTPHEADER => array(
            "Authorization: $token"
        ),
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
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Panic Bully</title>
  <link rel="icon" href="assets/logo_smkn2pinrang.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <audio id="siren-audio" src="https://assets.mixkit.co/sfx/download/mixkit-police-siren-us-1640.mp3" preload="auto"></audio>
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: linear-gradient(135deg, #e3f2fd, #ffffff);
      min-height: 100vh;
      margin: 0;
      display: flex;
      flex-direction: column;
    }
    .header {
      background: linear-gradient(to right, #0d47a1, #1976d2);
      color: white;
      padding: 1rem 2rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
    }
    .header-title {
      display: flex;
      align-items: center;
      gap: 0.6rem;
      font-size: 1.6rem;
      font-weight: bold;
      flex-grow: 1;
      justify-content: center;
    }
    .logo-left, .logo-right {
      height: 50px;
    }
    .dashboard-nav {
      text-align: center;
      margin-top: 0.5rem;
    }
    .dashboard-nav a {
      background-color: #1565c0;
      color: white;
      text-decoration: none;
      padding: 0.5rem 1.2rem;
      border-radius: 10px;
      font-weight: 500;
      transition: 0.3s ease;
    }
    .dashboard-nav a:hover {
      background-color: #0d47a1;
    }
    main {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 2rem;
    }
    .main-card {
      background: white;
      border-radius: 16px;
      padding: 2rem 2.5rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
      max-width: 550px;
      width: 100%;
      text-align: center;
    }
    h2 {
      color: #0d47a1;
      font-weight: 700;
    }
    p {
      font-size: 1.1rem;
      color: #555;
    }
    #panic-btn {
      font-size: 1.1rem;
      padding: 14px 36px;
      background: #d32f2f;
      border: none;
      color: white;
      border-radius: 50px;
      transition: 0.3s ease;
      box-shadow: 0 6px 14px rgba(211, 47, 47, 0.4);
      display: inline-flex;
      align-items: center;
      gap: 0.6rem;
    }
    #panic-btn:hover {
      background: #b71c1c;
      transform: scale(1.05);
    }
    #panic-btn:disabled {
      background: #888;
      cursor: not-allowed;
    }
    .footer {
      background-color: #0a1929;
      color: #ccc;
      text-align: center;
      padding: 1rem;
    }
    @media (max-width: 768px) {
      .main-card {
        padding: 1.5rem;
      }
      #panic-btn {
        width: 100%;
        justify-content: center;
      }
    }
  </style>
</head>
<body>

<header class="header">
  <img src="assets/logo-sulsel.png" alt="Logo Sulsel" class="logo-left">
  <div class="header-title">
    <i class="fa-solid fa-bell"></i>
    Panic Bully Button
  </div>
  <img src="assets/logo_smkn2pinrang.png" alt="Logo SMKN 2 Pinrang" class="logo-right">
</header>

<nav class="dashboard-nav">
  <a href="index.php"><i class="fa fa-arrow-left me-2"></i>Kembali ke Beranda</a>
</nav>

<main>
  <div class="main-card">
    <h2>🚨 Laporkan Tindakan Bullying</h2>
    <p>Merasa tidak aman? Klik tombol di bawah untuk melaporkan tindakan bullying secara cepat dan rahasia.</p>
    <form id="panic-form" method="POST">
      <input type="hidden" name="latitude" id="latitude">
      <input type="hidden" name="longitude" id="longitude">
      <button type="button" id="panic-btn" onclick="getLocation()">
        <span id="btn-text"><i class="fa-solid fa-triangle-exclamation"></i> LAPORKAN SEKARANG</span>
        <span id="btn-loading" class="d-none"><i class="fa-solid fa-spinner fa-spin"></i> Mengirim...</span>
      </button>
    </form>
  </div>
</main>

<footer class="footer">
  <p>&copy; 2025 Community Programmer | Ikhsan Pratama - SMKN 2 Pinrang</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
function getLocation() {
  Swal.fire({
    title: 'Konfirmasi',
    html: "❗<b>Fitur ini hanya untuk keadaan darurat!</b><br><br>Jika tidak urgent, gunakan fitur 'Chat Laporan'.<br><br>Apakah kamu yakin ingin melaporkan sekarang?",
    icon: 'warning',
    showCancelButton: true,
    showDenyButton: true,
    confirmButtonText: 'Laporkan Sekarang',
    denyButtonText: 'Batal & Kirim ke Admin',
    cancelButtonText: 'Tutup',
    reverseButtons: true
  }).then((result) => {
    if (result.isConfirmed) {
      const btn = document.getElementById('panic-btn');
      document.getElementById('btn-text').classList.add('d-none');
      document.getElementById('btn-loading').classList.remove('d-none');
      btn.disabled = true;

      document.getElementById('siren-audio').play();

      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError, { timeout: 5000 });
      } else {
        showError();
      }

    } else if (result.isDenied) {
      sendCancelMessage();
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
    text: '❌ Gagal mengambil lokasi. Pastikan GPS aktif dan izin lokasi diberikan.'
  });
  resetButton();
}

function resetButton() {
  const btn = document.getElementById('panic-btn');
  btn.disabled = false;
  document.getElementById('btn-text').classList.remove('d-none');
  document.getElementById('btn-loading').classList.add('d-none');
}

function sendCancelMessage() {
  fetch('cancel.php')
    .then(() => {
      Swal.fire({
        icon: 'info',
        title: 'Dibatalkan',
        text: '✅ Laporan dibatalkan dan pesan telah dikirim ke admin.',
        confirmButtonText: 'OK'
      });
    });
}

<?php if ($responseDetail): ?>
window.onload = function () {
  Swal.fire({
    icon: 'success',
    title: 'Laporan Terkirim',
    text: '<?= $responseDetail ?>',
    confirmButtonText: 'OK'
  });
};
<?php elseif ($errorDetail): ?>
window.onload = function () {
  Swal.fire({
    icon: 'error',
    title: 'Gagal Mengirim Pesan',
    text: '<?= $errorDetail ?>',
    confirmButtonText: 'OK'
  });
};
<?php endif; ?>
</script>
</body>
</html>
