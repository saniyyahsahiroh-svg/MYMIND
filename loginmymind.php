<?php
session_start();
include "koneksi.php";

$pesan = ""; // tambahkan ini

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];
    $query = "SELECT * FROM users WHERE email='$email'";
    $hasil = mysqli_query($conn, $query);
    if (mysqli_num_rows($hasil) > 0) {
        $data = mysqli_fetch_assoc($hasil);
        if (MD5($password) == $data["password"]) {
            $_SESSION['user_id'] = $data['id'];
            $_SESSION['username'] = $data['username'];
            header("Location: index.php");
            exit;
        } else {
            echo "Password salah";
        }
    } else {
        echo "Email tidak ditemukan";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Mind</title>
    <link rel="icon" type="image/png" href="icon.png">
    <style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: linear-gradient(135deg, #e9e4ff, #f6f3ff);
    margin: 0;
    padding: 0;
}

.wrapper {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    gap: 3px; 
}

.illustration img {
    width: 650px;
}

.container {
    width: 400px;
    background: #ffffff;
    padding: 35px;
    border-radius: 20px;
    box-shadow: 0 10px 30px rgba(120, 100, 200, 0.15);

}

h2 {
    margin-bottom: 25px;
    color: #5b4db1;
    font-weight: 600;
}

label {
    display: block;
    margin-top: 15px;
    margin-bottom: 6px;
    font-weight: 500;
    color: #6b6b8d;
    text-align: left;
}

input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 12px;
    box-sizing: border-box;
    background: #f9f8ff;
    transition: 0.3s;
}

input:focus {
    border-color: #a29bfe;
    outline: none;
    background: #fff;
}

button {
    width: 100%;
    margin-top: 20px;
    padding: 12px;
    background: linear-gradient(135deg, #7f7fd5, #a29bfe);
    color: white;
    border: none;
    border-radius: 12px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    opacity: 0.9;
    transform: translateY(-1px);
}

.success {
    margin-top: 20px;
    padding: 12px;
    background-color: #f0ecff;
    color: #5b4db1;
    border-left: 5px solid #a29bfe;
    border-radius: 10px;
}

.error {
    margin-top: 20px;
    padding: 12px;
    background-color: #ffecec;
    color: #d63031;
    border-left: 5px solid #ff7675;
    border-radius: 10px;
}

.info {
    margin-top: 20px;
    font-size: 13px;
    color: #777;
    background-color: #f8f7ff;
    padding: 10px;
    border-radius: 10px;
}
    </style>
</head>
<body>
<div class="wrapper">

    <div class="container">
    <h2>WELCOME TO MY MIND</h2>

<form method="POST" action="">
        <label>Email</label>
        <input type="email" name="email" placeholder="Masukkan email" required>
        <label>Password</label>
        <input type="password" name="password" placeholder="Masukkan password" required>
        <button type="submit" name="login">Login</button>
    </form>

    <!-- TAMBAHKAN DI SINI -->
    <p style="text-align:center; margin-top:16px; font-size:0.88rem; color:#999;">
        Belum punya akun? 
        <a href="register.php" style="color:#706FD3; font-weight:700;">Daftar di sini</a>
    </p>

    </div> <!-- tutup container -->

    <?php echo $pesan; ?>

    </div>

    <div class="illustration">
    <img src="gambar.png">
    </div>

</div>
</body>
</html>