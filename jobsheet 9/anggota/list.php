<?php
 $page_title = "Daftar Buku";
 include __DIR__ . '/../includes/header.php';

 $flash = $_SESSION['flash'] ?? null;
 unset($_SESSION['flash']);
 $daftarBuku = $_SESSION['buku'] ?? [];
?>
        <section>
            <h2>Daftar Anggota</h2>
            <div class="search-box">
                <label for="search-box">Cari Judul Buku</label>
                <input type="text" id="search-input" placeholder="Ketik judul buku.....">
            </div>
            <p id="loading-indicator" style="display: none;">Memuat data...</p>
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
                </tbody>
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