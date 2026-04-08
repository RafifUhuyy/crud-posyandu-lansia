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
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Lansia - Aplikasi CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Data Lansia</h2>
        
        <div class="aksi-tombol">
            <a href="tambah.php" class="btn btn-tambah">Tambah Data Lansia</a>
            <a href="logout.php" class="btn-logout" onclick="return confirm('Yakin ingin logout?')">Logout</a>
        </div>
        <!-- Tabel Data Lansia -->
        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th class="no-urut">No</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>Usia</th>
                        <th>Berat Badan (kg)</th>
                        <th>Tinggi Badan (cm)</th>
                        <th class="aksi">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Query untuk mengambil semua data lansia
                    $query = "SELECT * FROM lansia ORDER BY id DESC";
                    $result = mysqli_query($koneksi, $query);
                    
                    // Cek apakah ada data
                    if (mysqli_num_rows($result) > 0) {
                        $no = 1;
                        // Loop untuk menampilkan setiap baris data
                        while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                        <tr>
                            <tr>
                                <td class="no-urut"><?php echo $no++; ?></td>
                                <td><?php echo htmlspecialchars($data['nama']); ?></td>
                                <td><?php echo htmlspecialchars($data['alamat']); ?></td>
                                <td><?php echo htmlspecialchars($data['usia']); ?> thn</td>
                                <td><?php echo htmlspecialchars($data['berat_badan']); ?> kg</td>
                                <td><?php echo htmlspecialchars($data['tinggi_badan']); ?> cm</td>
                                <td class="aksi">
                                <!-- Tombol Edit -->
                                <a href="edit.php?id=<?php echo $data['id']; ?>" class="btn btn-edit">Edit</a>
                                <a href="hapus.php?id=<?php echo $data['id']; ?>" class="btn btn-hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data <?php echo htmlspecialchars($data['nama']); ?>?')">Hapus</a>
                            </td>
                        </tr>
                    <?php
                        }
                    } else {
                        // Jika tidak ada data
                    ?>
                        <tr>
                            <td colspan="7" class="tidak-ada-data">
                                Belum ada data lansia. Silakan tambah data terlebih dahulu.
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
