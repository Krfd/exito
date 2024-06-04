<?php

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
$email = htmlspecialchars($_POST['email']);
$old_pass = htmlspecialchars($_POST['old_pass']);
$new_pass = htmlspecialchars($_POST['new_pass']);
$confirm_pass = htmlspecialchars($_POST['confirm_pass']);
$key = htmlspecialchars($_POST['key']);
$token = hash_hmac('sha256', 'for update', $key);

$provided_password = !empty($old_pass) || !empty($new_pass);

try {

    if($provided_password) {
        $pass = $conn->prepare("SELECT password FROM admin WHERE id = :id");
        $pass->bindParam(":id", $id);
        $pass->execute();

        $hashed_password = $pass->fetchColumn();

        if(!password_verify($old_pass, $hashed_password)) {
            echo "invalid password";
        }

        if($new_pass != $confirm_pass) {
            echo "unmatched";
        }

        $hash_new_password = password_hash($new_pass, PASSWORD_DEFAULT);
    }

    $query = "UPDATE admin SET name = :name, email = :email";

    if($provided_password) {
        $query .= ", password = :password";
    }

    $update .= " WHERE id = :id";

    $query = $conn->prepare($query);
    $query->bindParam(":id", $id);
    $query->bindParam(":email", $email);
    
    if($provided_password) {
        $query->bindParam(":password", $hash_new_password);
    }
    $query->execute();

    echo "success";
} catch(PDOException $e) {
    echo "error: " . $e->getMessage();
}