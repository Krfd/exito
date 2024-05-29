<?php

include("config.php");

$name = htmlspecialchars($_POST['name']);
$phone = htmlspecialchars($_POST['phone']);
$email = htmlspecialchars($_POST['email']);
$guests = htmlspecialchars($_POST['guests']);
$date = htmlspecialchars($_POST['date']);
$time = htmlspecialchars($_POST['time']);
$price = htmlspecialchars($_POST['price']);
$message = htmlspecialchars($_POST['message']);
$key = htmlspecialchars($_POST['key']);
$token = hash_hmac('sha256', 'CSRF Booking Token', $key);
$status = "Pending";

try {
    if(hash_equals($token, $_POST['token'])) {
        // Error
        if($date <= date("Y-m-d")) {
            echo "invalidTime";
        } else {
            $book = $conn->prepare("INSERT INTO reservation (name, phone, email, guests, event_date, event_time, price, message, status) VALUES (:name, :phone, :email, :guests, :event_date, :event_time, :price, :message, :status)");
            $book->bindParam(':name', $name);
            $book->bindParam(':phone', $phone);
            $book->bindParam(':email', $email);
            $book->bindParam(':guests', $guests);
            $book->bindParam(':event_date', $date);
            $book->bindParam(':event_time', $time);
            $book->bindParam(':price', $price);
            $book->bindParam(':message', $message);
            $book->bindParam(':status', $status);
            $book->execute();

            if($book == TRUE) {
                echo "success";
            } else {
                echo "invalid";
            }
        }
    } else {
        echo "invalidcsrf";
    }
} catch(PDOException $error) {
    echo "error:" . $error->getMessage();
}