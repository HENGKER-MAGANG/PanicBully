<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "panicbully");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama      = htmlspecialchars($_POST['nama'] ?? '');
    $lokasi    = htmlspecialchars($_POST['lokasi'] ?? '');
    $deskripsi = htmlspecialchars($_POST['deskripsi'] ?? '');
    $tingkat   = htmlspecialchars($_POST['tingkat'] ?? '');

    // Validasi dasar
    if (empty($lokasi) || empty($deskripsi) || empty($tingkat)) {
        die('Data tidak lengkap.');
    }

    // Gunakan "Anonim" jika nama kosong
    $nama = $nama ?: 'Anonim';

    // Siapkan query insert
    $stmt = $conn->prepare("INSERT INTO laporan_bully (nama, lokasi, deskripsi, tingkat, tanggal) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $nama, $lokasi, $deskripsi, $tingkat);

    // Eksekusi dan cek hasil
    if ($stmt->execute()) {
        // Redirect ke halaman sukses
        header("Location: laporan_berhasil.php");
        exit();
    } else {
        echo "Gagal menyimpan laporan: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Jika tidak melalui POST
    header("Location: laporan.php");
    exit();
}

$conn->close();
?>
