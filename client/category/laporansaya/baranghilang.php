<?php 
require '../../../controller/functions.php';

session_start();

$barangHilang = query('SELECT * FROM baranghilang');
$user = query('SELECT * FROM user');
$barangTemuan = query('SELECT * FROM barangtemuan');

$countUser = count($user);
$countLostGoods = count($barangHilang);
$countDiscoverGoods = count($barangTemuan);

$id_user = $_SESSION['id_user'];

$rows = query("SELECT * FROM baranghilang WHERE id_user = $id_user");


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
								<th>Tempat Hilang</th>
								<th>Description</th>
								<th>Status</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>	
							<?php foreach( $rows as $row ) :?>
								<tr data-id="<?php echo htmlspecialchars($row['id']); ?>">
									<td>
										<img src="../../img/goodspict/<?= $row['gambar'] ?>">
										<p><?= $row['namaBarang'] ?></p>
									</td>
									<td> <?= $row['reporting_date'] ?> </td>
									<td><?= $row['tempat'] ?></td>
									<td><?= $row['deskripsi'] ?></td>
									<?php 
										if ($row['flag'] == false) {
											$flag = "Belum Ditemukan";
											$flagClass = "belumditemukan";
										} else {
											$flag = "Sudah Ditemukan";
											$flagClass = "sudahditemukan";
										}
									?>
									<td><span class="status <?=$flagClass  ?>"><?= $flag;   ?></span></td>
									<td class="button-edit">
										<button class="edit-button">
											<i data-feather="edit"></i>
										</button>
										<button class="delete-button">
											<i data-feather="trash"></i>
										</button>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
			<?php include "modal.php"; ?>
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