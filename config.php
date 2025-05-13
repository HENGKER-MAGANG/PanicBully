<?php
$host = '127.0.0.1'; // atau IP internal MySQL jika tahu
$user = 'panicuser';
$password = 'PanicUser@123';
$database = 'default';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi ke database gagal: " . mysqli_connect_error());
}
?>
