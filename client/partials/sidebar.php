<?php 

	define('BASE_URL', 'http://localhost/fixSiPencari/client/');
	define('LOGOUT_URL','http://localhost/fixSiPencari/logout/logout.php');

	// Mengambil path dari URL
	$path = $_SERVER['REQUEST_URI'];
	$path_segments = explode('/',$path);

	// Mengambil segmen ke-4 dari path (jika ada)
	$path = isset($path_segments[4]) ? $path_segments[4] : '';
?>
<section id="sidebar">

	<a href= "<?= BASE_URL  ?>" class="brand">
		<i class='bx bxs-smile'></i>
		<span class="text">siPencari</span>
	</a> 
	<ul class="side-menu top">
		<ul class="menu-top">
			<li class="first-menu-top <?php echo ($path === 'baranghilang') ? 'active' : ''; ?>">	
				<a href="#" class="category-menu">
					<i class='bx bxs-package' class="menu-top-svg"></i>
					<span>Barang Hilang</span>
				</a>
				<div class="slider">
					<ul>
						<li>
						<a href="<?= BASE_URL ?>category/baranghilang/all.php">
								<i class='bx bxs-grid-alt'></i>
								<span>ALL</span>
							</a>
						</li>
						<li>
							<a href="<?= BASE_URL ?>category/baranghilang/aksesoris.php">
								<i class='bx bx-glasses'></i>
								<span>Aksesoris</span>
							</a>
						</li>
						<li>
							<a href="<?= BASE_URL ?>category/baranghilang/alattulis.php">
								<i class='bx bx-book-alt'></i>
								<span>Alat tulis</span>
							</a>
						</li>
						<li>
							<a href="<?= BASE_URL ?>category/baranghilang/elektronik.php">
								<i class='bx bx-headphone'></i>
								<span>Elektronik</span>
							</a>
						</li>
						<li>
							<a href="<?= BASE_URL ?>category/baranghilang/lainnya.php">
								<i class='bx bx-wallet'></i>
								<span>Lainnya</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="second-menu-top <?php echo ($path === 'barangtemuan') ? 'active' : ''; ?>">
				<a href="#" class="category-menu">
					<i class='bx bxl-dropbox'></i>
					<span>Barang Temuan</span>
				</a>
				<div class="slider">
				<ul>
						<li>
						<a href="<?= BASE_URL ?>category/barangtemuan/all.php">
								<i class='bx bxs-grid-alt'></i>
								<span>ALL</span>
							</a>
						</li>
						<li>
							<a href="<?= BASE_URL ?>category/barangtemuan/aksesoris.php">
								<i class='bx bx-glasses'></i>
								<span>Aksesoris</span>
							</a>
						</li>
						<li>
							<a href="<?= BASE_URL ?>category/barangtemuan/alattulis.php">
								<i class='bx bx-book-alt'></i>
								<span>Alat tulis</span>
							</a>
						</li>
						<li>
							<a href="<?= BASE_URL ?>category/barangtemuan/elektronik.php">
								<i class='bx bx-headphone'></i>
								<span>Elektronik</span>
							</a>
						</li>
						<li>
							<a href="<?= BASE_URL ?>category/barangtemuan/lainnya.php">
								<i class='bx bx-wallet'></i>
								<span>Lainnya</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="third-menu-top <?php echo ($path === 'laporansaya') ? 'active' : ''; ?>">	
				<a href="#" class="category-menu">
					<i class='bx bxs-megaphone' id="menu-top-svg"></i>
					<span>Laporan Saya</span>
				</a>
				<div class="slider">
					<ul>
						<li>
							<a href="<?= BASE_URL ?>category/laporansaya/baranghilang.php">
								<i class='bx bxs-package'></i>
								<span>Barang Hilang</span>
							</a>
						</li>
						<li>
						<a href="<?= BASE_URL ?>category/laporansaya/barangtemuan.php">
								<i class='bx bxl-dropbox' ></i>
								<span>Barang Temuan</span>
							</a>
						</li>
					</ul>
				</div>
			</li>
			<li>
				<a href="<?= BASE_URL  ?>add">
					<i class='bx bx-list-plus'></i>
					<span>Tambah Barang</span>
				</a>
			</li>
		</ul>
	</ul>
	<ul class="side-menu" id="menu-top">
		<li>
			<a href="<?= LOGOUT_URL ?>" class="logout">
				<i class='bx bxs-log-out-circle' ></i>
				<span class="text">Logout</span>
			</a>
		</li>
	</ul>
</section>