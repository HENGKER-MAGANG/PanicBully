<?php
session_start();
require 'config.php';

// Proses jika request adalah POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil dan sanitasi input
    $nama      = htmlspecialchars(trim($_POST['nama'] ?? ''));
    $lokasi    = htmlspecialchars(trim($_POST['lokasi'] ?? ''));
    $deskripsi = htmlspecialchars(trim($_POST['deskripsi'] ?? ''));
    $tingkat   = htmlspecialchars(trim($_POST['tingkat'] ?? ''));

    // Validasi input wajib
    if (empty($lokasi) || empty($deskripsi) || empty($tingkat)) {
        die('Semua kolom wajib diisi.');
    }

    // Jika nama kosong, gunakan "Anonim"
    $nama = $nama ?: 'Anonim';

    // Siapkan query menggunakan prepared statement
    $stmt = $conn->prepare("INSERT INTO laporan_bully (nama, lokasi, deskripsi, tingkat, tanggal) VALUES (?, ?, ?, ?, NOW())");
    if (!$stmt) {
        die("Gagal menyiapkan pernyataan: " . $conn->error);
    }

    $stmt->bind_param("ssss", $nama, $lokasi, $deskripsi, $tingkat);

    // Eksekusi dan arahkan ke halaman sukses
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: laporan.php?status=sukses");
    exit();

    } else {
        die("Gagal menyimpan laporan: " . $stmt->error);
    }
} else {
    // Redirect jika bukan request POST
    header("Location: laporan.php");
    exit();
}
?>
