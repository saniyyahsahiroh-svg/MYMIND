<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginmymind.php");
    exit;
}
include "koneksi.php";

$user_id = $_SESSION['user_id'];

// ===== FUNCTION BUATAN SENDIRI =====
function getMoodIcon($mood) {
    switch($mood) {
        case 'Bahagia': return '😊';
        case 'Sedih':   return '😢';
        case 'Marah':   return '😤';
        case 'Senang':  return '😄';
        case 'Cemas':   return '😰';
        default:        return '😐';
    }
}

function getKategoriIcon($kategori) {
    switch($kategori) {
        case 'Diary':      return '📔';
        case 'Puisi':      return '🪶';
        case 'Cerpen':     return '📖';
        case 'Lirik Lagu': return '🎵';
        case 'Resep':      return '🍜';
        default:           return '☁️';
    }
}

// Ambil filter kategori dari GET
$filter = $_GET['kategori'] ?? 'Semua';

// Ambil keyword pencarian dari GET
$search = $_GET['search'] ?? '';

// Query dengan filter + pencarian — WHERE + operator logika
if ($filter != 'Semua' && !empty($search)) {
    $search_safe = mysqli_real_escape_string($conn, $search);
    $filter_safe = mysqli_real_escape_string($conn, $filter);
    $data = mysqli_query($conn, "SELECT * FROM writings 
        WHERE user_id='$user_id' 
        AND category='$filter_safe'
        AND title LIKE '%$search_safe%'
        ORDER BY id DESC");
} elseif ($filter != 'Semua') {
    $filter_safe = mysqli_real_escape_string($conn, $filter);
    $data = mysqli_query($conn, "SELECT * FROM writings 
        WHERE user_id='$user_id' 
        AND category='$filter_safe'
        ORDER BY id DESC");
} elseif (!empty($search)) {
    $search_safe = mysqli_real_escape_string($conn, $search);
    $data = mysqli_query($conn, "SELECT * FROM writings 
        WHERE user_id='$user_id' 
        AND title LIKE '%$search_safe%'
        ORDER BY id DESC");
} else {
    $data = mysqli_query($conn, "SELECT * FROM writings 
        WHERE user_id='$user_id' 
        ORDER BY id DESC");
}

// Array kategori
$kategori_list = ['Semua', 'Diary', 'Puisi', 'Cerpen', 'Lirik Lagu', 'Resep', 'Random'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Koleksi - MyMind</title>
    <link rel="stylesheet" href="style.css">
    <style>
    /* BANNER HEADER */
    .koleksi-banner {
        background: linear-gradient(135deg, #7C6FCD 0%, #a29bfe 50%, #D4A5E8 100%);
        padding: 40px 50px;
        color: white;
        margin-bottom: 0;
        position: relative;
        overflow: hidden;
    }
    .koleksi-banner::before {
        content: '';
        position: absolute;
        width: 250px; height: 250px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
        top: -80px; right: -60px;
    }
    .koleksi-banner::after {
        content: '';
        position: absolute;
        width: 150px; height: 150px;
        border-radius: 50%;
        background: rgba(255,255,255,0.08);
        bottom: -40px; left: 40px;
    }
    .koleksi-banner h2 {
        font-size: 2rem;
        font-weight: 900;
        margin-bottom: 6px;
        position: relative;
        z-index: 1;
    }
    .koleksi-banner p {
        font-size: 0.9rem;
        opacity: 0.85;
        position: relative;
        z-index: 1;
    }

    /* WRAP */
    .koleksi-wrap {
        max-width: 800px;
        margin: 0 auto;
        padding: 30px 20px 60px;
    }

    /* Search bar */
    .search-wrap {
        position: relative;
        margin-bottom: 16px;
    }
    .search-wrap input {
        width: 100%;
        padding: 11px 16px 11px 42px;
        border: 1.5px solid #EDE9FF;
        border-radius: 999px;
        font-size: 0.9rem;
        outline: none;
        transition: 0.2s;
        box-sizing: border-box;
        background: white;
    }
    .search-wrap input:focus { border-color: #7C6FCD; }
    .search-icon {
        position: absolute;
        left: 14px; top: 50%;
        transform: translateY(-50%);
        font-size: 1rem;
    }
    .search-wrap button {
        position: absolute;
        right: 8px; top: 50%;
        transform: translateY(-50%);
        background: #7C6FCD;
        color: white; border: none;
        border-radius: 999px;
        padding: 6px 16px;
        font-size: 0.82rem;
        cursor: pointer; font-weight: 600;
    }

    /* Filter */
    .filter-wrap {
        display: flex;
        gap: 8px; flex-wrap: wrap;
        margin-bottom: 20px;
    }
    .filter-btn {
        padding: 7px 16px;
        border-radius: 999px;
        font-size: 0.82rem; font-weight: 600;
        border: 1.5px solid #EDE9FF;
        background: white; color: #999;
        cursor: pointer; text-decoration: none;
        transition: 0.2s;
    }
    .filter-btn:hover, .filter-btn.active {
        background: #7C6FCD;
        border-color: #7C6FCD;
        color: white;
    }

    /* Note card */
    .note-card {
        display: flex;
        align-items: center;
        gap: 16px;
        border: 1.5px solid #eee;
        border-radius: 14px;
        padding: 18px 20px;
        margin-bottom: 12px;
        cursor: pointer;
        transition: all 0.25s;
        text-decoration: none;
        color: inherit;
        position: relative;
        overflow: hidden;
        background: white;
    }
    /* Strip warna di kiri card */
    .note-card::before {
        content: '';
        position: absolute;
        left: 0; top: 0; bottom: 0;
        width: 4px;
        border-radius: 4px 0 0 4px;
        background: #7C6FCD;
        transform: scaleY(0);
        transition: transform 0.25s;
    }
    .note-card:hover::before { transform: scaleY(1); }
    .note-card:hover {
        border-color: #7C6FCD;
        box-shadow: 0 6px 20px rgba(124,111,205,0.15);
        transform: translateX(6px);
    }
    .note-icon {
        width: 52px; height: 52px;
        border-radius: 14px;
        display: flex; align-items: center; justify-content: center;
        font-size: 1.6rem; flex-shrink: 0;
    }
    /* Warna icon per kategori */
    .icon-diary     { background: #EDE9FF; }
    .icon-puisi     { background: #FDEEF5; }
    .icon-cerpen    { background: #E8F2FF; }
    .icon-lirik     { background: #F3EEFF; }
    .icon-resep     { background: #E8F5EA; }
    .icon-random    { background: #EAF1F9; }

    .note-body { flex: 1; min-width: 0; }
    .note-title {
        font-weight: 700; font-size: 1rem;
        color: var(--text-main);
        margin-bottom: 4px;
        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    }
    .note-preview {
        font-size: 0.83rem; color: #888;
        margin-bottom: 8px;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .note-meta { display: flex; gap: 8px; flex-wrap: wrap; }
    .badge-kat {
        padding: 3px 10px; border-radius: 999px;
        font-size: 0.72rem; font-weight: 700;
        background: #EDE9FF; color: #7C6FCD;
    }
    .badge-mood {
        padding: 3px 10px; border-radius: 999px;
        font-size: 0.72rem; font-weight: 700;
        background: #FFF3E0; color: #E67E22;
    }
    .badge-date {
        padding: 3px 10px; border-radius: 999px;
        font-size: 0.72rem;
        background: #F5F5F5; color: #999;
    }
    .empty-state {
        text-align: center; padding: 60px 20px; color: #999;
    }
    .empty-state .empty-emoji { font-size: 3rem; display: block; margin-bottom: 14px; }
    .empty-state h3 { font-size: 1.2rem; color: #555; margin-bottom: 8px; }
    .hasil-info { font-size: 0.85rem; color: #999; margin-bottom: 16px; }
</style>

</head>
<body>

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

<div class="koleksi-banner">
    <h2>📚 Koleksi Tulisan</h2>
    <p>Semua tulisan yang pernah kamu buat.</p>
</div>

<div class="koleksi-wrap">
    </div>

    <!-- Search bar — navigasi GET -->
    <form method="GET" action="kolekmymind.php">
        <input type="hidden" name="kategori" value="<?php echo $filter; ?>">
        <div class="search-wrap">
            <span class="search-icon">🔍</span>
            <input type="text" name="search" 
                   placeholder="Cari judul tulisan..." 
                   value="<?php echo htmlspecialchars($search); ?>">
            <button type="submit">Cari</button>
        </div>
    </form>

    <!-- Filter kategori — navigasi GET -->
    <div class="filter-wrap">
        <?php
        // Loop foreach untuk tombol filter
        foreach($kategori_list as $kat) {
            $active = ($filter == $kat) ? 'active' : '';
            $url = "kolekmymind.php?kategori=" . urlencode($kat) . "&search=" . urlencode($search);
            echo "<a href='$url' class='filter-btn $active'>$kat</a>";
        }
        ?>
    </div>

    <?php
    $jumlah = mysqli_num_rows($data);

    // Operator aritmatika
    $total_tulisan = $jumlah;

    // Info hasil filter/search
    if (!empty($search) || $filter != 'Semua') {
        echo "<p class='hasil-info'>Menampilkan <strong>$total_tulisan</strong> tulisan</p>";
    }

    if ($jumlah == 0) {
        echo "
        <div class='empty-state'>
            <span class='empty-emoji'>📭</span>
            <h3>Tidak ada tulisan</h3>
            <p>Coba kata kunci atau kategori lain.</p>
        </div>";
    } else {
        // Ambil semua data ke array
        $semua_tulisan = [];
        while($row = mysqli_fetch_assoc($data)) {
            $semua_tulisan[] = $row;
        }

        // Loop foreach
        foreach($semua_tulisan as $index => $row) {
    $nomor     = $index + 1;
    $icon      = getKategoriIcon($row['category']);
    $mood_icon = getMoodIcon($row['mood']);
    $tanggal   = date('d M Y', strtotime($row['created_at']));
    $preview   = substr($row['content'], 0, 80);

    // Tentukan class warna icon per kategori
    switch($row['category']) {
        case 'Diary':      $icon_class = 'icon-diary'; break;
        case 'Puisi':      $icon_class = 'icon-puisi'; break;
        case 'Cerpen':     $icon_class = 'icon-cerpen'; break;
        case 'Lirik Lagu': $icon_class = 'icon-lirik'; break;
        case 'Resep':      $icon_class = 'icon-resep'; break;
        default:           $icon_class = 'icon-random';
    }

    echo "
    <a href='detail.php?id=" . $row['id'] . "' class='note-card'>
        <div class='note-icon $icon_class'>$icon</div>
                <div class='note-body'>
                    <div class='note-title'>$nomor. " . $row['title'] . "</div>
                    <div class='note-preview'>$preview...</div>
                    <div class='note-meta'>
                        <span class='badge-kat'>$icon " . $row['category'] . "</span>
                        <span class='badge-mood'>$mood_icon " . $row['mood'] . "</span>
                        <span class='badge-date'>📅 $tanggal</span>
                    </div>
                </div>
            </a>";
        }
    }
    ?>
</div>

<footer>
    © 2026 MYMIND - Tempat Mengekspresikan Diri
</footer>

<script src="script.js"></script>
</body>
</html>