<?php
require __DIR__ . '/../includes/auth.php';
$page_title = "Tambah Anggota";
include __DIR__ . '/../includes/header.php';

$flash = $_SESSION['flash'] ?? null;
unset($_SESSION['flash']);
?>
        <section>
            <h2>Tambah Anggota</h2>
            <?php if ($flash) : ?>
                <p class="flash flash-<?php echo $flash['type']; ?>"><?php echo $flash['pesan']; ?></p>
            <?php endif; ?>
            <form id="form-tambah" action="proses_tambah.php" method="POST">
                <p>
                    <label for="nama">Nama</label><br>
                    <input type="text" id="nama" name="nama" required>
                </p>
                <p>
                    <label for="no_anggota">No. Anggota</label><br>
                    <input type="text" id="no_anggota" name="no_anggota" required>
                </p>
                <p>
                    <label for="alamat">Alamat</label><br>
                    <input type="text" id="alamat" name="alamat" required>
                </p>
                <p>
                    <label for="no_hp">No. HP</label><br>
                    <input type="text" id="no_hp" name="no_hp" required>
                </p>
                <p>
                    <label for="jenis_kelamin">Jenis Kelamin</label><br>
                    <select name="jenis_kelamin" id="jenis_kelamin" required>
                        <option value="">-- Pilih --</option>
                        <option value="Perempuan">Perempuan</option>
                        <option value="Laki-Laki">Laki-Laki</option>
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
