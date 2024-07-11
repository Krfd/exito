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

$sql = "SELECT MONTHNAME(DATE(date_approved)) AS clients, COUNT(id) AS total FROM reservation WHERE MONTH(DATE(date_approved)) = MONTH(DATE(date_approved)) AND status = 'Fully Paid' GROUP BY MONTH(DATE(date_approved)) ASC";
$result = $conn->query($sql);

$data = array();
foreach ($result as $row) {
    $data[] = $row;
}

$conn->close();

echo json_encode($data);
?>