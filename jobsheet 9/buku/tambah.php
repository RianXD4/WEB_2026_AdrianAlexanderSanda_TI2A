<?php
 $page_title = "Tambah Buku";
 include __DIR__ . '/../includes/header.php';

 $flash = $_SESSION['flash'] ?? null;
 unset($_SESSION['flash']);
?>

        <section>
            <h2>Tambah Buku</h2>
             <?php if ($flash) : ?>
                <p class="flash flash-<?php echo $flash['type'];?>"><?php echo $flash['pesan'];?><
                <?php endif; ?>
            <form id="form-tambah" action="proses_tambah.php" method="POST">
                <p>
                    <label for="judul">Judul</label><br>
                    <input type="text" id="judul" name="judul">
                </p>
                <p>
                    <label for="pengarang">Pengarang</label><br>
                    <input type="text" id="pengarang" name="pengarang" required>
                </p>
                <p>
                    <label for="tahun">Tahun</label><br>
                    <input type="number" id="tahun" name="tahun" required>
                </p>
                <p>
                    <label for="isbn">ISBN</label><br>
                    <input type="text" id="isbn" name="isbn" required>
                </p>
                <p>
                    <label for="stok">Stok</label><br>
                    <input type="text" id="stok" name="stok" required>
                </p>
                <p>
                    <label for="kategori">Kategori</label>
                    <select name="kategori" id="kategori">
                        <option value="fiksi">Fiksi</option>
                        <option value="non-fiksi">Non-Fiksi</option>
                        <option value="referensi">Referensi</option>
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