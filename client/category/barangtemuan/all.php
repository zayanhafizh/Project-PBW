<?php 
require '../../../controller/functions.php';
session_start();
// Fetching data using prepared statements
function fetch_data($conn, $table_name, $jenis_barang = null) {
    $query = "SELECT * FROM $table_name";
    $params = [];
    $types = '';

    if ($jenis_barang) {
        $query .= " WHERE jenisBarang = ?";
        $params = [$jenis_barang];
        $types = 's';
    }

    $stmt = mysqli_prepare($conn, $query);

    if ($jenis_barang) {
        mysqli_stmt_bind_param($stmt, $types, ...$params);
    }

    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_stmt_close($stmt);
    return $rows;
}

// Fetching data
$rows = fetch_data($conn, 'barangtemuan');
$barangHilang = fetch_data($conn, 'baranghilang');
$user = fetch_data($conn, 'user');
$barangTemuan = fetch_data($conn, 'barangtemuan');

// Counting data
$countUser = count($user);
$countLostGoods = count($barangHilang);
$countDiscoverGoods = count($barangTemuan);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <!-- Feathericons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <!-- My CSS -->
    <link rel="stylesheet" href="../style.css">

    <title>siPencari</title>
</head>
<body>

    <!-- SIDEBAR -->
    <?php include "../../partials/sidebar.php"; ?>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <?php include "../../partials/navbar.php"; ?>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="head-title">
                <div class="left">
                    <h1>Dashboard</h1>
                    <ul class="breadcrumb">
                        <li>
                            <a href="#">Dashboard</a>
                        </li>
                        <li><i class='bx bx-chevron-right' ></i></li>
                        <li>
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Box info -->
                <?php include "../../partials/boxinfo.php" ?>
            <!-- Box info -->

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Recent Report</h3>
                        <!-- Kotak Pencarian -->
                        <div class="search-box" id="search-box">
                            <form  method="post">
                                <input type="search" placeholder="Search..." class="search-box-input" id="input-report">
                            </form>
                        </div>
                        <!-- /Kotak Pencarian -->
                        <i class='bx bx-search' id="search-icon"></i>
                        <i class='bx bx-filter' ></i>
                    </div>
                    <div id="tbody-replace">
                    <table id="myTable" class="fade-in">
                        <thead>
                            <tr>
                                <th>Goods</th>
                                <th>Reporting Date</th>
                                <th>Place</th>
                                <th>Type</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>    
                            <?php foreach ($rows as $row) : ?>
                                <tr data-id="<?php echo htmlspecialchars($row['id']); ?>">
                                    <td>
                                        <img src="../../img/goodspict/<?php echo htmlspecialchars($row['gambar']); ?>">
                                        <p><?php echo htmlspecialchars($row['namaBarang']); ?></p>
                                    </td>
                                    <td> <?php echo htmlspecialchars($row['reporting_date']); ?> </td>
                                    <td><?php echo htmlspecialchars($row['tempat']); ?></td>
                                    <td><?php echo htmlspecialchars($row['jenisBarang']); ?></td>
                                    <td><?php echo htmlspecialchars($row['deskripsi']); ?></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <!-- Modal ketika setiap barang ditekan -->
                <?php include "../../partials/modal.php" ?>
            <!-- Modal -->
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    

    <script src="../script.js"></script>

    <!-- Feathericons -->
    <script>
        feather.replace();
    </script>
</body>
</html>
