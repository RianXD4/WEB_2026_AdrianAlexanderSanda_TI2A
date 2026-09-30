<?php
 $page_title = "Daftar Buku";
 include __DIR__ .'/../includes/koneksi.php';
 include __DIR__ . '/../includes/header.php';

 $daftarBuku = $pdo->query("SELECT * FROM buku ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
 $flash = $_SESSION['flash'] ?? null;
 unset($_SESSION['flash']);
?>

        <section>
            <h2>Daftar Buku</h2>
            <?php if ($flash) : ?>
                <p class="flash flash-<?php echo $flash['type'];?>"><?php echo $flash['pesan'];?><
                <?php endif; ?>

            <div class="search-box">
                <label for="search-box">Cari Judul Buku</label>
                <input type="text" id="search-input" placeholder="Ketik judul buku.....">
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
                                    <button type="button">Edit</button>
                                    <button type="button" class="btn-hapus">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1975.7517989190167!2d112.6151043176651!3d-7.946796184496806!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7883ad34d8bb43%3A0xf384c4a3b2c47cd7!2sGerbang%20utara%20POLINEMA!5e0!3m2!1sid!2sid!4v1788404327102!5m2!1sid!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="strict-origin-when-cross-origin"></iframe>
        </section>
        <?php include __DIR__ .'/../includes/footer.php';?>
    