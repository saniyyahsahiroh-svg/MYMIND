<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginmymind.php");
    exit;
}
include 'koneksi.php';

$user_id  = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Hitung total tulisan
$total = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM writings WHERE user_id='$user_id'"))['total'];

// Hitung per kategori
$diary  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM writings WHERE user_id='$user_id' AND category='Diary'"))['total'];
$puisi  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM writings WHERE user_id='$user_id' AND category='Puisi'"))['total'];
$cerpen = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM writings WHERE user_id='$user_id' AND category='Cerpen'"))['total'];
$resep  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM writings WHERE user_id='$user_id' AND category='Resep'"))['total'];
$random = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM writings WHERE user_id='$user_id' AND category='Random'"))['total'];
$lirik  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM writings WHERE user_id='$user_id' AND category='Lirik Lagu'"))['total'];

// Array statistik
$stats = [
    ["emoji" => "📔", "nama" => "Diary",  "total" => $diary],
    ["emoji" => "🪶", "nama" => "Puisi",  "total" => $puisi],
    ["emoji" => "📖", "nama" => "Cerpen", "total" => $cerpen],
    ["emoji" => "🎵", "nama" => "Lirik",  "total" => $lirik],
    ["emoji" => "🍜", "nama" => "Resep",  "total" => $resep],
    ["emoji" => "☁️", "nama" => "Random","total" => $random],
];

// Ambil 3 tulisan terbaru
$terbaru = mysqli_query($conn, "SELECT * FROM writings WHERE user_id='$user_id' ORDER BY created_at DESC LIMIT 3");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY MIND</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .hero {
            padding: 20px 50px !important;
            margin-bottom: 0 !important;
            align-items: center !important;
        }
        .hero div {
            margin-top: 0 !important;
        }
        .hero img {
            width: 420px !important;
            max-height: 320px !important;
            object-fit: contain !important;
        }
        .stats-section {
            padding-top: 0 !important;
            padding-bottom: 20px !important;
        }
        .stats-section {
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .stats-section h3 {
            font-size: 1.2rem;
            color: #7C6FCD;
            margin-bottom: 20px;
            font-weight: 700;
        }
        .stats-total {
            background: linear-gradient(135deg, #7C6FCD, #a29bfe);
            color: white;
            border-radius: 16px;
            padding: 24px 32px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .stats-total .big-num {
            font-size: 3rem;
            font-weight: 900;
            line-height: 1;
        }
        .stats-total .big-label {
            font-size: 1rem;
            opacity: 0.9;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(6, 1fr);
            gap: 12px;
        }
        .stat-card {
            background: white;
            border-radius: 14px;
            padding: 20px 12px;
            text-align: center;
            box-shadow: 0 2px 12px rgba(124,111,205,0.1);
            border: 1.5px solid #EDE9FF;
            transition: transform 0.2s;
        }
        .stat-card:hover { transform: translateY(-4px); }
        .stat-card .stat-emoji { font-size: 1.8rem; display: block; margin-bottom: 8px; }
        .stat-card .stat-num  { font-size: 1.6rem; font-weight: 900; color: #7C6FCD; display: block; }
        .stat-card .stat-nama { font-size: 0.75rem; color: #999; margin-top: 4px; display: block; }

        /* Tulisan terbaru */
        .terbaru-card {
            display: flex;
            align-items: center;
            gap: 14px;
            background: white;
            border: 1.5px solid #EDE9FF;
            border-radius: 14px;
            padding: 16px 20px;
            margin-bottom: 10px;
            text-decoration: none;
            color: inherit;
            transition: 0.2s;
        }
        .terbaru-card:hover { border-color: #7C6FCD; }
        .terbaru-icon {
            width: 46px; height: 46px;
            border-radius: 12px;
            background: #EDE9FF;
            display: flex; align-items: center; justify-content: center;
            font-size: 1.4rem; flex-shrink: 0;
        }
        .terbaru-title {
            font-weight: 700; font-size: 0.95rem;
            margin-bottom: 4px;
            white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }
        .terbaru-preview { font-size: 0.8rem; color: #888; }
        .terbaru-date { font-size: 0.75rem; color: #999; flex-shrink: 0; }
     <style>
    .hero {
        padding: 10px 50px !important;
        margin-bottom: 0 !important;
        align-items: center !important;
    }
    .hero img {
        width: 450px !important;
        max-height: 350px !important;
        object-fit: contain !important;
    }
    .hero div {
        margin-top: 0 !important;
    }
    .stats-section {
        padding-top: 10px !important;
    }
</style>
    </style>
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
            👤 <?php echo $username; ?>
        </span>
        <button id="darkModeToggle">🌙</button>
    </div>
</header>

<!-- HERO -->
<section class="hero">
    <div>
        <h1>
            Haii, <span class="highlight"><?php echo $username; ?>!</span> 👋<br>
            Mau nulis apa hari ini?
        </h1>
        <p>Tulis bebas apa yang ada di pikiranmu.<br>
Simpan kenangan, ide, perasaan, dan kreativitasmu di sini.<br><br>
MyMind adalah ruang pribadimu untuk menuangkan diary harian, 
puisi, cerpen, lirik lagu, resep, atau apapun yang ada di kepalamu. 
Tidak ada yang menghakimi — hanya kamu dan pikiranmu. 💜</p>
        <a href="mulaimenulis.php" class="btn btn-primary">Mulai Menulis ✏️</a>
        <a href="kolekmymind.php" class="btn btn-outline">Lihat Koleksi 📚</a>
    </div>
    <img src="foto.jpeg" alt="ilustrasi">
</section>

<!-- STATISTIK -->
<section class="stats-section">
    <h3>📊 Statistik Tulisanmu</h3>
    <div class="stats-total">
        <div class="big-num"><?php echo $total; ?></div>
        <div>
            <div class="big-label">Total Tulisan</div>
            <div style="font-size:0.85rem; opacity:0.8;">Semua yang pernah kamu tulis di MyMind</div>
        </div>
    </div>
    <div class="stats-grid">
        <?php foreach($stats as $stat): ?>
        <div class="stat-card">
            <span class="stat-emoji"><?php echo $stat['emoji']; ?></span>
            <span class="stat-num"><?php echo $stat['total']; ?></span>
            <span class="stat-nama"><?php echo $stat['nama']; ?></span>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<!-- TULISAN TERBARU -->
<section class="stats-section" style="padding-top:0;">
    <h3>🕐 Tulisan Terbaru</h3>
    <?php
    if (mysqli_num_rows($terbaru) == 0) {
        echo "<p style='color:#999;'>Belum ada tulisan. Yuk mulai menulis!</p>";
    } else {
        while($t = mysqli_fetch_assoc($terbaru)) {
            switch($t['category']) {
                case 'Diary':      $icon = '📔'; break;
                case 'Puisi':      $icon = '🪶'; break;
                case 'Cerpen':     $icon = '📖'; break;
                case 'Lirik Lagu': $icon = '🎵'; break;
                case 'Resep':      $icon = '🍜'; break;
                default:           $icon = '☁️';
            }
            $tanggal = date('d M Y', strtotime($t['created_at']));
            $preview = substr($t['content'], 0, 60);
            echo "
            <a href='detail.php?id=" . $t['id'] . "' class='terbaru-card'>
                <div class='terbaru-icon'>$icon</div>
                <div style='flex:1; min-width:0;'>
                    <div class='terbaru-title'>" . $t['title'] . "</div>
                    <div class='terbaru-preview'>$preview...</div>
                </div>
                <div class='terbaru-date'>📅 $tanggal</div>
            </a>";
        }
    }
    ?>
    <a href="kolekmymind.php" 
       style="display:inline-block; margin-top:12px;
              font-size:0.88rem; color:#7C6FCD; font-weight:600;">
        Lihat semua tulisan →
    </a>
</section>

<!-- FOOTER -->
<footer>
    © 2026 MY MIND - Tempat Mengekspresikan Diri
</footer>

<script src="script.js"></script>
</body>
</html>