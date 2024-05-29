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

$name = htmlspecialchars($_POST['name']);
$phone = htmlspecialchars($_POST['phone']);
$date = htmlspecialchars($_POST['date']);
$time = htmlspecialchars($_POST['time']);
$time = date("h:i", strtotime($time));
$email = htmlspecialchars($_POST['email']);
$key = htmlspecialchars($_POST['key']);
$token = hash_hmac('sha256', 'this is for contact', $key);

try {
    if(hash_equals($token, $_POST['csrfToken'])) {
        // Error
        if($date <= date("Y-m-d")) {
            echo "invalidTimestamp";
        } else {

            $formatted_date = date("Y-m-d", strtotime($date));

            $max = $conn->prepare("SELECT * FROM meeting WHERE day = '$formatted_date' AND is_declined = 0");
            $max->execute();

            if($max->rowCount() > 3) {
                echo "full";
            } else {
                $val = $conn->prepare("SELECT * FROM meeting WHERE day = '$formatted_date' AND time_slot = TIME('$time') AND is_declined = 0");
                $val->execute();

                if($val->rowCount() > 1) {
                    echo "unavailable";
                } else {
                    $insert = $conn->prepare("INSERT INTO meeting (name, phone, day, time_slot, email) VALUES (:name, :phone, :day, :time_slot, :email)");
                    $insert->bindParam(":name", $name);
                    $insert->bindParam(":phone", $phone);
                    $insert->bindParam(":day", $date);
                    $insert->bindParam(":time_slot", $time);
                    $insert->bindParam(":email", $email);
                    $insert->execute();

                    if($insert == TRUE) {
                        echo "success";
                    } else {
                        echo "invalid";
                    }
                }
            }
        }
    } else {
        echo "invalidcsrf";
    }
} catch(PDOException $e) {
    echo "error: " . $e->getMessage();
}
