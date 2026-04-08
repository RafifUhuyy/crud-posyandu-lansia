<?php
// Konfigurasi Database Hosting InfinityFree
$host = "sql100.infinityfree.com";
$username = "if0_41573155";
$password = "Rafifuhuy150806"; 
$database = "if0_41573155_db_posyandu";

// Membuat koneksi ke database hosting
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi ke database hosting gagal: " . mysqli_connect_error());
}

// Set charset untuk mendukung karakter khusus
mysqli_set_charset($koneksi, "utf8");
?>