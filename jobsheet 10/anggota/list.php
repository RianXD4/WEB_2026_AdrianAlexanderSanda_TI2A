<?php
require __DIR__ . '/../includes/auth.php';
$page_title = "Daftar Anggota";
require __DIR__ . '/../includes/koneksi.php';
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q'] ?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM anggota WHERE nama ILIKE :kw");
    $hitung->execute(['kw' => '%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM anggota WHERE nama ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
} else {
    $totalRows = $pdo->query("SELECT COUNT(*) FROM anggota")->fetchColumn();
    $stmt = $pdo->prepare("SELECT * FROM anggota ORDER BY id DESC LIMIT :limit OFFSET :offset");
}
$stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
$stmt->bindValue('offset', $offset, PDO::PARAM_INT);
$stmt->execute();

$daftarAnggota = $stmt->fetchAll(PDO::FETCH_ASSOC);
$totalPages = max(1, (int) ceil($totalRows / $perPage));
?>
        <section>
            <h2>Daftar Anggota</h2>
            <?php if ($flash) : ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>

            <div class="search-box">
                <form method="get" action="list.php">
                    <span>
                        <label for="search-input">Cari Nama Anggota</label>
                        <input type="text" id="search-input" name="q" value="<?php echo htmlspecialchars($keyword); ?>" placeholder="Ketik nama anggota.....">
                    </span>
                    <button type="submit">Cari</button>
                </form>
            </div>

            <div class="table-responsive">
            <table border="1">
                <thead>
                    <tr>
                        <th rowspan="2">No. Anggota</th>
                        <th rowspan="2">Nama</th>
                        <th rowspan="2">Alamat</th>
                        <th rowspan="2">No. HP</th>
                        <th colspan="2">Jenis Kelamin</th>
                        <th colspan="2">Aksi</th>
                    </tr>
                    <tr>
                        <th>Perempuan</th>
                        <th>Laki-Laki</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarAnggota)) : ?>
                    <tr>
                        <td colspan="7">Belum ada data anggota. Silakan tambah lewat menu "Tambah Anggota"</td>
                    </tr>
                    <?php else : ?>
                        <?php foreach ($daftarAnggota as $anggota) : ?>
                            <tr>
                                <td><?php echo $anggota['no_anggota']; ?></td>
                                <td><?php echo $anggota['nama']; ?></td>
                                <td><?php echo $anggota['alamat']; ?></td>
                                <td><?php echo $anggota['no_hp']; ?></td>
                                <td><?php echo $anggota['jenis_kelamin'] === 'Perempuan' ? '&#10003;' : ''; ?></td>
                                <td><?php echo $anggota['jenis_kelamin'] === 'Laki-Laki' ? '&#10003;' : ''; ?></td>
                                <td>
                                    <a href="edit.php?id=<?php echo $anggota['id']; ?>" class="btn-edit">Edit</a>
                                </td>
                                <td>
                                    <form class="form-hapus" method="post" action="hapus.php">
                                        <input type="hidden" name="id" value="<?php echo $anggota['id']; ?>">
                                        <button type="submit" class="btn-hapus">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="7">
                            <nav class="pagination">
                                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                                    <a href="list.php?page=<?php echo $i; ?><?php echo $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>" class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                                <?php endfor; ?>
                            </nav>
                        </td>
                    </tr>
                </tfoot>
            </table>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2026 SIMPUS-mini &mdash; Jobsheet 1</p>
    </footer>
    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/anggota.js"></script>
</body>
</html>
