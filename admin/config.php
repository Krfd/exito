<?php

session_start();

$db = "mysql:host=localhost;dbname=exito";
$username = "root";
$password = "";

try {
    $conn = new PDO($db, $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

function redirect($location) {
    header("location: $location");
    exit();
}

$admin_id = htmlspecialchars($_SESSION['id']);

try {
    $admin = $conn->prepare("SELECT * FROM admin WHERE id = :id");
    $admin->bindParam(":id", $admin_id);
    $admin->execute();

    $row = $admin->fetch(PDO::FETCH_ASSOC);
    $admin_id = $row['id'];
    $name = $row['name'];
    $email = $row['email'];
    $created = $row['created'];
    $updated = $row['updated'];
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if(isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    redirect('login.php');
    exit();
}