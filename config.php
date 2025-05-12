<?php
session_start();

$host = getenv('DB_HOST');
$user = getenv('DB_USER');
$pass = getenv('DB_PASS');
$db   = getenv('DB_NAME');

// Koneksi MySQL dengan port 3306 (agar pakai TCP, bukan socket)
$conn = new mysqli($host, $user, $pass, $db, 3306);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
