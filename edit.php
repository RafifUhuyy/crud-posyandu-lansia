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

// Variabel untuk menyimpan pesan
$pesan = '';
$jenis_pesan = '';

// Ambil ID dari URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Cek apakah ID valid
if ($id == 0) {
    header("Location: index.php");
    exit();
}

// Query untuk mengambil data lansia berdasarkan ID
$query_select = "SELECT * FROM lansia WHERE id = $id";
$result = mysqli_query($koneksi, $query_select);

// Cek apakah data ditemukan
if (mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}

// Ambil data lansia
$data = mysqli_fetch_assoc($result);

// Cek apakah form sudah disubmit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ambil data dari form dan bersihkan dari karakter berbahaya
    $nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $usia = mysqli_real_escape_string($koneksi, $_POST['usia']);
    $berat = mysqli_real_escape_string($koneksi, $_POST['berat']); 
    $tinggi = mysqli_real_escape_string($koneksi, $_POST['tinggi']); 
    
    // Validasi: cek apakah semua field sudah diisi
    if (empty($nama) || empty($alamat) || empty($usia) || empty($berat) || empty($tinggi)) {
        $pesan = 'Semua field harus diisi!';
        $jenis_pesan = 'error';
    } else {
        // Query untuk update data
        $query_update = "UPDATE lansia SET 
                        nama = '$nama', 
                        alamat = '$alamat', 
                        usia = '$usia',
                        berat_badan = '$berat',
                        tinggi_badan = '$tinggi'
                        WHERE id = $id";
        
        // Eksekusi query
        if (mysqli_query($koneksi, $query_update)) {
            // Jika berhasil, redirect ke halaman index
            header("Location: index.php?status=sukses&aksi=edit");
            exit();
        } else {
            $pesan = 'Gagal mengupdate data: ' . mysqli_error($koneksi);
            $jenis_pesan = 'error';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Lansia - Aplikasi CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Edit Data Lansia</h2>
        
        <!-- Tampilkan pesan jika ada -->
        <?php if (!empty($pesan)) { ?>
            <div class="pesan pesan-<?php echo $jenis_pesan; ?>">
                <?php echo $pesan; ?>
            </div>
        <?php } ?>
        
        <!-- Form Edit Data -->
        <form method="POST" action="">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" 
                    value="<?php echo htmlspecialchars($data['nama']); ?>" 
                    placeholder="Masukkan nama lansia" required>
            </div>
            
            <div class="form-group">
                <label for="alamat">Alamat</label>
                <input type="text" id="alamat" name="alamat" 
                    value="<?php echo htmlspecialchars($data['alamat']); ?>" 
                    placeholder="Masukkan alamat lengkap" required>
            </div>
            
            <div class="form-group">
                <label for="usia">Usia</label>
                <input type="number" id="usia" name="usia" 
                    value="<?php echo htmlspecialchars($data['usia']); ?>" 
                    placeholder="Masukkan usia" required>
            </div>
            
            <div class="form-group">
                <label for="berat">Berat Badan (kg)</label>
                <input type="number" step="0.01" id="berat" name="berat" 
                    value="<?php echo htmlspecialchars($data['berat_badan']); ?>" 
                    placeholder="Dalam satuan (kg)" required>
            </div>
            
            <div class="form-group">
                <label for="tinggi">Tinggi Badan (cm)</label>
                <input type="number" step="0.01" id="tinggi" name="tinggi" 
                    value="<?php echo htmlspecialchars($data['tinggi_badan']); ?>" 
                    placeholder="Dalam satuan (cm)" required>
            </div>
            
            <button type="submit" class="btn btn-simpan">Update Data</button>
            <a href="index.php" class="btn btn-kembali">← Kembali</a>
        </form>
    </div>
</body>
</html>
