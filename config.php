<?php
$host = 'mysql-panicbully';  // Gunakan nama service/database di Coolify
$user = 'panicuser';
$password = 'PanicUser@123';
$database = 'default';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
