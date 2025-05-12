<?php
include '../config.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $hapus = mysqli_query($conn, "DELETE FROM admin WHERE id = $id");

    if ($hapus) {
        $_SESSION['message'] = "Admin berhasil dihapus.";
    } else {
        $_SESSION['message'] = "Gagal menghapus admin.";
    }
}

header("Location: data_admin.php");
exit;
?>
