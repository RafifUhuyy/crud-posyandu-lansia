# 📚 Aplikasi CRUD Data Siswa (PHP Native)

Aplikasi web sederhana untuk mengelola data siswa menggunakan PHP native, MySQL, HTML, dan CSS.

---

## 📁 Struktur Folder

```
crud_siswa/
├── config.php      → Koneksi ke database MySQL
├── index.php       → Halaman utama (tampil data)
├── tambah.php      → Halaman tambah data
├── edit.php        → Halaman edit data
├── hapus.php       → Proses hapus data
├── style.css       → File CSS untuk styling
├── database.sql    → Query SQL untuk membuat database
└── README.md       → Dokumentasi ini
```

---

## ⚙️ Persyaratan

- **Web Server**: XAMPP, WAMP, MAMP, atau Laragon
- **PHP**: Versi 7.0 atau lebih baru
- **MySQL**: Versi 5.6 atau lebih baru
- **Browser**: Chrome, Firefox, Safari, Edge

---

## 🚀 Cara Instalasi

### 1. Letakkan File Project

Copy folder `crud_siswa` ke direktori web server:
- **XAMPP**: `C:\xampp\htdocs\crud_siswa`
- **WAMP**: `C:\wamp\www\crud_siswa`
- **MAMP**: `/Applications/MAMP/htdocs/crud_siswa`
- **Laragon**: `C:\laragon\www\crud_siswa`

### 2. Buat Database

**Opsi A: Menggunakan phpMyAdmin**
1. Buka browser, akses: `http://localhost/phpmyadmin`
2. Klik tab **SQL**
3. Copy dan paste isi file `database.sql`
4. Klik tombol **Go** atau **Kirim**

**Opsi B: Menggunakan Command Line**
```bash
mysql -u root -p < database.sql
```

### 3. Konfigurasi Koneksi Database

Buka file `config.php` dan sesuaikan jika diperlukan:

```php
$host = "localhost";      // Server database
$username = "root";       // Username MySQL
$password = "";           // Password MySQL (kosong untuk XAMPP default)
$database = "db_sekolah"; // Nama database
```

### 4. Akses Aplikasi

Buka browser dan akses:
```
http://localhost/crud_siswa/
```

---

## 📖 Fitur Aplikasi

| Fitur | Deskripsi |
|-------|-----------|
| ✅ **Create** | Tambah data siswa baru |
| ✅ **Read** | Tampilkan semua data siswa dalam tabel |
| ✅ **Update** | Edit data siswa yang sudah ada |
| ✅ **Delete** | Hapus data siswa dengan konfirmasi |

---

## 🎨 Tampilan Aplikasi

### Halaman Utama (index.php)
- Menampilkan tabel data siswa
- Tombol "Tambah Data Siswa"
- Tombol Edit dan Hapus di setiap baris

### Halaman Tambah (tambah.php)
- Form input: Nama, Kelas, Alamat
- Tombol Simpan dan Kembali

### Halaman Edit (edit.php)
- Form terisi otomatis dengan data sebelumnya
- Bisa update data

---

## 🔒 Keamanan

Aplikasi ini sudah menerapkan beberapa praktik keamanan dasar:

1. **`mysqli_real_escape_string()`** - Mencegah SQL Injection
2. **`htmlspecialchars()`** - Mencegah XSS (Cross-Site Scripting)
3. **`intval()`** - Memastikan ID berupa angka
4. **Konfirmasi sebelum hapus** - Mencegah penghapusan tidak sengaja

---

## 📝 Penjelasan Kode

### config.php
```php
// Membuat koneksi ke database
$koneksi = mysqli_connect($host, $username, $password, $database);

// Cek koneksi
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}
```

### Query Dasar MySQLi

**Menampilkan Data:**
```php
$query = "SELECT * FROM siswa";
$result = mysqli_query($koneksi, $query);
while ($data = mysqli_fetch_assoc($result)) {
    echo $data['nama'];
}
```

**Menambah Data:**
```php
$query = "INSERT INTO siswa (nama, kelas, alamat) VALUES ('$nama', '$kelas', '$alamat')";
mysqli_query($koneksi, $query);
```

**Update Data:**
```php
$query = "UPDATE siswa SET nama='$nama', kelas='$kelas', alamat='$alamat' WHERE id=$id";
mysqli_query($koneksi, $query);
```

**Hapus Data:**
```php
$query = "DELETE FROM siswa WHERE id=$id";
mysqli_query($koneksi, $query);
```

---

## 🐛 Troubleshooting

### Error: "Koneksi database gagal"
- Pastikan MySQL sudah running di XAMPP/WAMP
- Cek username dan password di `config.php`
- Pastikan database `db_sekolah` sudah dibuat

### Error: "Table 'db_sekolah.siswa' doesn't exist"
- Jalankan query SQL di `database.sql`
- Pastikan sudah memilih database dengan `USE db_sekolah`

### Halaman putih (blank)
- Aktifkan error reporting dengan menambahkan di awal file:
```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

---

## 📚 Belajar Lebih Lanjut

Untuk mempelajari lebih lanjut tentang PHP dan MySQL:
- [PHP Manual](https://www.php.net/manual/)
- [W3Schools PHP](https://www.w3schools.com/php/)
- [MySQL Documentation](https://dev.mysql.com/doc/)

---

## 👨‍💻 Author

Dibuat untuk pembelajaran dasar PHP CRUD.

Selamat belajar! 🎉
