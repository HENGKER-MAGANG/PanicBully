<?php
session_start();
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
      margin: 20mm;
      font-size: 12px;
    }

    h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      table-layout: auto;
      word-wrap: break-word;
    }

    th, td {
      border: 1px solid #000;
      padding: 6px 10px;
      text-align: left;
      vertical-align: top;
      font-size: 12px;
    }

    th {
      background-color: #e0e0e0;
    }

    @media print {
      body {
        margin: 0;
      }

      @page {
        size: A4 portrait;
        margin: 20mm;
      }

      table {
        page-break-inside: auto;
      }

      tr {
        page-break-inside: avoid;
        page-break-after: auto;
      }
    }
  </style>
</head>
<body onload="window.print()">
  <h2>Data Admin Panic Bully</h2>
  <table>
    <thead>
      <tr>
        <th style="width: 5%;">No</th>
        <th style="width: 45%;">Username</th>
        <th style="width: 50%;">Password</th>
      </tr>
    </thead>
    <tbody>
      <?php
      session_start();
      include '../config.php';
      $data = mysqli_query($conn, "SELECT * FROM admin");
      $no = 1;
      while ($row = mysqli_fetch_assoc($data)) :
      ?>
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
