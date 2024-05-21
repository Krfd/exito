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

$old_pass = htmlspecialchars($_POST['old_pass']);
$new_pass = htmlspecialchars($_POST['new_pass']);
$confirm_pass = htmlspecialchars($_POST['confirm_pass']);
$key = htmlspecialchars($_POST['key']);
$token = hash_hmac('sha256', 'for update', $key);

try {
    $stmt = $conn->prepare("SELECT * FROM admin WHERE password = :password");
    $stmt->bindParam(":password", $password);
    $stmt->execute();

    $getRow = $stmt->fetch(PDO::FETCH_ASSOC);

    if($confirm_pass == $new_pass) {
        $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);
        if(hash_equals($token, $_POST['token'])) {
            if($stmt->rowCount() == 1) {
                if(password_verify($old_pass, $getRow['password'])) {
                    if($old_pass = $getRow['password']){
                    
                        $update = $conn->prepare("UPDATE admin SET password = $new_pass");
                        $update->exec($update);
                        
                        echo "success";
                    } else {
                        echo "error";
                    }
                }
                echo "invalid";
            }
            else {
                echo "invalid";
            }
        } else {
            echo "invalidcsrf";
        }
    } else {
        echo "unmatched";
    }
} catch(PDOException $e) {
    echo "error: " . $e->getMessage();
}