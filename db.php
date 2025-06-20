<?php
// db.php - MySQL connection file for FitFusion

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'fitfusion';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
