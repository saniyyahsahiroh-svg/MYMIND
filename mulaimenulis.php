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
    <title>Tulis - MyMind</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<!-- HEADER -->
<header>
    <div class="logo">MYMIND 💜</div>
    <div class="toogle">
        <nav>
            <a href="index.php">Beranda</a>
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

<!-- FORM TULIS -->
<section class="form-container">
    <h2>✏️ Tulis Baru</h2>
    <form method="POST" action="proses_simpan.php">
        <label>Judul</label>
        <input type="text" name="title" placeholder="Masukkan judul tulisanmu">

        <div class="form-row">
            <div>
                <label>Kategori</label>
                <select name="category">
                    <option value="">-- Pilih Kategori --</option>
                    <option>Diary</option>
                    <option>Puisi</option>
                    <option>Cerpen</option>
                    <option>Lirik Lagu</option>
                    <option>Resep</option>
                    <option>Random</option>
                </select>
            </div>
            <div>
                <label>Mood</label>
                <select name="mood">
                    <option value="">-- Pilih Mood --</option>
                    <option>Bahagia</option>
                    <option>Sedih</option>
                    <option>Marah</option>
                    <option>Senang</option>
                    <option>Cemas</option>
                    <option>Netral</option>
                </select>
            </div>
        </div>

        <label>Tulisanmu</label>
        <textarea name="content" placeholder="Tulis apa yang ada di pikiranmu..."></textarea>
        <br><br>
        <button type="submit" class="btn btn-primary">💾 Simpan</button>
        <button type="reset" class="btn btn-outline">🔄 Reset</button>
    </form>
</section>

<!-- FOOTER -->
<footer>
    © 2026 MY MIND - Tempat Mengekspresikan Diri
</footer>

<script src="script.js"></script>
</body>
</html>