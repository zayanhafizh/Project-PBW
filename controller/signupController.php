<?php 
require "functions.php";
define('LOGIN_URL', 'https://sipencari.rfaridh.my.id/login/');
session_start();

$validateInput = null;

$validateInput = register($_POST);
if ($validateInput === 1) {
    header('Location: '.LOGIN_URL);
    exit;
} else {
    header('Location: '.LOGIN_URL);
    $_SESSION['error_signup'] = false;
    exit;
}


// if (isset($_POST['login'])) {
//     header('Location: login.php');
//     exit;
// }

?>