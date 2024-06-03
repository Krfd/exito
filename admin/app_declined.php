<?php

include("../config.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Declined Appointment</title>
    <?php include("layout/header.php"); ?>
</head>

<body>
    <div class="wrapper">
        <?php include("sidebar.php"); ?>
        <div class="main px-5 py-3">
            <h1 class="fw-bold display-1">Declined Meeting</h1>
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
                            $res = $conn->prepare("SELECT * FROM meeting WHERE is_declined = 1");
                            $res->execute();

                            $book = $res->fetchAll(PDO::FETCH_ASSOC);

                            if($res->rowCount() > 0) {
                                foreach($book as $req) {
                                    $id = $req['id'];
                                    $name = $req['name'];
                                    $phone = $req['phone'];
                                    $day = $req['day'];
                                    $email = $req['email'];
                                    $inquired = $req['created'];

                                    $day = date('M. d, Y - D', strtotime($day = $req['day']));
                                    $hr = date('h:i A', strtotime($hr = $req['time_slot']));
                                    $inquired = date('M. d, Y - h:i A');

                                    echo
                                    '<tr>
                                        <td>'.$id.'</td>
                                        <td>'.$name.'</td>
                                        <td>'.$phone.'</td>
                                        <td>'.$day.'</td>
                                        <td>'.$hr.'</td>
                                        <td>'.$email.'</td>
                                        <td>'.$inquired.'</td>
                                        <td>
                                        <a href="#" class="restore_app text-white" data-id='.$id.'><button type="button" class="btn btn-success"><i class="fa-solid fa-recycle"></i></button></a>
                                        <a href="#" class="delete_app text-white" data-id='.$id.'><button type="button" class="btn btn-danger mt-1 mt-lg-0"><i class="fa-solid fa-trash"></i></button></a>
                                        </td>
                                    </tr>';
                                }
                            } else {
                                echo 
                                '<tr>
                                    <td colspan="10" class="text-center"><i>No declined schedule of meeting.</i></td>
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
    <script src="js/app_restore.js"></script>
    <script src="js/app_delete.js"></script>
    <?php include("layout/script.php"); ?>
</body>
</html>