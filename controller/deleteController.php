<?php
require 'functions.php'; // Ensure this file includes the database connection setup

// Sanitize and validate input
$id = filter_var($_GET['id'], FILTER_VALIDATE_INT);
$kategoriBarang = preg_replace('/[^a-zA-Z0-9_]/', '', htmlspecialchars($_GET['kat']));

// Define the LAPORAN_URL constant
define('LAPORAN_URL', 'http://localhost/fixSiPencari/client/category/laporansaya/' . $kategoriBarang . '.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement
$stmt = $conn->prepare("DELETE FROM $kategoriBarang WHERE id = ?");
$stmt->bind_param("i", $id); // Use 'i' for integer

if ($stmt->execute()) {
    header('Location: ' . LAPORAN_URL);
    exit(); // Ensure no further code is executed
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
