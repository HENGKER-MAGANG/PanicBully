<?php
include 'config.php';

$token = "mrDCnGqnLfihKSXNbsfh"; 
$target = "6282261325895,6282349273941,6285241419991"; 
$responseDetail = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['latitude']) && isset($_POST['longitude'])) {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $mapsLink = "https://www.google.com/maps?q=$latitude,$longitude";

    // Simpan ke database
    $lokasi = $mapsLink;
    $nama = ''; // Kosong untuk anonim
    $deskripsi = 'Laporan otomatis dari tombol panic.';
    $tingkat = 'tinggi';
    $tanggal = date('Y-m-d H:i:s');

    $stmt = $conn->prepare("INSERT INTO laporan_bully (nama, lokasi, deskripsi, tingkat, tanggal) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nama, $lokasi, $deskripsi, $tingkat, $tanggal);
    $stmt->execute();
    $stmt->close();

    // Kirim via Fonnte
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
    curl_close($curl);

    $responseDetail = "✅ Laporan berhasil dikirim dan disimpan! Tim akan segera menindaklanjuti.";
}

?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Panic Bully</title>
  <link rel="icon" href="assets/logo_smkn2pinrang.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Roboto', sans-serif;
      background: linear-gradient(135deg, #e3f2fd, #ffffff);
      margin: 0;
      min-height: 100vh;
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

    .logo-left, .logo-right {
      height: 50px;
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

    main {
      display: flex;
      justify-content: center;
      padding: 1rem;
      flex-grow: 1;
    }

    .main-card {
      background: white;
      border-radius: 16px;
      padding: 2rem 2.5rem;
      margin: 40px auto;
      width: 100%;
      max-width: 550px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
    }

    h2 {
      color: #0d47a1;
      font-weight: 700;
      margin-bottom: 1rem;
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
    }

    #panic-btn:hover {
      background: #b71c1c;
      transform: scale(1.05);
    }

    #panic-btn:disabled {
      background: #888;
      cursor: not-allowed;
    }

    #response {
      margin-top: 30px;
      padding: 1.2rem;
      border-left: 6px solid #4caf50;
      background-color: #e8f5e9;
      color: #2e7d32;
      border-radius: 10px;
      font-size: 1.05rem;
      font-weight: 500;
      display: <?php echo $responseDetail ? 'block' : 'none'; ?>;
    }

    .footer {
      background-color: #0a1929;
      color: #ccc;
      text-align: center;
      padding: 1rem;
      font-size: 0.95rem;
    }

    @media (max-width: 768px) {
      .header {
        flex-direction: row;
        align-items: center;
        justify-content: space-between;
        padding: 0.8rem 1rem;
      }

      .header-title {
        font-size: 1.2rem;
        justify-content: center;
      }

      .main-card {
        padding: 1.5rem;
        margin: 20px auto;
      }

      #panic-btn {
        width: 100%;
        padding: 14px;
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

  <main>
    <div class="main-card text-center">
      <h2>🚨 Laporkan Tindakan Bullying</h2>
      <p>
        Merasa tidak aman? Mengalami perundungan? Klik tombol di bawah untuk melaporkan tindakan bullying secara cepat dan rahasia.
      </p>
      <form id="panic-form" method="POST">
        <input type="hidden" name="latitude" id="latitude">
        <input type="hidden" name="longitude" id="longitude">
        <button type="button" id="panic-btn" onclick="getLocation()">LAPORKAN SEKARANG</button>
      </form>
      <div id="response">
        <?php echo $responseDetail; ?>
      </div>
    </div>
  </main>

  <footer class="footer">
    <p>&copy; 2025 Community Programmer | Ikhsan Pratama - SMKN 2 Pinrang</p>
  </footer>

  <script>
    function getLocation() {
      const btn = document.getElementById('panic-btn');
      btn.innerText = 'Mengirim...';
      btn.disabled = true;

      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError, { timeout: 5000 });
      } else {
        alert("Browser Anda tidak mendukung Geolocation.");
        resetButton();
      }
    }

    function showPosition(position) {
      document.getElementById("latitude").value = position.coords.latitude;
      document.getElementById("longitude").value = position.coords.longitude;
      document.getElementById("panic-form").submit();
    }

    function showError(error) {
      alert("Tidak dapat mengambil lokasi. Pastikan GPS aktif dan izin lokasi diberikan.");
      resetButton();
    }

    function resetButton() {
      const btn = document.getElementById('panic-btn');
      btn.innerText = 'LAPORKAN SEKARANG';
      btn.disabled = false;
    }

    // Auto hide success message after 10 seconds
    window.onload = function () {
      setTimeout(() => {
        const responseBox = document.getElementById("response");
        if (responseBox) {
          responseBox.style.display = "none";
        }
      }, 10000);
    };
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
