<?php
// Pastikan ini dipanggil lewat POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari form
    $nama     = htmlspecialchars($_POST['nama'] ?? '');
    $lokasi   = htmlspecialchars($_POST['lokasi'] ?? '');
    $deskripsi = htmlspecialchars($_POST['deskripsi'] ?? '');
    $tingkat  = htmlspecialchars($_POST['tingkat'] ?? '');

    // Validasi dasar
    if (empty($lokasi) || empty($deskripsi) || empty($tingkat)) {
        die('Data tidak lengkap.');
    }

    // Simpan ke database atau file (contoh: simpan ke file)
    $data = [
        'waktu'     => date('Y-m-d H:i:s'),
        'nama'      => $nama ?: 'Anonim',
        'lokasi'    => $lokasi,
        'deskripsi' => $deskripsi,
        'tingkat'   => ucfirst($tingkat)
    ];

    $jsonData = json_encode($data, JSON_PRETTY_PRINT);
    file_put_contents('laporan/laporan_' . time() . '.json', $jsonData);

    // Redirect ke halaman sukses
    header("Location: laporan_berhasil.php");
    exit();
} else {
    // Jika tidak melalui POST
    header("Location: form_laporan.php");
    exit();
}
