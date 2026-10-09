<?php
require __DIR__ . '/../includes/auth.php';
require __DIR__ . '/../includes/koneksi.php';

$id = $_POST['id'] ?? null;
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
    $cek = $pdo->prepare("SELECT COUNT(*) FROM anggota WHERE no_anggota = :no_anggota AND id <> :id");
    $cek->execute(['no_anggota' => $no_anggota, 'id' => $id]);
    if ($cek->fetchColumn() > 0) {
        $error[] = "No. Anggota \"$no_anggota\" sudah dipakai anggota lain";
    }
}

if (!empty($error)) {
    $_SESSION['flash'] = ['type' => 'error', 'pesan' => implode(' ', $error)];
    $tujuan = $id ? 'edit.php?id=' . urlencode($id) : 'list.php';
    header('Location: ' . $tujuan);
    exit;
}

if (!$id) {
    header('Location: list.php');
    exit;
}

$stmt = $pdo->prepare(
    "UPDATE anggota
     SET nama = :nama, no_anggota = :no_anggota, alamat = :alamat, no_hp = :no_hp, jenis_kelamin = :jenis_kelamin
     WHERE id = :id"
);

$stmt->execute([
    'nama' => $nama,
    'no_anggota' => $no_anggota,
    'alamat' => $alamat,
    'no_hp' => $no_hp,
    'jenis_kelamin' => $jenis_kelamin,
    'id' => $id,
]);

$_SESSION['flash'] = ['type' => 'success', 'pesan' => 'Anggota berhasil diedit'];
header('Location: list.php');
exit;
