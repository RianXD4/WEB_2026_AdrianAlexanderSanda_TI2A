<?php
 $page_title = "Daftar Buku";
 require __DIR__ .'/../includes/koneksi.php';
 include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
$perPage = 5;
$page = max(1, (int) ($_GET['page'] ?? 1));
$offset = ($page - 1) * $perPage;
$keyword = trim($_GET['q']?? '');

if ($keyword !== '') {
    $hitung = $pdo->prepare("SELECT COUNT(*) FROM buku WHERE judul ILIKE :kw");
    $hitung->execute(['kw'=>'%' . $keyword . '%']);
    $totalRows = $hitung->fetchColumn();

    $stmt = $pdo->prepare("SELECT * FROM buku WHERE judul ILIKE :kw ORDER BY id DESC LIMIT :limit OFFSET :offset");
    $stmt->bindValue('kw', '%' . $keyword . '%');
    } else {
        $totalRows = $pdo->query("SELECT COUNT(*) FROM buku")->fetchColumn();
        $stmt = $pdo->prepare("SELECT * FROM buku ORDER BY id DESC LIMIT :limit OFFSET :offset");
    }
    $stmt->bindValue('limit', $perPage, PDO::PARAM_INT);
    $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
    $stmt->execute();

    $daftarBuku = $stmt->fetchALL(PDO::FETCH_ASSOC);
    $totalPages = max(1, (int) ceil($totalRows / $perPage));

?>

        <section>
            <h2>Daftar Buku</h2>
            <?php if ($flash) : ?>
                <p class="flash flash-<?php echo $flash['type'];?>"><?php echo $flash['pesan'];?><
                <?php endif; ?>

            <div class="search-box">
                <form method="get" action="list.php">
                <span>
                <label for="search-input">Cari Judul Buku</label>
                <input type="text" id="search-input" name='q' value="<?php echo $keyword;?>" placeholder="Ketik judul buku.....">
                </span>
                <button type="submit"> Cari</button>
                </form>
            </div>

            <div class="table-responsive">
            <table border="1">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Tahun</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($daftarBuku)) : ?>
                    <tr>
                        <td colspan="5">Belum ada data buku. Silakan tambah lewat menu "Tambah Buku"</td>
                    </tr>
                    <?php else : ?>
                        <?php foreach ($daftarBuku as $buku) : ?>
                            <tr>
                                <td><?php echo $buku['judul'];?></td>
                                <td><?php echo $buku['pengarang'];?></td>
                                <td><?php echo $buku['tahun'];?></td>
                                <td><?php echo $buku['stok'];?></td>
                                <td>
                                     <a href="edit.php?id=<?php echo $buku['id'];?>" class="btn-edit">Edit</a>
                                     <form class="form-hapus" method="post" action="hapus.php">
                                        <input type="hidden" name="id" value="<?php echo $buku['id'];?>">
                                        <button type="submit" class="btn-hapus">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
                <tfoot>
                    <nav class="pagination">
                        <?php for ($i=1; $i <= $totalPages ; $i++): ?>
                            <a href="list.php?page=<?php echo $i; ?><?php echo $keyword !== '' ? '&q=' . urlencode($keyword) : ''; ?>" class="<?php echo $i === $page ? 'active' : ''; ?>"><?php echo $i; ?></a>
                            <?php endfor;?>
                    </nav>
                </tfoot>
            </table>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1975.7517989190167!2d112.6151043176651!3d-7.946796184496806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883ad34d8bb43%3A0xf384c4a3b2c47cd7!2sGerbang%20utara%20POLINEMA!5e0!3m2!1sid!2sid!4v1788404327102!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
        </section>
        <?php include __DIR__ .'/../includes/footer.php';?>
    