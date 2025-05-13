<?php
// Koneksi ke database
$conn = new mysqli("127.0.0.1", "root", "", "panicbully");

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Cek jika permintaan POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil dan sanitasi data
    $nama      = htmlspecialchars(trim($_POST['nama'] ?? ''));
    $lokasi    = htmlspecialchars(trim($_POST['lokasi'] ?? ''));
    $deskripsi = htmlspecialchars(trim($_POST['deskripsi'] ?? ''));
    $tingkat   = htmlspecialchars(trim($_POST['tingkat'] ?? ''));

    // Validasi input wajib
    if (empty($lokasi) || empty($deskripsi) || empty($tingkat)) {
        die('Semua data wajib diisi.');
    }

    // Gunakan "Anonim" jika nama kosong
    $nama = $nama ?: 'Anonim';

    // Siapkan dan eksekusi query
    $stmt = $conn->prepare("INSERT INTO laporan_bully (nama, lokasi, deskripsi, tingkat, tanggal) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $nama, $lokasi, $deskripsi, $tingkat);

    if ($stmt->execute()) {
        header("Location: laporan_berhasil.php");
        exit();
    } else {
        echo "Gagal menyimpan laporan: " . $stmt->error;
    }

    $stmt->close();
} else {
    // Redirect jika bukan POST
    header("Location: laporan.php");
    exit();
}

$conn->close();
?>
