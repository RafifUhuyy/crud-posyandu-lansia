-- =====================================================
-- QUERY SQL UNTUK MEMBUAT DATABASE DAN TABEL
-- =====================================================

-- 1. Buat database (jalankan ini terlebih dahulu)
CREATE DATABASE IF NOT EXISTS db_sekolah;

-- 2. Pilih database yang akan digunakan
USE db_sekolah;

-- 3. Buat tabel siswa
CREATE TABLE IF NOT EXISTS siswa (
    id INT(11) NOT NULL AUTO_INCREMENT,
    nama VARCHAR(100) NOT NULL,
    kelas VARCHAR(50) NOT NULL,
    alamat TEXT NOT NULL,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- =====================================================
-- CARA MENJALANKAN QUERY INI:
-- =====================================================
-- 
-- Opsi 1: Menggunakan phpMyAdmin
-- 1. Buka phpMyAdmin di browser (http://localhost/phpmyadmin)
-- 2. Klik tab "SQL"
-- 3. Copy dan paste semua query di atas
-- 4. Klik tombol "Go" atau "Kirim"
--
-- Opsi 2: Menggunakan Command Line MySQL
-- 1. Buka terminal/command prompt
-- 2. Ketik: mysql -u root -p
-- 3. Masukkan password (jika ada)
-- 4. Copy dan paste query di atas
--
-- =====================================================

-- =====================================================
-- QUERY TAMBAHAN (Opsional)
-- =====================================================

-- Melihat struktur tabel
-- DESCRIBE siswa;

-- Melihat semua data
-- SELECT * FROM siswa;

-- Menambah data contoh
-- INSERT INTO siswa (nama, kelas, alamat) VALUES 
-- ('Budi Santoso', 'X IPA 1', 'Jl. Mawar No. 1, Jakarta'),
-- ('Ani Wulandari', 'X IPA 2', 'Jl. Melati No. 5, Jakarta'),
-- ('Candra Dimas', 'XI IPS 1', 'Jl. Kenanga No. 10, Bandung');

-- Menghapus semua data (hati-hati!)
-- TRUNCATE TABLE siswa;

-- Menghapus tabel (hati-hati!)
-- DROP TABLE siswa;
