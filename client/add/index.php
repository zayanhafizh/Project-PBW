<?php 



?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pelaporan Barang Hilang atau Temuan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="form-container">
        <h2>Form Pelaporan Barang Hilang atau Temuan</h2>
        <form action="../../controller/addController.php" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="jenis-laporan">Jenis Laporan:</label>
                <select id="jenis-laporan" name="jenis_laporan" required>
                    <option value="">Pilih jenis laporan</option>
                    <option value="barang_hilang">Barang Hilang</option>
                    <option value="barang_temuan">Barang Temuan</option>
                </select>
            </div>
            <div class="form-group">
                <label for="nama-barang">Nama Barang:</label>
                <input type="text" id="nama-barang" name="nama_barang" required>
            </div>
            <div class="form-group">
                <label for="jenis-barang">Jenis Barang:</label>
                <select id="jenis-barang" name="jenis_barang" required>
                    <option value="">Pilih jenis barang</option>
                    <option value="Aksesoris">Aksesoris</option>
                    <option value="Alat tulis">Alat Tulis</option>
                    <option value="Elektronik">Elektronik</option>
                    <option value="Barang lain">Barang Lain</option>
                </select>
            </div>
            <div class="form-group">
                <label for="tempat">Tempat Hilang/Temuan:</label>
                <input type="text" id="tempat" name="tempat" required>
            </div>
            <div class="form-group">
                <label for="gambar-barang">Foto Barang:</label>
                <input type="file" id="gambar-barang" name="gambar" required>
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Barang:</label>
                <textarea id="deskripsi" name="deskripsi" required></textarea>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Pelaporan:</label>
                <input type="date" id="tanggal" name="tanggal_pelaporan" required>
            </div>
            <div class="form-group">
                <button type="submit">Kirim Laporan</button>
            </div>
        </form>
    </div>
</body>
</html>
