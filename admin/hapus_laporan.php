<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM laporan_bully WHERE id = $id";

    if (mysqli_query($conn, $query)) {
        header("Location: data_laporan.php?success=deleted");
    } else {
        header("Location: data_laporan.php?error=failed");
    }
    exit;
} else {
    header("Location: data_laporan.php?error=invalid");
    exit;
}
?>
