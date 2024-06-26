<?php 
define('ADMIN_URL', 'https://sipencari.rfaridh.my.id/admin/');
define('CLIENT_URL', 'https://sipencari.rfaridh.my.id/client/');
define('LOGIN_URL', 'https://sipencari.rfaridh.my.id/login/');

session_start();
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Autentikasi Admin
    if ($username === "admin" && $password === "adminganteng") {
        session_regenerate_id(true);
        $_SESSION["login"] = true;
        header("Location: " . ADMIN_URL);
        exit;
    }

    // Autentikasi User
    $stmt = $conn->prepare("SELECT id_user, username, password FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            session_regenerate_id(true);
            $_SESSION["login"] = true;
            $_SESSION["id_user"] = $row['id_user'];

            if (isset($_POST["remember"])) {
                $session_id = session_id();
                $cookie_value = $row['username'];
                setcookie('username', $cookie_value, time() + 3600, "/", "", true, true); // Menyimpan username dalam cookie
                setcookie('session_id', $session_id, time() + 3600, "/", "", true, true); // Menyimpan ID sesi dalam cookie
            }
            header("Location: " . CLIENT_URL);
            exit;
        } else {
            $_SESSION['error'] = "Invalid username or password";
        }
    } else {
        $_SESSION['error'] = "Invalid username or password";
    }

    header("Location: " . LOGIN_URL);
    exit;
}
?>
