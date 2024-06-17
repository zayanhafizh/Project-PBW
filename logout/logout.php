<?php 
session_start();
session_abort();
session_destroy();
define('BASE_URL','http://localhost/fixSiPencari/login/');
header("Location: ".BASE_URL);
?>