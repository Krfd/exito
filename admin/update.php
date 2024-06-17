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

$id = htmlspecialchars($_POST['id']);
$old_pass = htmlspecialchars($_POST['old_pass']);
$new_pass = htmlspecialchars($_POST['new_pass']);
$confirm_pass = htmlspecialchars($_POST['confirm_pass']);
$key = htmlspecialchars($_POST['key']);
$token = hash_hmac('sha256', 'for update', $key);

$provided_password = !empty($old_pass) || !empty($new_pass);

try {
    if($new_pass != $confirm_pass) {
        echo "unmatched";
    } else {
        $pass = $conn->prepare("SELECT password FROM admin WHERE id = :id");
        $pass->bindParam(":id", $id);
        $pass->execute();

        $hashed_password = $pass->fetchColumn();

        if(!password_verify($old_pass, $hashed_password)) {
            echo "invalid password";
        } else {
            $hash_new_password = password_hash($new_pass, PASSWORD_DEFAULT);

            date_default_timezone_set("Asia/Manila");
            $day = date('Y-m-d');
            $time = date("h:i:s");

            $tstmp = $day . " " . $time;

            $query = "UPDATE admin SET password = :password, updated = :updated WHERE id = :id";
            $query = $conn->prepare($query);
            $query->bindParam(":id", $id);
            $query->bindParam(":password", $hash_new_password);
            $query->bindParam(":updated", $tstmp);
            $query->execute();

            echo "success";
        }
    }
} catch(PDOException $e) {
    echo "Error " . $e->getMessage();
}