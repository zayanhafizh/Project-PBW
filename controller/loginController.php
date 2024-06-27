<?php 
define('ADMIN_URL', 'http://localhost/fixSiPencari/admin/');
define('CLIENT_URL', 'http://localhost/fixSiPencari/client/');
define('LOGIN_URL', 'http://localhost/fixSiPencari/login/');

session_start();
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Autentikasi User
    $stmt = $conn->prepare("SELECT * FROM user WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        if (password_verify($password, $row["password"])) {
            session_regenerate_id(true);
            $_SESSION["login"] = true;
            $_SESSION["id_user"] = $row['id_user'];
            $_SESSION["username"] = $row['username'];
            $_SESSION["nim"] = $row['nim'];

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
