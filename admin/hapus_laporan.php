<?php
include '../config.php';
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM laporan_bully WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        $_SESSION['message'] = "Laporan berhasil dihapus.";
    } else {
        $_SESSION['message'] = "Gagal menghapus laporan.";
    }
}

header("Location: data_laporan.php");
exit;
?>
