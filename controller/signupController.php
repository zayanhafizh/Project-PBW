<?php 
require "functions.php";
define('LOGIN_URL','http://localhost/fixSiPencari/login/');

$validateInput = null;

$validateInput = register($_POST);

if ($validateInput === 1) {
    header('Location: '.LOGIN_URL);
    exit;
}


if (isset($_POST['login'])) {
    header('Location: login.php');
    exit;
}

?>