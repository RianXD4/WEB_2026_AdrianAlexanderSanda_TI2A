CREATE TABLE IF NOT EXISTS buku (
    id SERIAL PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    pengarang VARCHAR(255) NOT NULL,
    tahun INTEGER NOT NULL,
    isbn VARCHAR(50),
    stok INTEGER NOT NULL DEFAULT 0,
    kategori VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS anggota (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    no_anggota VARCHAR(50) NOT NULL UNIQUE,
    alamat VARCHAR(255),
    no_hp VARCHAR(30),
    jenis_kelamin VARCHAR(20)
);

-- Untuk database yang sudah terlanjur dibuat sebelum penambahan kolom ini.
ALTER TABLE anggota ADD COLUMN IF NOT EXISTS jenis_kelamin VARCHAR(20);

CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    nama VARCHAR(255) NOT NULL,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL DEFAULT 'petugas'
);

-- Akun admin awal (username: admin, password: admin123).
-- Ganti/hapus password untuk pemakaian nyata.
INSERT INTO users (nama, username, password, role)
VALUES ('Administrator', 'admin', '$2y$10$1VP8Mq9teTLo4e54KqVA9eHjXZLe95gfLjO704E8dLc2133GmOZQe', 'admin')
ON CONFLICT (username) DO NOTHING;