<?php
include '../config.php';
$laporan = mysqli_query($conn, "SELECT * FROM laporan_bully ORDER BY tanggal DESC LIMIT 5");

$no = 1;
while ($row = mysqli_fetch_assoc($laporan)) {
  echo "<tr>";
  echo "<td>{$no}</td>";
  echo "<td>" . htmlspecialchars($row['nama']) . "</td>";
  echo "<td>" . htmlspecialchars($row['lokasi']) . "</td>";
  echo "<td class='text-capitalize'>{$row['tingkat']}</td>";
  echo "<td>" . date('d-m-Y H:i', strtotime($row['tanggal'])) . "</td>";
  echo "</tr>";
  $no++;
}
