<?php
require 'functions.php';
session_start();
define('BASE_URL','http://localhost/fixSiPencari/client/');

try {
    // Ambil nilai dari form dan lakukan sanitasi
    $jenis_laporan = htmlspecialchars($_POST['jenis_laporan']);
    $nama_barang = htmlspecialchars($_POST['nama_barang']);
    $jenis_barang = htmlspecialchars($_POST['jenis_barang']);
    $tempat = htmlspecialchars($_POST['tempat']);
    $deskripsi = htmlspecialchars($_POST['deskripsi']);
    $tanggal_pelaporan = htmlspecialchars($_POST['tanggal_pelaporan']); // Ensure it's a safe string
    
    // Ambil id_user dari session
    if (isset($_SESSION['id_user'])) {
        $id_user = $_SESSION['id_user'];
    } else {
        throw new Exception("Sesi pengguna tidak valid.");
    }

    // Upload gambar
    $gambar = upload();
    if (!$gambar) {
        throw new Exception("Upload gambar gagal.");
    }

    // Tentukan tabel berdasarkan jenis laporan
    if ($jenis_laporan === "barang_hilang") {
        $stmt = mysqli_prepare($conn, "INSERT INTO baranghilang (namaBarang, gambar, tempat, jenisBarang, deskripsi, id_user, reporting_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    } else {
        $stmt = mysqli_prepare($conn, "INSERT INTO barangtemuan (namaBarang, gambar, tempat, jenisBarang, deskripsi, id_user, reporting_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
    }

    // Periksa keberhasilan persiapan statement SQL
    if (!$stmt) {
        throw new Exception("Gagal membuat pernyataan SQL.");
    }

    // Binding parameter ke statement SQL
    mysqli_stmt_bind_param($stmt, 'sssssis', $nama_barang, $gambar, $tempat, $jenis_barang, $deskripsi, $id_user, $tanggal_pelaporan);

    // Eksekusi statement SQL
    if (!mysqli_stmt_execute($stmt)) {
        throw new Exception("Gagal mengeksekusi pernyataan SQL.");
    }

    // Redirect jika berhasil dengan alert
    echo "<script>
        alert('Laporan berhasil ditambahkan!');
        window.location.href = '".BASE_URL."';
    </script>";
    exit();
} catch (Exception $e) {
    // Tangani kesalahan dengan menampilkan pesan kesalahan
    echo "<script>
        alert('Terjadi kesalahan: ".$e->getMessage()."');
        window.location.href = '".BASE_URL."add';
    </script>";
    exit();
}
?>
