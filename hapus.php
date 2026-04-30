<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: loginmymind.php");
    exit;
}

include 'koneksi.php';

$id      = $_POST['id'];
$user_id = $_SESSION['user_id'];

// Hapus tulisan — WHERE untuk keamanan
$sql = "DELETE FROM writings WHERE id='$id' AND user_id='$user_id'";

if (mysqli_query($conn, $sql)) {
    header("Location: kolekmymind.php");
    exit;
} else {
    echo "Gagal menghapus: " . mysqli_error($conn);
}
?>