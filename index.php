<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginmymind.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY MIND</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- HEADER -->
<header>
    <div class="logo">MYMIND 💜</div>
    <div class="toogle">
        <nav>
            <a href="home.php">Beranda</a>
            <a href="kolekmymind.php">Koleksi</a>
            <a href="tentang.php">Tentang</a>
            <a href="logout.php" style="color:red;">Logout</a>
        </nav>
        <span style="font-size:0.88rem; color:#7C6FCD; font-weight:700;">
            👤 <?php echo $_SESSION['username']; ?>
        </span>
        <button id="darkModeToggle">🌙</button>
    </div>
</header>

<!-- HERO -->
<section class="hero">
    <div>
        <h1>
            Semua yang kamu pikirkan <br>
            <span class="highlight">punya tempat.</span>
        </h1>
        <p>Tulis bebas apa yang ada di pikiranmu.</p>
        <!-- Tombol sekarang link ke tulismymind.php -->
        <a href="http://localhost/mymind_db/mulaimenulis.php" class="btn btn-primary">Mulai Menulis ✏️</a>
        <a href="kolekmymind.php" class="btn btn-outline">Lihat Koleksi 📚</a>
    </div>
    <img src="foto.jpeg" alt="ilustrasi">
</section>

<!-- MENU KATEGORI -->
<section class="menu">
    <div class="card">📔 Diary</div>
    <div class="card">🪶 Puisi</div>
    <div class="card">📖 Cerpen</div>
    <div class="card">🎵 Lirik</div>
    <div class="card">🍜 Resep</div>
    <div class="card">☁️ Random</div>
</section>

<!-- FOOTER -->
<footer>
    © 2026 MY MIND - Tempat Mengekspresikan Diri
</footer>

<script src="script.js"></script>
</body>
</html>