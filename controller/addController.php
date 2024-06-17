<?php
require 'functions.php';
session_start();
define('BASE_URL','http://localhost/fixSiPencari/client/');
try {
    $jenis_laporan = htmlspecialchars($_POST['jenis_laporan']);
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $jenis_barang = htmlspecialchars($_POST['jenis_barang']);
    $tempat = htmlspecialchars($_POST['tempat']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $tanggal_pelaporan = htmlspecialchars($_POST['tanggal_pelaporan']);
    $id_user = $_SESSION['id_user'];

    $gambar = upload();
    if (!$gambar) {
        throw new Exception("Upload gambar gagal.");
        header('Location: '.BASE_URL.'add');
    }

    if ($jenis_laporan === 'barang_hilang') {
        $stmt = mysqli_prepare($conn, "INSERT INTO baranghilang (namaBarang, gambar, tempat, jenisBarang, deskripsi, id_user) VALUES (?, ?, ?, ?, ?, ?)");
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO barangtemuan (namaBarang, gambar, tempat, jenisBarang, deskripsi, id_user) VALUES (?, ?, ?, ?, ?, ?)");
    }

    if (!$stmt) {
        throw new Exception("Gagal membuat pernyataan SQL.");
    }

    mysqli_stmt_bind_param($stmt, 'sssssi', $nama_barang, $gambar, $tempat, $jenis_barang, $deskripsi, $id_user);

    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Gagal mengeksekusi pernyataan SQL.");
    }

    header('Location: '.BASE_URL);
} catch (Exception $e) {
    echo "Terjadi kesalahan: " . $e->getMessage();
}
?>
