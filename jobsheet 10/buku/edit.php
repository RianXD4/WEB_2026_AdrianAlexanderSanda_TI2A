<?php
require __DIR__ . '/../includes/auth.php';
$page_title = "Edit Buku";
include __DIR__  . '/../includes/header.php';
require __DIR__  . '/../includes/koneksi.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);

$id = $_GET['id'] ?? null;
if (!$id) {
    header('location: list.php');
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM buku WHERE id = :id");
$stmt->execute(['id'=>$id]);
$buku = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$buku) {
    header('location: list.php');
    exit;
};
?>
    <section>
        <h2>Edit Buku</h2>
        <?php if ($flash) : ?>
            <p class="flash flash-<?php echo $flash['type'];?>"><?php echo $flash['pesan'];?><
            <?php endif; ?>
        <form id="form-tambah" method="post" action="proses_edit.php">
            <input type="text" name="id" value="<?php echo $buku['id'];?>">
            <p>
                <label for="judul">Judul</label><br>
                <input type="text" id="judul" name="judul" value="<?php echo $buku['judul'];?>" required>
            </p>
            <p>
                <label for="pengarang">Pengarang</label><br>
                <input type="text" id="pengarang" name="pengarang" value="<?php echo $buku['pengarang'];?>" required>
            </p>
            <p>
                <label for="tahun">Tahun</label><br>
                <input type="number" id="tahun" name="tahun" value="<?php echo $buku['tahun'];?>" required>
            </p>
            <p>
                <label for="isbn">ISBN</label><br>
                <input type="text" id="isbn" name="isbn" value="<?php echo $buku['isbn'];?>" required>
            </p>
            <p>
                <label for="stok">Stok</label><br>
                <input type="text" id="stok" name="stok" value="<?php echo $buku['stok'];?>" required>
            </p>
            <p>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori">
                    <?php foreach (['fiksi' => 'Fiksi', 'non-fiksi' => 'Non-Fiksi', 'refrensi'=>'Referensi'] as $key => $value): ?>
                    <option value="<?php echo $value; ?>" <?php echo $buku['kategori'] === $value ? 'selected' : ''; ?>><?php echo $value; ?></option>
                    <?php endforeach; ?>
                </select>
                </p>
                <p>
                    <button type="submit">Simpan</button>
                </p>
        </form>
    </section>
    </main>
    <footer>
        <p>&copy; 2026 SIMPUS-mini &mdash; Jobsheet 1</p>
    </footer>
   <script src="../assets/js/app.js"></script>
</body>
</html>