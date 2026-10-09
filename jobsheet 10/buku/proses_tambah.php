<?php
require __DIR__ . '/../includes/auth.php';

require __DIR__ ."/../includes/koneksi.php";

$judul = trim($_POST['judul']??'');
$pengarang = trim($_POST['pengarang']??'');
$tahun = ($_POST['tahun']??'');
$isbn = trim($_POST['isbn']??'');
$stock = ($_POST['stok']??'');
$kategori = trim($_POST['kategori']??'');

$error = [];
if($judul === ' ') {
    $error[] = "judul wajib diisi";
}
if($pengarang === ' ') {
    $error[] = "Pengarang wajib diisi";
}
if(!is_numeric($tahun) || $tahun < 1900 || $tahun > 2026) {
    $error[] = "Tahun harus diantara 1900 - 2026";
}
if(!is_numeric($stock) || $stock < 0) {
    $error[] = "Stock tidak boleh neagtif";
}
if(!empty($error)) {
    $_SESSION["flash"] = ['type' => 'error','pesan' => implode(' ',$error)];
    header('Location: tambah.php');
    exit;
}



$stmt = $pdo->prepare(
    "INSERT INTO buku (judul, pengarang, tahun, isbn, stok, kategori)
    VALUES (:judul, :pengarang, :tahun, :isbn, :stok, :kategori)
    RETURNING id"
);

$stmt->execute([
    'judul' => $judul,
    'pengarang' => $pengarang,
    'tahun' => (int)$tahun,
    'isbn' => $isbn,
    'stok' => (int)$stock,
    'kategori' => $kategori,
    ]);

$_SESSION['flash'] = ['type'=> 'success', 'pesan' => 'Buku berhasil ditambahkan'];
header('Location: list.php');
exit;
?>
