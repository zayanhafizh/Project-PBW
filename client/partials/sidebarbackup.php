<?php 

	define('BASE_URL', 'https://sipencari.rfaridh.my.id/client/');
	define('LOGOUT_URL', 'https://sipencari.rfaridh.my.id/logout/logout.php');
	$current_page = basename($_SERVER['PHP_SELF']);

?>
<section id="sidebar">
	<a href= "<?= BASE_URL  ?>" class="brand">
		<i class='bx bxs-smile'></i>
		<span class="text">siPencari</span>
	</a> 
	<ul class="side-menu top">
		<li class="<?php echo ($current_page == 'index.php') ? 'active' : ''; ?>">
			<a href="<?= BASE_URL ?>">
				<i class='bx bxs-dashboard' ></i>
				<span class="text">Dashboard</span>
			</a>
		</li>
		<li class="<?php echo ($current_page == 'alattulis.php') ? 'active' : ''; ?>">
			<a href="<?= BASE_URL ?>category/alattulis.php">
				<i class='bx bxs-book-content'></i>
				<span class="text"> Alat Tulis</span>
			</a> 
		</li>
		<li class="<?php echo ($current_page == 'elektronik.php') ? 'active' : ''; ?>">
			<a href="<?= BASE_URL ?>category/elektronik.php">
				<i class='bx bx-headphone'></i>
				<span class="text">Elektronik</span>
			</a>
		</li>
		<li class="<?php echo ($current_page == 'aksesoris.php') ? 'active' : ''; ?>">
			<a href="<?= BASE_URL ?>category/aksesoris.php">
				<i class='bx bx-glasses'></i>
				<span class="text">Aksesoris</span>
			</a>
		</li>
		<li class="<?php echo ($current_page == 'lainnya.php') ? 'active' : ''; ?>">
			<a href="<?= BASE_URL ?>category/lainnya.php">
				<i class='bx bx-wallet'></i>
				<span class="text">Lainnya</span>
			</a>
		</li>
	</ul>
	<ul class="side-menu">
		<li>
			<a href="#">
				<i class='bx bxs-cog' ></i>
				<span class="text">Settings</span>
			</a>
		</li>
		<li>
			<a href="<?= LOGOUT_URL ?>" class="logout">
				<i class='bx bxs-log-out-circle' ></i>
				<span class="text">Logout</span>
			</a>
		</li>
	</ul>
</section>