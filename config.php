<?php
session_start();

// Koneksi DataBase dalam Docker
$conn = new mysqli("db", "user", "password", "panicbully");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
