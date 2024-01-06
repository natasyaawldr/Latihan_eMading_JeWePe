<?php
include("config.php");
$db = new database;


if (isset($_GET['id'])) {
    $idArtikel = $_GET['id'];

    // Panggil metode untuk menghapus artikel dari database
    $hasilHapus = $db->hapus_artikel($idArtikel);

    if ($hasilHapus) {
        echo "<script>alert('Artikel berhasil dihapus!');document.location.href = 'index.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus artikel!');document.location.href = 'index.php';</script>";
    }
} else {
    echo "<script>alert('ID artikel tidak valid!');document.location.href = 'index.php';</script>";
}
?>
