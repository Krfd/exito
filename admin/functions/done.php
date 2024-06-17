<?php
include("connect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../events/function/src/Exception.php';
require '../../events/function/src/PHPMailer.php';
require '../../events/function/src/SMTP.php';

if (isset($_GET['id'])) {
    $res_id = $_GET['id'];

    // Query for restoring reservation
    $query_res = "SELECT * FROM reservation WHERE id = $res_id";
    $res = $conn->query($query_res);

    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
        $name = $row['name'];
        $email = $row['email'];
    }

    $reserve = "UPDATE reservation SET is_approve = 0, status = 'Done' WHERE id = $id";
    $conn->exec($reserve);

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

    $mail->Subject = "Transaction - Done";
    $mail->Body = "Hi <strong>$name</strong>, we would like to express our gratitude for trusting <strong>Exito Catering Services</strong>.
    We hope we brought your special occasion into another level as you celebrate with us! We hope we served you well. 
    <br><br>Furthermore, if you have any feedback with our service please feel free to leave it here as it will help us to make our service even better.<br><br>
    <br><br><br>
    Thank you,
    <br><strong>The Management</strong>";

    $mail->send();

    echo "success";
} else {
    echo "error";
}