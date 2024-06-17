<?php

include("config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$name = htmlspecialchars($_POST['name']);
$phone = htmlspecialchars($_POST['phone']);
$email = htmlspecialchars($_POST['email']);
$guests = htmlspecialchars($_POST['guests']);
$date = htmlspecialchars($_POST['date']);
$time = htmlspecialchars($_POST['time']);
$price = htmlspecialchars($_POST['price']);
$message = htmlspecialchars($_POST['message']);
$event = htmlspecialchars($_POST['event']);
$key = htmlspecialchars($_POST['key']);
$token = hash_hmac('sha256', 'CSRF Booking Token', $key);
$status = "Pending";

try {
    if(hash_equals($token, $_POST['token'])) {
        // Error
        if($date <= date("Y-m-d")) {
            echo "invalidTime";
        } else {
            $book = $conn->prepare("INSERT INTO reservation (name, phone, email, guests, event_date, event_time, price, message, event, status) VALUES (:name, :phone, :email, :guests, :event_date, :event_time, :price, :message, :event, :status)");
            $book->bindParam(':name', $name);
            $book->bindParam(':phone', $phone);
            $book->bindParam(':email', $email);
            $book->bindParam(':guests', $guests);
            $book->bindParam(':event_date', $date);
            $book->bindParam(':event_time', $time);
            $book->bindParam(':price', $price);
            $book->bindParam(':message', $message);
            $book->bindParam(':event', $event);
            $book->bindParam(':status', $status);
            $book->execute();

            if($book == TRUE) {

                $date = date('M. d, Y - D', strtotime($date));
                $time = date('h:i A', strtotime($time));

                $mail = new PHPMailer(true);

                $mail->isSMTP();
                $mail->Host =  'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = "alexa.nexgen08@gmail.com";
                $mail->Password = "rehslxlczvpfjdoi";
                $mail->SMTPSecure = "ssl";
                $mail->Port = 465;

                $mail->setFrom("alexa.nexgen08@gmail.com");

                $mail->AddAddress($email);
                $mail->isHTML(true);

                $mail->Subject = $event;
                $mail->Body = "Hi <strong>$name</strong>! Thank you for your interest in <strong>Exito Catering Services</strong>. We have received reservation. 
                To secure your booking, we request you to send us the 50% down payment via GCASH <strong>0977-754-3056</strong> and send us a copy (screenshot) of receipt.<br><br>
                Here are the following details:
                <br><br>
                Name: $name <br>
                Contact Number: $phone <br>
                Email: $email <br>
                Event: $event <br>
                Number of Guests: $guests <br>
                Date: $date <br>
                Time: $time <br>
                Price: $price <br>
                Message: $message 
                <br><br><br>
                <strong>Note: As a part of your transaction, We encourage you to prepare your balance on the day of the event.</strong>
                <br><br><br>
                However, if you did not book this reservation, we require your immediate response to this email. <br><br><br><strong>The management</strong>.";

                $mail->send();

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