<?php
$host = 'mysql-panicbully'; // atau bisa diganti sesuai IP internal/container
$user = 'panicuser';
$password = 'PanicUser@123';
$database = 'default';

// Membuat koneksi
$conn = mysqli_connect($host, $user, $password, $database);

// Mengecek koneksi
if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}

// Jika perlu debug sukses koneksi:
// echo "Koneksi ke database berhasil!";
?>
