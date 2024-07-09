<?php
// Include your database connection code here
ini_set('display_errors', 1);
error_reporting(E_ALL);
// Database connection parameters
$dbHost = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "exito";
// Database configuration
// Create connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT MONTHNAME(DATE(created)) AS month, SUM(price) AS total FROM reservation WHERE MONTH(DATE(created)) = MONTH(DATE(created)) AND status = 'Done' GROUP BY MONTHNAME(DATE(created))";
$result = $conn->query($sql);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

$conn->close();

echo json_encode($data);
?>