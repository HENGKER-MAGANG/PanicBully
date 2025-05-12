<?php
session_start();

$host = getenv('DB_HOST') ?: 'db';  // HARUS 'db' sesuai docker-compose
$user = getenv('DB_USER') ?: 'panicuser';
$pass = getenv('DB_PASS') ?: 'panicbully2025!';
$db   = getenv('DB_NAME') ?: 'panicbully';

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
