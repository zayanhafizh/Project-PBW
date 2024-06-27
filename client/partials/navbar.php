<?php 
    define( 'BASEURL', 'http://localhost/fixSiPencari/client/index.php');
?>
<nav>
    <i class='bx bx-menu'></i>
    <a href="#" class="nav-link">Categories</a>
    <form action="<?= BASEURL  ?>" method="POST">
        <div class="form-input">
            <input type="search" placeholder="Search..." name="keyword">
            <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
        </div>
    </form>
    <input type="checkbox" id="switch-mode" hidden>
    <label for="switch-mode" class="switch-mode"></label>
    <a href="#" class="profile" onclick="toggleProfileBox()">
        <i data-feather="user" id="img-navbar"></i> 
    </a>
    <div id="profileBox" class="profile-box" >
        <p><strong><?= $_SESSION["nim"]  ?></strong></p>
        <p><?= $_SESSION["username"] ?></p>
    </div>
</nav>

<script>
    function toggleProfileBox() {
        var profileBox = document.getElementById('profileBox');
        if (profileBox.style.display === 'none') {
            profileBox.style.display = 'flex';
        } else {
            profileBox.style.display = 'none';
        }
    }
</script>
