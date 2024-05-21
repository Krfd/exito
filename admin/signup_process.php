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
            if(password_verify($password, $getRow['password'])) {
                if($password = $getRow['password']){
                $_SESSION['id'] = $getRow['id'];
                    echo "success";
                } else {
                    echo "invalid";
                }
            }
            echo "invalid";
        }
        else {
            // echo "no account";
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