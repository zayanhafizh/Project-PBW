<?php 
require "../../controller/functions.php";

$id = htmlspecialchars($_GET['id']);
$kategoriBarang = htmlspecialchars($_GET['kat']);

$sql = "SELECT * FROM $kategoriBarang WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id);
$stmt->execute();
$result = $stmt->get_result();

// Memeriksa apakah ada baris data yang ditemukan
if ($result->num_rows > 0) {
    // Mengambil satu baris data
    $row = $result->fetch_assoc();
} else {
    // Jika tidak ada data yang ditemukan, mungkin Anda ingin menampilkan pesan atau melakukan tindakan lain
    echo "Data tidak ditemukan";
}
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
        <form action="../../controller/editController.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?= $id ?>">
            <input type="hidden" name="kat" value="<?= $kategoriBarang ?>">
            <input type="hidden" name="gambarLama" value="<?= $row['gambar'] ?>">
            <div class="form-group">
                <label for="nama-barang">Nama Barang:</label>
                <input type="text" id="nama-barang" name="nama_barang" value="<?= isset($row['namaBarang']) ? $row['namaBarang'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="jenis-barang">Jenis Barang:</label>
                <select id="jenis-barang" name="jenis_barang" required>
                    <option value="">Pilih jenis barang</option>
                    <option value="Aksesoris" <?php echo ($row['jenisBarang'] === 'Aksesoris') ? 'selected' : ''; ?>>Aksesoris</option>
                    <option value="Alat tulis" <?php echo ($row['jenisBarang'] === 'Alat tulis') ? 'selected' : ''; ?>>Alat Tulis</option>
                    <option value="Elektronik" <?php echo ($row['jenisBarang'] === 'Elektronik') ? 'selected' : ''; ?>>Elektronik</option>
                    <option value="Barang lain" <?php echo ($row['jenisBarang'] === 'Barang lain') ? 'selected' : ''; ?>>Barang Lain</option>
                </select>

            </div>
            <div class="form-group">
                <label for="tempat">Tempat Hilang/Temuan:</label>
                <input type="text" id="tempat" name="tempat" value="<?= isset($row['tempat']) ? $row['tempat'] : '' ?>" required>
            </div>
            <div class="form-group">
                <label for="gambar-barang">Foto Barang:</label>
                <input type="file" id="gambar-barang" name="gambar">
            </div>
            <div class="form-group">
                <label for="deskripsi">Deskripsi Barang:</label>
                <textarea id="deskripsi" name="deskripsi" required><?= isset($row['deskripsi']) ? $row['deskripsi'] : '' ?></textarea>
            </div>
            <div class="form-group">
                <label for="tanggal">Tanggal Pelaporan:</label>
                <input type="date" id="tanggal" name="tanggal_pelaporan" value="<?php echo $row['reporting_date']; ?>" required>
            </div>
            <div class="form-group">
                <button type="submit">Ubah</button>
            </div>
        </form>
    </div>
</body>
</html>
