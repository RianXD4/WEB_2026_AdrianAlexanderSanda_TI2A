<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$nama = trim($_POST['nama'] ?? '');
$no_anggota = trim($_POST['no_anggota'] ?? '');
$alamat = trim($_POST['alamat'] ?? '');
$no_hp = trim($_POST['no_hp'] ?? '');
$jenis_kelamin = trim($_POST['jenis_kelamin'] ?? '');

$error = [];
if ($nama === '') {
    $error[] = "Nama wajib diisi";
}
if ($no_anggota === '') {
    $error[] = "No. Anggota wajib diisi";
}
if (!in_array($jenis_kelamin, ['Perempuan', 'Laki-Laki'], true)) {
    $error[] = "Jenis kelamin wajib dipilih";
}

if (empty($error) && $no_anggota !== '') {
    $cek = $pdo->prepare("SELECT COUNT(*) FROM anggota WHERE no_anggota = :no_anggota");
    $cek->execute(['no_anggota' => $no_anggota]);
    if ($cek->fetchColumn() > 0) {
        $error[] = "No. Anggota \"$no_anggota\" sudah terdaftar";
    }
}

if (!empty($error)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $error)];
    header('Location: tambah.php');
    exit;
}

$stmt = $pdo->prepare(
    "INSERT INTO anggota (nama, no_anggota, alamat, no_hp, jenis_kelamin)
     VALUES (:nama, :no_anggota, :alamat, :no_hp, :jenis_kelamin)
     RETURNING id"
);

$stmt->execute([
    'nama' => $nama,
    'no_anggota' => $no_anggota,
    'alamat' => $alamat,
    'no_hp' => $no_hp,
    'jenis_kelamin' => $jenis_kelamin,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil ditambahkan'];
header('Location: list.php');
exit;
