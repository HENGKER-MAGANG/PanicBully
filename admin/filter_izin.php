<?php
include '../config.php';

$kelas = isset($_GET['kelas']) ? $_GET['kelas'] : '';

// Query untuk mengambil data izin
if ($kelas != '') {
    $stmt = $conn->prepare("SELECT * FROM izin_siswa WHERE kelas = ? ORDER BY tanggal DESC");
    $stmt->bind_param("s", $kelas);
} else {
    $stmt = $conn->prepare("SELECT * FROM izin_siswa ORDER BY tanggal DESC");
}

$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0):
?>
<div class="table-responsive">
  <table class="table table-striped table-bordered">
    <thead class="table-dark">
      <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Keperluan</th>
        <th>Tanggal Izin</th>
        <th>Jam Keluar</th>
        <th>Jam Kembali</th>
        <th>Status</th>
      </tr>
    </thead>
    <tbody>
      <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= htmlspecialchars($row['nama_lengkap']) ?></td>
          <td><?= htmlspecialchars($row['kelas']) ?></td>
          <td><?= htmlspecialchars($row['alasan_keluar']) ?></td>
          <td><?= date('d-m-Y', strtotime($row['tanggal'])) ?></td>
          <td><?= date('H:i', strtotime($row['tanggal'])) ?></td>
          <td><?= ($row['status'] == 'Kembali') ? date('H:i', strtotime($row['tanggal_kembali'])) : '-' ?></td>
          <td>
            <?php if ($row['status'] == 'Kembali'): ?>
              <span class="badge bg-success">Kembali</span>
            <?php else: ?>
              <span class="badge bg-warning text-dark">Belum Kembali</span>
            <?php endif; ?>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>
<?php
else:
  echo '<div class="alert alert-warning">Tidak ada data izin untuk kelas yang dipilih.</div>';
endif;

$stmt->close();
$conn->close();
?>
