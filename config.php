<?php
session_start();

// Koneksi DataBase
$conn = new mysqli("localhost", "root", "", "panicbully");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
