<?php 
    session_start();
    session_unset();  // Menghapus semua variabel sesi
    session_destroy(); // Menghancurkan sesi
    define('BASE_URL','http://localhost/fixSiPencari/login/');
    header("Location: ".BASE_URL);
    exit; // Pastikan skrip berhenti setelah redireksi
?>
