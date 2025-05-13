<?php
$host = 'nosw48w8ggs8ok4g88g0cwk4';
$user = 'panicuser';
$password = 'PanicUser@123';
$database = 'panicbully';

$conn = mysqli_connect($host, $user, $password, $database);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
