<?php
session_start();
include 'config.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $result = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($result) === 1) {
        $_SESSION['login'] = true;
        header("Location: index.php");
        exit;
    }
    $error = true;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Posyandu Lansia</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="login-page">
    <div style="text-align: center; margin-top: 50px; margin-bottom: 20px;">
        <h1 style="color: #333; font-weight: 600; margin-bottom: 5px;">POSYANDU LANSIA</h1>
        <p style="color: #666; font-size: 14px;">Sistem Informasi Kesehatan</p>
    </div>

    <div class="container" style="max-width: 450px; margin: 0 auto; padding: 40px;">
        <h2 align="center" style="margin-bottom: 30px; color: #444; border: none;">Login Admin</h2>
        
        <?php if(isset($error)) : ?>
            <p style="color:red; font-style:italic; text-align:center; margin-bottom: 15px;">Username / Password Salah!</p>
        <?php endif; ?>

        <form action="" method="post">
            <div class="form-group" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Username:</label>
                <input type="text" name="username" id="username" placeholder="Masukkan username" required 
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
            </div>
            
            <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; margin-bottom: 8px; font-weight: 600;">Password:</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password" required
                    style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 8px;">
            </div>
            
            <button type="submit" name="login" class="btn btn-tambah" 
                    style="width: 100%; padding: 12px; font-size: 16px; border: none; cursor: pointer;">
                Login ke Sistem
            </button>
        </form>
    </div>
</body>
</html>