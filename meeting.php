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

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'events/function/src/Exception.php';
require 'events/function/src/PHPMailer.php';
require 'events/function/src/SMTP.php';

$name = htmlspecialchars($_POST['name']);
$phone = htmlspecialchars($_POST['phone']);
$date = htmlspecialchars($_POST['date']);
$time = htmlspecialchars($_POST['time']);
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
            $formatted_time = date("h:i", strtotime($time));

            $max = $conn->prepare("SELECT * FROM meeting WHERE day = '$formatted_date' AND is_declined = 0");
            $max->execute();

            if($max->rowCount() > 3) {
                echo "full";
            } else {
                $val = $conn->prepare("SELECT * FROM meeting WHERE day = '$formatted_date' AND time_slot = TIME('$formatted_time') AND is_declined = 0");
                $val->execute();

                if($val->rowCount() > 1) {
                    echo "unavailable";
                } else {
                    $insert = $conn->prepare("INSERT INTO meeting (name, phone, day, time_slot, email) VALUES (:name, :phone, :day, :time_slot, :email)");
                    $insert->bindParam(":name", $name);
                    $insert->bindParam(":phone", $phone);
                    $insert->bindParam(":day", $date);
                    $insert->bindParam(":time_slot", $formatted_time);
                    $insert->bindParam(":email", $email);
                    $insert->execute();

                    if($insert == TRUE) {

                        $date = date('M. j, Y - D', strtotime($date));
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

                        $mail->Subject = "Meeting Schedule - Exito Catering Services";
                        $mail->Body = "Hi <strong>$name</strong>! We have received your interest with us. 
                        This meeting will only take few minutes, enough to provide you all the necessary information you need to know about <strong>Exito Catering Services</strong>. In this meeting, we encourage our client to have a zoom as a communication tool, however, if you don't have this application we also support phone calls but make sure to keep your lines open.
                        <br><br>
                        
                        Meeting Schedule <br>
                        Date: <strong> $date </strong><br>
                        Time: <strong>$time</strong>
                        <br>
                        For confirmation and to ensure your interest with us, please reply to this email as an acknowledgement. <br>
                        Should you have any concern, please don't hesitate to ask.
                        <br><br><br>
                        However, if you find this email unnecessary, please ignore this email. <br><br><br><strong>The management</strong>.";

                        $mail->send();

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
