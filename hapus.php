<?php 
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}
?>
<?php
// Sertakan file koneksi database
include 'config.php';

// Ambil ID dari URL dan pastikan berupa integer
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Cek apakah ID valid
if ($id > 0) {
    // Query untuk menghapus data
    $query = "DELETE FROM lansia WHERE id = $id";
    
    // Eksekusi query
    if (mysqli_query($koneksi, $query)) {
        // Jika berhasil, redirect ke halaman index dengan pesan sukses
        header("Location: index.php?status=sukses&aksi=hapus");
        exit();
    } else {
        // Jika gagal, redirect dengan pesan error
        header("Location: index.php?status=gagal&aksi=hapus");
        exit();
    }
} else {
    // Jika ID tidak valid, kembali ke index
    header("Location: index.php");
    exit();
}
?>
