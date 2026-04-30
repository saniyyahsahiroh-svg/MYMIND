<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang - MyMind</title>
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

<!-- TENTANG HERO -->
<section class="tentang-hero">
    <h1>Tentang <span class="highlight">MyMind</span> 💜</h1>
    <p>Ruang aman untuk semua yang ada di pikiranmu.</p>
</section>

<!-- APA ITU MYMIND -->
<section class="tentang-section">
    <div class="tentang-card">
        <div class="tentang-icon">📖</div>
        <h2>Apa itu MyMind?</h2>
        <p>
            MyMind adalah aplikasi jurnal digital pribadi yang dirancang 
            untuk membantumu menuangkan pikiran, perasaan, dan kreativitas 
            secara bebas. Di sini, tidak ada yang menghakimi — hanya kamu 
            dan pikiranmu.
        </p>
        <p>
            Simpan diary harian, tulis puisi, buat cerpen, catat lirik lagu 
            favoritmu, atau sekedar tulis hal-hal random yang ada di kepalamu.
            Semua punya tempat di MyMind.
        </p>
    </div>
</section>

<!-- FUNGSI -->
<section class="tentang-section bg-soft">
    <h2 class="section-title">✨ Apa yang Bisa Kamu Lakukan?</h2>
    <div class="fitur-grid">

        <div class="fitur-card">
            <span class="fitur-emoji">📔</span>
            <h3>Diary</h3>
            <p>Catat kejadian sehari-hari dan ungkapkan perasaanmu.</p>
        </div>

        <div class="fitur-card">
            <span class="fitur-emoji">🪶</span>
            <h3>Puisi</h3>
            <p>Ekspresikan emosimu lewat rangkaian kata yang indah.</p>
        </div>

        <div class="fitur-card">
            <span class="fitur-emoji">📖</span>
            <h3>Cerpen</h3>
            <p>Tuangkan imajinasimu dalam sebuah cerita pendek.</p>
        </div>

        <div class="fitur-card">
            <span class="fitur-emoji">🎵</span>
            <h3>Lirik Lagu</h3>
            <p>Simpan lirik lagu favoritmu atau ciptaanmu sendiri.</p>
        </div>

        <div class="fitur-card">
            <span class="fitur-emoji">🍜</span>
            <h3>Resep</h3>
            <p>Catat resep masakan andalanmu supaya tidak lupa.</p>
        </div>

        <div class="fitur-card">
            <span class="fitur-emoji">☁️</span>
            <h3>Random</h3>
            <p>Tulis apa saja yang ada di pikiranmu tanpa batas.</p>
        </div>

    </div>
</section>

<!-- CARA PAKAI -->
<section class="tentang-section">
    <h2 class="section-title">🚀 Cara Menggunakan MyMind</h2>
    <div class="langkah-list">

        <div class="langkah-item">
            <div class="langkah-num">1</div>
            <div class="langkah-text">
                <h3>Buat Akun</h3>
                <p>Daftar dengan username, email, dan password. Gratis dan mudah!</p>
            </div>
        </div>

        <div class="langkah-item">
            <div class="langkah-num">2</div>
            <div class="langkah-text">
                <h3>Login</h3>
                <p>Masuk ke akunmu menggunakan email dan password yang sudah didaftarkan.</p>
            </div>
        </div>

        <div class="langkah-item">
            <div class="langkah-num">3</div>
            <div class="langkah-text">
                <h3>Mulai Menulis</h3>
                <p>Pilih kategori tulisan, tentukan mood-mu, lalu tuangkan semua pikiranmu!</p>
            </div>
        </div>

        <div class="langkah-item">
            <div class="langkah-num">4</div>
            <div class="langkah-text">
                
                <p>Klik simpan dan tulisanmu otomatis masuk ke halaman Koleksi.</p>
            </div>
        </div>

        <div class="langkah-item">
            <div class="langkah-num">5</div>
            <div class="langkah-text">
                <h3>Baca Kapan Saja</h3>
                <p>Buka koleksimu kapan pun kamu mau untuk membaca ulang tulisan-tulisanmu.</p>
            </div>
        </div>

    </div>
</section>

<!-- FOOTER -->
<footer>
    © 2026 MY MIND - Tempat Mengekspresikan Diri
</footer>

<script src="script.js"></script>
</body>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang - MyMind</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* ===== TENTANG PAGE ===== */
        .tentang-hero {
    text-align: center;
    padding: 80px 20px 60px;
    background: linear-gradient(135deg, #7C6FCD 0%, #a29bfe 50%, #D4A5E8 100%);
    position: relative;
    overflow: hidden;
}

/* Dekorasi lingkaran di background */
.tentang-hero::before {
    content: '';
    position: absolute;
    width: 300px; height: 300px;
    border-radius: 50%;
    background: rgba(255,255,255,0.08);
    top: -80px; left: -60px;
}
.tentang-hero::after {
    content: '';
    position: absolute;
    width: 200px; height: 200px;
    border-radius: 50%;
    background: rgba(255,255,255,0.08);
    bottom: -50px; right: -40px;
}

/* Teks jadi putih */
.tentang-hero h1 {
    font-size: 2.5rem;
    margin-bottom: 10px;
    color: white !important;
    position: relative;
    z-index: 1;
}
.tentang-hero h1 span {
    color: #FFE066 !important;
}
.tentang-hero p {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.9) !important;
    position: relative;
    z-index: 1;
}
        
        .tentang-section {
            max-width: 900px;
            margin: 0 auto;
            padding: 20px 20px;
        }
        .bg-soft {
            background: #f8f6ff;
            max-width: 100%;
            padding: 50px 40px;
        }
        .tentang-card {
            background: white;
            border-radius: 16px;
            padding: 36px;
            box-shadow: 0 4px 20px rgba(26, 1, 24, 0.1);
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s; /* tambah ini */
        }

/* tambah ini */
.tentang-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 24px rgba(124,111,205,0.2);
}
        
        .tentang-icon {
            font-size: 3rem;
            margin-bottom: 16px;
        }
        .tentang-card h2 {
            color: #7C6FCD;
            margin-bottom: 16px;
        }
        .tentang-card p {
            color: #160000;
            line-height: 1.8;
            margin-bottom: 12px;
        }
        .section-title {
            text-align: center;
            font-size: 1.6rem;
            color: #7C6FCD;
            margin-bottom: 36px;
        }
        .fitur-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .fitur-card {
            background: white;
            border-radius: 14px;
            padding: 28px 20px;
            text-align: center;
            box-shadow: 0 2px 12px rgba(124,111,205,0.1);
            transition: transform 0.2s;
        }
        .fitur-card:hover {
            transform: translateY(-4px);
        }
        .fitur-emoji {
            font-size: 2.2rem;
            display: block;
            margin-bottom: 12px;
        }
        .fitur-card h3 {
            color: #7C6FCD;
            margin-bottom: 8px;
        }
        .fitur-card p {
            font-size: 0.88rem;
            color: #160000;
        }
        .langkah-list {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            max-width: 900px;
            margin: 0 auto;
        }
        .langkah-item {
    display: flex;
    align-items: flex-start;
    gap: 20px;
    background: white;
    border-radius: 14px;
    padding: 24px;
    box-shadow: 0 2px 12px rgba(124,111,205,0.1);
    transition: transform 0.2s, box-shadow 0.2s; /* tambah ini */
}

/* tambah ini */
.langkah-item:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(124,111,205,0.2);
}
        .langkah-num {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #7C6FCD;
            color: white;
            font-size: 1.2rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }
        .langkah-text h3 {
            color: #7C6FCD;
             margin-bottom: 6px;
        }
        .langkah-text p {
           font-size: 0.9rem;
             color: #160000;
        }
    
        .langkah-text p {
            font-size: 0.9rem;
            color: #160000;
        }
        @media (max-width: 600px) {
            .fitur-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            .tentang-hero h1 {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
</html>