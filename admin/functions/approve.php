<?php
include("connect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../events/function/src/Exception.php';
require '../../events/function/src/PHPMailer.php';
require '../../events/function/src/SMTP.php';

if (isset($_GET['id'])) {
    $res_id = $_GET['id'];

    // Query for approving reservation
    $query_res = "SELECT * FROM reservation WHERE id = $res_id";
    $res = $conn->query($query_res);

    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $name = $row['name'];
        $phone = $row['phone'];
        $email = $row['email'];
        $guests = $row['guests'];
        $event_date = $row['event_date'];
        $event_time = $row['event_time'];
        $price = $row['price'];
        $event = $row['event'];

        $balance = $price - ($price / 2);
    }

    $reserve = "UPDATE reservation SET is_approve = 1, status = 'Approved' WHERE id = $id";
    $conn->exec($reserve);

    $check_status = "SELECT status FROM reservation WHERE id = $res_id";
    $onStatus = $conn->query($check_status);

    while($stat = $onStatus->fetch(PDO::FETCH_ASSOC)) {
        $status = $stat['status'];
    }

    $event_date = date('M. d, Y - D', strtotime($event_date));
    $event_time = date('h:i A', strtotime($event_time));

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

    $mail->Subject = "Reservation has been Approved";
    $mail->Body = "Hi <strong>$name</strong>! Thank you for your interest in <strong>Exito Catering Services</strong>. We would like to inform you that your reservation for $event has been approved.
    Please prepare your balance amounting to $balance upon the arrival of the manager and our team.<br><br>
                Here are the following details:
                <br><br>
                Name: $name <br>
                Contact Number: $phone <br>
                Email: $email <br>
                Event: $event <br>
                Number of Guests: $guests <br>
                Date: $event_date <br>
                Time: $event_time <br>
                Status: $status <br>
                Price: $price <br>
                Balance: <strong>$balance</strong> <br>
                <br><br><br>
                <strong>Note: There is an extra charge for any extra service that is not covered by the package.</strong>
                <br><br><br><strong>The management</strong>.";

    $mail->send();

    echo "success";
} else {
    echo "error";
}