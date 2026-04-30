<?php
session_start();
include "koneksi.php";

$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $konfirmasi = $_POST['konfirmasi'];

    // Validasi if-else
    if (empty($username) || empty($email) || empty($password)) {
        $error = "Semua kolom wajib diisi!";
    } elseif ($password !== $konfirmasi) {
        $error = "Password tidak cocok!";
    } elseif (strlen($password) < 6) {
        $error = "Password minimal 6 karakter!";
    } else {
        // Cek apakah username/email sudah ada
        $cek = mysqli_query($conn, "SELECT id FROM users WHERE username='$username' OR email='$email'");
        
        if (mysqli_num_rows($cek) > 0) {
            $error = "Username atau email sudah digunakan!";
        } else {
            // Operator aritmatika: hitung panjang password
            $panjang_password = strlen($password);
            
            // Hash password
            $hashed = MD5($password);
            
            // INSERT user baru
            $sql = "INSERT INTO users (username, email, password) 
                    VALUES ('$username', '$email', '$hashed')";
            
            if (mysqli_query($conn, $sql)) {
                $success = "Akun berhasil dibuat! Silakan login.";
            } else {
                $error = "Gagal membuat akun: " . mysqli_error($conn);
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - MyMind</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .register-wrap {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #f3f0ff, #fdeef5);
        }
        .register-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 8px 32px rgba(112,111,211,0.15);
        }
        .register-card h2 {
            font-size: 1.8rem;
            color: #2D3436;
            margin-bottom: 6px;
        }
        .register-card p {
            color: #999;
            font-size: 0.88rem;
            margin-bottom: 24px;
        }
        .alert-error {
            background: #FDEEF0;
            color: #C0392B;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 16px;
        }
        .alert-success {
            background: #EAF8F0;
            color: #1B6B3A;
            padding: 10px 14px;
            border-radius: 8px;
            font-size: 0.85rem;
            margin-bottom: 16px;
        }
        .login-link {
            text-align: center;
            margin-top: 16px;
            font-size: 0.88rem;
            color: #999;
        }
        .login-link a {
            color: #706FD3;
            font-weight: 700;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="register-wrap">
    <div class="register-card">
        <h2>Buat Akun 📝</h2>
        <p>Bergabung dan mulai tuangkan pikiranmu!</p>

        <?php if ($error): ?>
            <div class="alert-error">⚠ <?= $error ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert-success">✓ <?= $success ?> 
                <a href="loginmymind.php">Login sekarang →</a>
            </div>
        <?php endif; ?>

        <form method="POST" action="register.php">
            <label>Username</label>
            <input type="text" name="username" placeholder="Masukkan username">

            <label>Email</label>
            <input type="email" name="email" placeholder="Masukkan email">

            <label>Password</label>
            <input type="password" name="password" placeholder="Minimal 6 karakter">

            <label>Konfirmasi Password</label>
            <input type="password" name="konfirmasi" placeholder="Ulangi password">

            <br><br>
            <button type="submit" class="btn btn-primary" style="width:100%;">
                Daftar Sekarang
            </button>
        </form>

        <div class="login-link">
            Sudah punya akun? <a href="loginmymind.php">Login di sini</a>
        </div>
    </div>
</div>

<script>
// Validasi JavaScript: cek password match secara realtime
document.querySelector('input[name="konfirmasi"]').addEventListener('input', function() {
    const password = document.querySelector('input[name="password"]').value;
    if (this.value !== password) {
        this.style.borderColor = 'red';
    } else {
        this.style.borderColor = '#706FD3';
    }
});
</script>

</body>
</html>