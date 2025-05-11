<?php
include '../config.php';

header('Content-Type: application/json');

$last_id = isset($_GET['last_id']) ? (int)$_GET['last_id'] : 0;

$query = $conn->query("SELECT * FROM data_izin WHERE id > $last_id ORDER BY id DESC LIMIT 1");

$new_count = $query->num_rows;
$latest_id = $last_id;
$latest_izin = null;

if ($new_count > 0) {
    $izin = $query->fetch_assoc();
    $latest_id = $izin['id'];
    $latest_izin = [
        'nama' => $izin['nama'],
        'kelas' => $izin['kelas'],
        'alasan' => $izin['alasan'],
        'waktu_keluar' => $izin['waktu_keluar']
    ];
}

echo json_encode([
    'has_new' => $new_count > 0,
    'new_count' => $new_count,
    'latest_id' => $latest_id,
    'latest_izin' => $latest_izin
]);
