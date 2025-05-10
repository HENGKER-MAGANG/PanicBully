<?php
include 'config.php';

$nama = $_POST['nama'] ?? '';
$lokasi = $_POST['lokasi'];
$deskripsi = $_POST['deskripsi'];
$tingkat = $_POST['tingkat'];

$sql = "INSERT INTO laporan (nama, lokasi, deskripsi, tingkat, created_at) 
        VALUES (?, ?, ?, ?, NOW())";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $nama, $lokasi, $deskripsi, $tingkat);

if ($stmt->execute()) {
    echo "<script>alert('Laporan berhasil dikirim');window.location='index.php';</script>";
} else {
    echo "Gagal mengirim laporan: " . $stmt->error;
}
