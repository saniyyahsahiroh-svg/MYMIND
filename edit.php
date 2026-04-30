<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginmymind.php");
    exit;
}
include 'koneksi.php';

$user_id = $_SESSION['user_id'];

// Ambil id dari URL (GET)
$id = $_GET['id'] ?? 0;

// SELECT tulisan berdasarkan id
$sql = "SELECT * FROM writings WHERE id='$id' AND user_id='$user_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

// Kalau tidak ditemukan
if (!$row) {
    echo "Tulisan tidak ditemukan!";
    exit;
}

// Proses POST: simpan perubahan
$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title    = mysqli_real_escape_string($conn, $_POST['title']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $mood     = mysqli_real_escape_string($conn, $_POST['mood']);
    $content  = mysqli_real_escape_string($conn, $_POST['content']);

    // Validasi if-else
    if (empty($title) || empty($content) || empty($category) || empty($mood)) {
        $error = "Semua kolom wajib diisi!";
    } else {
        // UPDATE ke database
        $sql_update = "UPDATE writings 
                       SET title='$title', category='$category', 
                           mood='$mood', content='$content'
                       WHERE id='$id' AND user_id='$user_id'";

        if (mysqli_query($conn, $sql_update)) {
            header("Location: detail.php?id=$id");
            exit;
        } else {
            $error = "Gagal menyimpan: " . mysqli_error($conn);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Tulisan - MyMind</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .edit-wrap {
            max-width: 760px;
            margin: 40px auto;
            padding: 0 20px 80px;
        }
        .edit-card {
            background: white;
            border-radius: 16px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(124,111,205,0.1);
            border: 1.5px solid #EDE9FF;
        }
        .edit-card h2 {
            font-size: 1.6rem;
            color: #2D3436;
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

<div class="edit-wrap">
    <a href="detail.php?id=<?php echo $id; ?>" 
       style="display:inline-flex; align-items:center; gap:6px;
              color:#7C6FCD; font-weight:600; font-size:0.88rem;
              margin-bottom:20px; text-decoration:none;">
        ← Kembali ke Detail
    </a>

    <div class="edit-card">
        <h2>✏️ Edit Tulisan</h2>

        <?php if ($error): ?>
            <div class="alert-error">⚠ <?= $error ?></div>
        <?php endif; ?>

        <!-- Form Edit dengan POST -->
        <form method="POST" action="edit.php?id=<?php echo $id; ?>">

            <label>Judul</label>
            <input type="text" name="title" 
                   value="<?php echo htmlspecialchars($row['title']); ?>">

            <div class="form-row">
                <div>
                    <label>Kategori</label>
                    <select name="category">
                        <?php
                        $kategori_list = ['Diary','Puisi','Cerpen','Lirik Lagu','Resep','Random'];
                        foreach($kategori_list as $kat) {
                            $selected = ($row['category'] == $kat) ? 'selected' : '';
                            echo "<option value='$kat' $selected>$kat</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label>Mood</label>
                    <select name="mood">
                        <?php
                        $mood_list = ['Bahagia','Sedih','Marah','Senang','Cemas','Netral'];
                        foreach($mood_list as $m) {
                            $selected = ($row['mood'] == $m) ? 'selected' : '';
                            echo "<option value='$m' $selected>$m</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <label>Tulisanmu</label>
            <textarea name="content"><?php echo htmlspecialchars($row['content']); ?></textarea>

            <br><br>
            <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
            <a href="detail.php?id=<?php echo $id; ?>" class="btn btn-outline">Batal</a>

        </form>
    </div>
</div>

<footer>
    © 2026 MY MIND - Tempat Mengekspresikan Diri
</footer>

<script src="script.js"></script>
</body>
</html>