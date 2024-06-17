<?php 
require '../../../controller/functions.php';

session_start();


$id_user = $_SESSION['id_user'];
$keyword = $_GET['keyword'];
$kategori_barang = $_GET['kategory'];
$jenis_barang = $_GET['jenisBarang'];
$jenis_barang = explode('.', $jenis_barang)[0];

$res = '<tbody class="active">';
$like_keyword = "%$keyword%";
$query = '';
$params = [];
$types = '';

if ($jenis_barang === "all") {
    // Query untuk semua jenis barang
    $query = "SELECT * FROM $kategori_barang WHERE 
              namaBarang LIKE ? OR 
              tempat LIKE ? OR 
              deskripsi LIKE ?";
    $params = [$like_keyword, $like_keyword, $like_keyword];
    $types = 'sss';
} elseif ($jenis_barang === "laporansaya") {
    // Query untuk laporan berdasarkan id_user
    $query = "SELECT * FROM $kategori_barang WHERE id_user = ? AND
              (namaBarang LIKE ? OR 
              tempat LIKE ? OR 
              deskripsi LIKE ?)";
    $params = [$id_user, $like_keyword, $like_keyword, $like_keyword];
    $types = 'isss'; // 'i' untuk integer, 's' untuk string
} else {
    // Query untuk jenis barang tertentu
    $query = "SELECT * FROM $kategori_barang WHERE 
              jenisBarang = ? AND 
              (namaBarang LIKE ? OR 
              tempat LIKE ? OR 
              deskripsi LIKE ?)";
    $params = [$jenis_barang, $like_keyword, $like_keyword, $like_keyword];
    $types = 'ssss';
}

// Prepare the SQL statement
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, $types, ...$params);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    // Fetch and display the results
    while ($row = mysqli_fetch_assoc($result)) {
        $res .= '<tr>';
        $res .= '<td>';
        $res .= '<img src="../../img/goodspict/' . htmlspecialchars($row['gambar'], ENT_QUOTES, 'UTF-8') . '">';
        $res .= '<p>' . htmlspecialchars($row['namaBarang'], ENT_QUOTES, 'UTF-8') . '</p>';
        $res .= '</td>';
        $res .= '<td>' . htmlspecialchars($row['reporting_date'], ENT_QUOTES, 'UTF-8') . '</td>';
        $res .= '<td>' . htmlspecialchars($row['tempat'], ENT_QUOTES, 'UTF-8') . '</td>';
        $res .= '<td>' . htmlspecialchars($row['jenisBarang'], ENT_QUOTES, 'UTF-8') . '</td>';
        $res .= '<td>' . htmlspecialchars($row['deskripsi'], ENT_QUOTES, 'UTF-8') . '</td>';
        $res .= '<td><span class="status completed">Completed</span></td>';
        $res .= '</tr>';
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo 'Failed to prepare the statement: ' . mysqli_error($conn);
}

$res .= "</tbody>";

// Output the result
echo $res;
?>
