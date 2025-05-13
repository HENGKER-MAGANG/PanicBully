<?php
session_start();
include '../config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $lokasi = $_POST['lokasi'];
    $deskripsi = $_POST['deskripsi'];
    $tingkat = $_POST['tingkat'];

    $stmt = $conn->prepare("INSERT INTO laporan (nama, lokasi, deskripsi, tingkat, created_at) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("ssss", $nama, $lokasi, $deskripsi, $tingkat);
    $stmt->execute();

    header("Location: dashboard.php?status=sukses");
}
?>
