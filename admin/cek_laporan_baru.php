<?php
include '../config.php';

$lastCheck = isset($_SESSION['last_check']) ? $_SESSION['last_check'] : '1970-01-01 00:00:00';
$query = "SELECT COUNT(*) AS jumlah FROM laporan_bully WHERE tanggal > '$lastCheck'";
$result = mysqli_query($conn, $query);
$data = mysqli_fetch_assoc($result);

// Update waktu terakhir cek
$_SESSION['last_check'] = date('Y-m-d H:i:s');

echo json_encode(['baru' => (int)$data['jumlah']]);
