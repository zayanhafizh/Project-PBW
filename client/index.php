<?php 
require '../controller/functions.php';

define('LOGIN_URL', 'https://sipencari.rfaridh.my.id/login/');

session_start();

// Check session
if (!isset($_SESSION["login"])) {
    header("Location: ".LOGIN_URL);
    exit;
}

// Fetch data from database
$rows = query("SELECT * FROM user INNER JOIN baranghilang ON user.id_user = baranghilang.id_user");
$barangHilang = query('SELECT * FROM baranghilang');
$user = query('SELECT * FROM user');
$barangTemuan = query('SELECT * FROM barangtemuan');

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
    <link rel="stylesheet" href="style.css">

    <title>siPencari</title>
</head>
<body>

    <!-- SIDEBAR -->
    <?php include "partials/sidebar.php"; ?>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <?php include "partials/navbar.php"; ?>
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
                        <li><i class='bx bx-chevron-right'></i></li>
                        <li>
                            <a class="active" href="#">Home</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Box info -->
            <?php include "partials/boxinfo.php"; ?>
            <!-- Box info -->

            <div class="table-data">
                <div class="order">
                    <div class="head">
                        <h3>Recent Report</h3>
                        <!-- Search Box -->
                        <div class="search-box" id="search-box">
                            <form method="post">
                                <input type="search" placeholder="Search..." class="search-box-input" id="input-report">
                            </form>
                        </div>
                        <!-- /Search Box -->
                        <i class='bx bx-search' id="search-icon"></i>
                        <i class='bx bx-filter'></i>
                    </div>
                    <div id="tbody-replace">
                        <table id="myTable" class="fade-in">
                            <thead>
                                <tr>
                                    <th>Goods</th>
                                    <th>Reporting Date</th>
                                    <th>Type</th>
                                    <th>Place</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $row) : ?>
                                    <tr class="item" data-id="<?= htmlspecialchars($row['id']); ?>"
										data-namabarang="<?php echo htmlspecialchars($row['namaBarang']); ?>"
                                        data-deskripsi="<?php echo htmlspecialchars($row['deskripsi']); ?>"
                                        data-email="<?php echo htmlspecialchars($row['email']); ?>">
                                        <td>
                                            <img src="img/goodspict/<?= $row['gambar'] ?>" alt="<?= htmlspecialchars($row['namaBarang']); ?>">
                                            <p><?= htmlspecialchars($row['namaBarang']); ?></p>
                                        </td>
                                        <td ><?= htmlspecialchars($row['reporting_date']); ?></td>
                                        <td><?= htmlspecialchars($row['tempat']); ?></td>
                                        <td><?= htmlspecialchars($row['jenisBarang']); ?></td>
                                        <td><?= htmlspecialchars($row['deskripsi']); ?></td>
                                        <td><span class="status completed">Completed</span></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Modal for each item -->
            <?php include "partials/modal.php"; ?>
            <!-- Modal -->
        </main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->

    <script src="script.js"></script>

    <!-- Feathericons -->
    <script>
        feather.replace();
    </script>
</body>
</html>
