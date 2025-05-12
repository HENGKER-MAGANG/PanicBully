<?php
include '../config.php';

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_bullying_" . date("Y-m-d") . ".xls");

$filter_tingkat = isset($_GET['tingkat']) ? $_GET['tingkat'] : '';
$cari_nama = isset($_GET['cari_nama']) ? $_GET['cari_nama'] : '';

$query = "SELECT * FROM laporan_bully WHERE 1=1";
if (!empty($filter_tingkat)) {
    $query .= " AND tingkat = '" . mysqli_real_escape_string($conn, $filter_tingkat) . "'";
}
if (!empty($cari_nama)) {
    $query .= " AND nama LIKE '%" . mysqli_real_escape_string($conn, $cari_nama) . "%'";
}
$query .= " ORDER BY tanggal DESC";
$result = mysqli_query($conn, $query);

echo "<table border='1'>";
echo "<tr>
        <th>No</th>
        <th>Nama Pelapor</th>
        <th>Lokasi</th>
        <th>Deskripsi</th>
        <th>Tingkat</th>
        <th>Tanggal</th>
      </tr>";

$no = 1;
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$no}</td>
            <td>" . htmlspecialchars($row['nama'] ?: 'Anonim') . "</td>
            <td>" . htmlspecialchars($row['lokasi']) . "</td>
            <td>" . htmlspecialchars($row['deskripsi']) . "</td>
            <td>" . ucfirst($row['tingkat']) . "</td>
            <td>" . date('d-m-Y H:i', strtotime($row['tanggal'])) . "</td>
          </tr>";
    $no++;
}
echo "</table>";
?>
