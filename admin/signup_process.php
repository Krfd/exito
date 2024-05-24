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

$uname = htmlspecialchars($_POST['uname']);
$email = htmlspecialchars($_POST['email']);
$password = htmlspecialchars($_POST['password']);
$hashed_password = password_hash($password, PASSWORD_DEFAULT);
$confirm = htmlspecialchars($_POST['confirm']);
$key = htmlspecialchars($_POST['key']);
$token = hash_hmac('sha256', 'For login', $key);

if($password == $confirm) {
    try {
        $stmt = $conn->prepare("SELECT * FROM admin WHERE email = :email");
        $stmt->bindParam(":email", $email);
        $stmt->execute();

        $getRow = $stmt->fetch(PDO::FETCH_ASSOC);

        if(hash_equals($token, $_POST['token'])) {
            if($stmt->rowCount() == 1) {
                echo "exists";
            } else {
                $register = $conn->prepare("INSERT INTO admin (name, email, password) VALUES (:name, :email, :password)");
                $register->bindParam(":name", $uname);
                $register->bindParam(":email", $email);
                $register->bindParam(":password", $hashed_password);
                $register->execute();
                echo "success";
            }
        } else {
            echo "invalidcsrf";
        }
    } catch(PDOException $e) {
        echo "error: " . $e->getMessage();
    }
} else {
    echo "unmatched";
}