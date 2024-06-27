<?php 
require '../../../controller/functions.php';

$id = $_GET['id'] ?? null;
$kategori_barang = $_GET['kategory'];
$jenis_barang = $_GET['jenisBarang'];
$jenis_barang = explode('.', $jenis_barang)[0];

if ($id && is_numeric($id)) {
    // Prepare the statement to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM user 
                            INNER JOIN $kategori_barang ON user.id_user = $kategori_barang.id_user
                            WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $rows = $result->fetch_assoc();

    if (!$rows) {
        echo "Item not found.";
        $stmt->close();
        $conn->close();
        exit;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid or missing ID.";
    exit;
}



?>
<div class="img-modal-content">
<img src="../../img/goodspict/<?= $rows['gambar'] ?>" alt="item-img" />
</div>
<div class="item-details">
    <h2><?php echo htmlspecialchars($rows['namaBarang']); ?></h2>
    <div class="description">
        <p><?php echo htmlspecialchars($rows['deskripsi']); ?></p>
    </div>
</div>
<div class="information">
    <div class="head-information">
        <ul>
            <li>Nama Barang</li>
            <li>Email</li>
            <li>Tempat</li>
            <li>Tanggal Dilaporkan</li>
        </ul>
    </div>
    <div class="body-information">
        <ul>
            <li><?php echo htmlspecialchars($rows['namaBarang']); ?></li>
            <li><?php echo htmlspecialchars($rows['email']); ?></li>
            <li><?php echo htmlspecialchars($rows['tempat']); ?></li>
            <li><?php echo htmlspecialchars($rows['reporting_date']); ?></li>
        </ul>
    </div>
</div>

