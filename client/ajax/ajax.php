<?php 
require '../../controller/functions.php';

$keyword = $_GET['keyword'];
$kategori_barang = $_GET['kategory'];
$jenis_barang = $_GET['jenisBarang'];
$jenis_barang = explode('.', $jenis_barang)[0];

$res = '<tbody class="active">';

if ($jenis_barang === "all") {
    // Prepare SQL statement
    $stmt = mysqli_prepare($conn, "SELECT * FROM $kategori_barang WHERE (namaBarang LIKE ? OR tempat LIKE ? OR deskripsi LIKE ?)");
    $like_keyword = "%$keyword%";
    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'sss', $like_keyword, $like_keyword, $like_keyword);
} else {
    // Prepare SQL statement with jenisBarang filter
    $stmt = mysqli_prepare($conn, "SELECT * FROM $kategori_barang WHERE jenisBarang = ? AND (namaBarang LIKE ? OR tempat LIKE ? OR deskripsi LIKE ?)");
    $like_keyword = "%$keyword%";
    // Bind parameters
    mysqli_stmt_bind_param($stmt, 'ssss', $jenis_barang, $like_keyword, $like_keyword, $like_keyword);
}

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

// Fetch and display the results
while ($row = mysqli_fetch_assoc($result)) {
    $res .= '<tr>';
    $res .= '<td>';
    $res .= '<img src="../img/goodspict/' . htmlspecialchars($row['gambar'], ENT_QUOTES, 'UTF-8') . '">';
    $res .= '<p>' . htmlspecialchars($row['namaBarang'], ENT_QUOTES, 'UTF-8') . '</p>';
    $res .= '</td>';
    $res .= '<td>' . htmlspecialchars($row['reporting_date'], ENT_QUOTES, 'UTF-8') . '</td>';
    $res .= '<td>' . htmlspecialchars($row['tempat'], ENT_QUOTES, 'UTF-8') . '</td>';
    $res .= '<td>' . htmlspecialchars($row['jenisBarang'], ENT_QUOTES, 'UTF-8') . '</td>';
    $res .= '<td>' . htmlspecialchars($row['deskripsi'], ENT_QUOTES, 'UTF-8') . '</td>';
    $res .= '<td><span class="status completed">Completed</span></td>';
    $res .= '</tr>';
}

$res .= "</tbody>";

// Close the statement
mysqli_stmt_close($stmt);

// Output the result
echo $res;
?>
