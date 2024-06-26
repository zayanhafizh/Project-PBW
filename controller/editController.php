<?php 
require 'functions.php';

$id = filter_var($_POST['id'], FILTER_VALIDATE_INT);
$kategoriBarang = htmlspecialchars($_POST['kat']);
$namaBarang = htmlspecialchars($_POST["nama_barang"]);
$jenisBarang = htmlspecialchars($_POST['jenis_barang']);
$tempat = htmlspecialchars($_POST['tempat']);
$deskripsi = htmlspecialchars($_POST['deskripsi']);
$tanggal_pelaporan = htmlspecialchars($_POST['tanggal_pelaporan']);
$gambarLama = ($_POST["gambarLama"]);

define('CLIENT_URL', 'http://localhost/fixSiPencari/client/');
define('LAPORAN_URL', CLIENT_URL . 'category/laporansaya/' . $kategoriBarang . '.php');

if ($_FILES["gambar"]["error"] === 4) {
    $gambar = $gambarLama;
} else {
    $gambar = upload(); // Ensure upload() function has security checks
}

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stmt = $conn->prepare("UPDATE $kategoriBarang SET 
                        namaBarang = ?, 
                        tempat = ?, 
                        gambar = ?, 
                        jenisBarang = ?, 
                        deskripsi = ?, 
                        reporting_date = ?
                        WHERE id = ?");
$stmt->bind_param("sssssss", $namaBarang, $tempat, $gambar, $jenisBarang, $deskripsi, $tanggal_pelaporan, $id);

if ($stmt->execute()) {
    header('Location:' . LAPORAN_URL);
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
