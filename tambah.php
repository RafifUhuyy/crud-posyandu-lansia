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

/**
 * Fungsi untuk menambah data lansia
 * @param mysqli $koneksi Koneksi database
 * @param array $data Data dari $_POST
 * @return bool|string Mengembalikan true jika sukses, atau pesan error jika gagal
 */
function tambahDataLansia($koneksi, $data) {
    // Ambil dan bersihkan data
    $nama   = mysqli_real_escape_string($koneksi, $data['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $data['alamat']);
    $usia   = mysqli_real_escape_string($koneksi, $data['usia']);
    $berat  = mysqli_real_escape_string($koneksi, $data['berat']);
    $tinggi = mysqli_real_escape_string($koneksi, $data['tinggi']);

    // Validasi kosong
    if (empty($nama) || empty($alamat) || empty($usia) || empty($berat) || empty($tinggi)) {
        return "Semua field harus diisi!";
    }

    // Query INSERT
    $query = "INSERT INTO lansia (nama, alamat, usia, berat_badan, tinggi_badan) 
            VALUES ('$nama', '$alamat', '$usia', '$berat', '$tinggi')";

    if (mysqli_query($koneksi, $query)) {
        return true;
    } else {
        return "Gagal menambah data: " . mysqli_error($koneksi);
    }
}

// --- LOGIKA PEMPROSESAN FORM ---

$pesan = '';
$jenis_pesan = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Panggil fungsi yang kita buat tadi
    $hasil = tambahDataLansia($koneksi, $_POST);

    if ($hasil === true) {
        // Jika sukses, redirect
        header("Location: index.php?status=sukses&aksi=tambah");
        exit();
    } else {
        // Jika gagal (string pesan error), simpan ke variabel pesan
        $pesan = $hasil;
        $jenis_pesan = 'error';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Lansia - Aplikasi CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Tambah Data Lansia</h2>
        
        <!-- Tampilkan pesan jika ada -->
        <?php if (!empty($pesan)) { ?>
            <div class="pesan pesan-<?php echo $jenis_pesan; ?>">
                <?php echo $pesan; ?>
            </div>
        <?php } ?>
        
        <!-- Form Tambah Data -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama lansia" required>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat lengkap" required>
            </div>
            
            <div class="form-group">
    			<label for="usia">Usia (Tahun):</label>
    			<input type="number" name="usia" id="usia" placeholder="Masukkan usia" required>
			</div>

			<div class="form-group">
    			<label for="berat">Berat Badan (kg):</label>
    			<input type="number" step="0.01" name="berat" id="berat" placeholder="Contoh: 60.5" required>
			</div>

			<div class="form-group">
    			<label for="tinggi">Tinggi Badan (cm):</label>
    			<input type="number" step="0.01" name="tinggi" id="tinggi" placeholder="Contoh: 160" required>
			</div>
            
            <button type="submit" class="btn btn-simpan">Simpan Data</button>
            <a href="index.php" class="btn btn-kembali">← Kembali</a>
        </form>
    </div>
</body>
</html>
