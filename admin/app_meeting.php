<?php

include("../config.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Scheduled Appointment</title>
    <?php include("layout/header.php"); ?>
</head>

<body>
    <div class="wrapper">
        <?php include("sidebar.php"); ?>
        <div class="main px-5 py-3">
            <h1 class="fw-bold display-1">Schedule of Meeting</h1>
            <div class="table-responsive h-100">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Email</th>
                            <th>Inquired</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $res = $conn->prepare("SELECT * FROM meeting WHERE is_declined = 0");
                            $res->execute();

                            $book = $res->fetchAll(PDO::FETCH_ASSOC);

                            if($res->rowCount() > 0) {
                                foreach($book as $req) {
                                    $id = $req['id'];
                                    $name = $req['name'];
                                    $phone = $req['phone'];
                                    $date = $req['day'];
                                    $time = $req['time_slot'];
                                    $email = $req['email'];
                                    $created = $req['created'];

                                    $date = date('M. d, Y - D', strtotime($date));
                                    $time = date('h:i A', strtotime($time));
                                    $created = date('M. d, Y - h:i A', strtotime($created));
                                    echo
                                    '<tr>
                                        <td>'.$id.'</td>
                                        <td>'.$name.'</td>
                                        <td>'.$phone.'</td>
                                        <td>'.$date.'</td>
                                        <td>'.$time.'</td>
                                        <td>'.$email.'</td>
                                        <td>'.$created.'</td>
                                        <td>
                                        <a href="#" class="delete_sched text-white" data-id='.$id.'><button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button></a>
                                        </td>
                                    </tr>';
                                }
                            } else {
                                echo 
                                '<tr>
                                    <td colspan="10" class="text-center"><i>No Declined Request.</i></td>
                                </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
    <script src="js/time.js"></script>
    <script src="js/delete_sched.js"></script>
    <?php include("layout/script.php"); ?>
</body>
</html>