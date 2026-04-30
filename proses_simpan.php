<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: loginmymind.php");
    exit;
}

include 'koneksi.php';

$user_id  = $_SESSION['user_id'];
$title    = mysqli_real_escape_string($conn, $_POST['title']);
$category = mysqli_real_escape_string($conn, $_POST['category']);
$mood     = mysqli_real_escape_string($conn, $_POST['mood']);
$content  = mysqli_real_escape_string($conn, $_POST['content']);
if (empty($title) || empty($category) || empty($mood) || empty($content)) {
    echo "Semua kolom harus diisi!";
    exit;
}

$sql = "INSERT INTO writings (user_id, title, category, mood, content) 
        VALUES ('$user_id', '$title', '$category', '$mood', '$content')";

if ($conn->query($sql)) {
    header("Location: kolekmymind.php");
    exit;
} else {
    echo "Gagal menyimpan: " . $conn->error;
}
?>