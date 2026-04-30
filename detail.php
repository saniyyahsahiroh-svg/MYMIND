<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginmymind.php");
    exit;
}

include 'koneksi.php';

// Ambil id dari URL (GET)
$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// SELECT dengan JOIN dan WHERE
$sql = "SELECT writings.*, users.username 
        FROM writings 
        JOIN users ON writings.user_id = users.id
        WHERE writings.id = '$id' AND writings.user_id = '$user_id'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Kalau data tidak ditemukan
if (!$row) {
    echo "Tulisan tidak ditemukan!";
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $row['title']; ?> - MyMind</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .detail-container {
            max-width: 750px;
            margin: 40px auto;
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(124,111,205,0.1);
        }
        .detail-title {
            font-size: 2rem;
            color: #2D3436;
            margin-bottom: 16px;
        }
        .detail-meta {
            display: flex;
            gap: 12px;
            margin-bottom: 28px;
            flex-wrap: wrap;
        }
        .badge {
            padding: 5px 14px;
            border-radius: 999px;
            font-size: 0.82rem;
            font-weight: 600;
        }
        .badge-kategori {
            background: #EDE9FF;
            color: #7C6FCD;
        }
        .badge-mood {
            background: #FFF3E0;
            color: #E67E22;
        }
        .badge-tanggal {
            background: #F0F0F0;
            color: #666;
        }
        .detail-content {
            font-size: 1rem;
            line-height: 1.9;
            color: #444;
            white-space: pre-wrap;
            border-top: 1px solid #eee;
            padding-top: 24px;
        }
        .detail-actions {
            display: flex;
            gap: 12px;
            margin-top: 32px;
            padding-top: 24px;
            border-top: 1px solid #eee;
        }
        .btn-kembali {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 10px 20px;
            background: #EDE9FF;
            color: #7C6FCD;
            border-radius: 999px;
            font-weight: 600;
            text-decoration: none;
            font-size: 0.9rem;
            transition: 0.2s;
        }
        .btn-kembali:hover {
            background: #7C6FCD;
            color: white;
        }
        .btn-hapus {
            padding: 10px 20px;
            background: #FDEEF0;
            color: #C0392B;
            border: 1.5px solid #F5C6CB;
            border-radius: 999px;
            font-weight: 600;
            font-size: 0.9rem;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn-hapus:hover {
            background: #C0392B;
            color: white;
        }
    </style>
</head>
<body>

<!-- HEADER -->
<header>
    <div class="logo">MYMIND 💜</div>
    <div class="toogle">
        <nav>
            <a href="tulismymind.php">Beranda</a>
            <a href="kolekmymind.php">Koleksi</a>
            <a href="tentang.php">Tentang</a>
            <a href="logout.php" style="color:red;">Logout</a>
        <span style="font-size:0.88rem; color:#7C6FCD; font-weight:700;">
            👤 <?php echo $_SESSION['username']; ?>
        </span>
        </nav>
        <button id="darkModeToggle">🌙</button>
    </div>
</header>

<!-- DETAIL TULISAN -->
<div class="detail-container">

    <!-- Tombol kembali -->
    <a href="kolekmymind.php" class="btn-kembali">← Kembali</a>

    <!-- Judul -->
    <h1 class="detail-title"><?php echo $row['title']; ?></h1>

    <!-- Meta info -->
    <div class="detail-meta">
        <span class="badge badge-kategori">
            <?php
            // Switch untuk ikon kategori
            switch($row['category']) {
                case 'Diary':     echo '📔 Diary'; break;
                case 'Puisi':     echo '🪶 Puisi'; break;
                case 'Cerpen':    echo '📖 Cerpen'; break;
                case 'Lirik Lagu':echo '🎵 Lirik Lagu'; break;
                case 'Resep':     echo '🍜 Resep'; break;
                default:          echo '☁️ Random';
            }
            ?>
        </span>
        <span class="badge badge-mood">
            <?php
            // Switch untuk ikon mood
            switch($row['mood']) {
                case 'Bahagia': echo '😊 Bahagia'; break;
                case 'Sedih':   echo '😢 Sedih'; break;
                case 'Marah':   echo '😤 Marah'; break;
                case 'Senang':  echo '😄 Senang'; break;
                default:        echo '😐 Netral';
            }
            ?>
        </span>
        <span class="badge badge-tanggal">
            📅 <?php echo date('d M Y • H.i', strtotime($row['created_at'])); ?>
        </span>
    </div>

    <!-- Isi tulisan -->
    <div class="detail-content">
        <?php echo htmlspecialchars($row['content']); ?>
    </div>

    <!-- Tombol aksi -->
<div class="detail-actions">
    <a href="kolekmymind.php" class="btn-kembali">← Kembali ke Koleksi</a>

    <!-- Tombol Edit — TAMBAHKAN INI -->
    <a href="edit.php?id=<?php echo $row['id']; ?>" 
       style="padding:10px 20px; background:#EDE9FF; color:#7C6FCD; 
              border-radius:999px; font-weight:600; font-size:0.9rem;
              text-decoration:none;">
        ✏️ Edit
    </a>

    <!-- Tombol hapus -->
    <form method="POST" action="hapus.php" 
          onsubmit="return confirm('Yakin mau hapus tulisan ini?')">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <button type="submit" class="btn-hapus">🗑 Hapus</button>
    </form>
</div>

</div>

<footer>
    © 2026 MY MIND - Tempat Mengekspresikan Diri
</footer>

<script src="script.js"></script>
</body>
</html>