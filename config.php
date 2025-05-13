<?php
$host = 'lkks8wcgo40kc0c8s0gg484';  // pakai nama internal dari Coolify
$user = 'panicuser';
$password = 'PanicUser@123';
$database = 'default';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
