<?php
include '../config.php';
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS total FROM laporan_bully"))['total'];
echo json_encode(['total' => $total]);
