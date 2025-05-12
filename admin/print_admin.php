<?php
include '../config.php';
$data = mysqli_query($conn, "SELECT * FROM admin");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Cetak Data Admin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 40px;
    }
    h2 {
      text-align: center;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 30px;
    }
    th, td {
      border: 1px solid #000;
      padding: 8px 12px;
      text-align: left;
    }
    th {
      background-color: #f2f2f2;
    }
    @media print {
      @page {
        size: A4;
        margin: 20mm;
      }
    }
  </style>
</head>
<body onload="window.print()">
  <h2>Data Admin Panic Bully</h2>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Username</th>
        <th>Password</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($row = mysqli_fetch_assoc($data)) : ?>
      <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['username']) ?></td>
        <td><?= htmlspecialchars($row['password']) ?></td>
      </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</body>
</html>
