<?php
include '../config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Set header untuk download file Excel
header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=laporan_bullying.xls");
header("Pragma: no-cache");
header("Expires: 0");

// Tambahkan BOM UTF-8 agar Excel bisa mengenali karakter non-ASCII
echo "\xEF\xBB\xBF";

// Header kolom
echo "No\tNama Pelapor\tLokasi\tDeskripsi\tTingkat\tTanggal\n";

// Ambil data dari tabel laporan_bully
$laporan = $conn->query("SELECT * FROM laporan_bully ORDER BY tanggal DESC");
$no = 1;

while ($row = $laporan->fetch_assoc()) {
    echo $no++ . "\t" .
         $row['nama_pelapor'] . "\t" .
         $row['lokasi'] . "\t" .
         str_replace(["\t", "\n", "\r"], ' ', $row['deskripsi']) . "\t" .
         ucfirst($row['tingkat']) . "\t" .
         date('d-m-Y H:i', strtotime($row['tanggal'])) . "\n";
}

$tanggal_dari = $_GET['tanggal_dari'];
$tanggal_sampai = $_GET['tanggal_sampai'];

$query = "SELECT * FROM laporan_bully WHERE tanggal BETWEEN '$tanggal_dari 00:00:00' AND '$tanggal_sampai 23:59:59'";
$result = mysqli_query($conn, $query);

?>
