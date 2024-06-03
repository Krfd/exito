<?php

include("../config.php");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <?php include("layout/header.php"); ?>
</head>

<body>
    <div class="wrapper">
        <?php include("sidebar.php"); ?>
        <div class="main px-5 py-3">
            <h1 class="fw-bold display-1">Client Records</h1>
            <div class="table-responsive h-100">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Email</th>
                            <th>No. Guests</th>
                            <th>Schedule</th>
                            <th>Price</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $res = $conn->prepare("SELECT * FROM reservation WHERE status = 'Done'");
                            $res->execute();

                            $book = $res->fetchAll(PDO::FETCH_ASSOC);

                            if($res->rowCount() > 0) {
                                foreach($book as $req) {
                                    $id = $req['id'];
                                    $name = $req['name'];
                                    $phone = $req['phone'];
                                    $email = $req['email'];
                                    $guests = $req['guests'];
                                    $price = $req['price'];
                                    $status = $req['status'];

                                    $day = date('M. d, Y - D', strtotime($day = $req['event_date']));
                                    $hr = date('h:i A', strtotime($hr = $req['event_time']));

                                    echo 
                                    '<tr>
                                        <td>'.$id.'</td>
                                        <td>'.$name.'</td>
                                        <td>'.$phone.'</td>
                                        <td>'.$email.'</td>
                                        <td>'.$guests.'</td>
                                        <td>'.$hr . '<span class="ms-3">'. $day .' </span> '.'</td>
                                        <td>'.$price.'</td>
                                        <td><span class="badge bg-success">'.$status.'</span></td>
                                    </tr>';
                                }
                            } else {
                                echo 
                                '<tr>
                                    <td colspan="10" class="text-center"><i>No finished transaction.</i></td>
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
    <?php include("layout/script.php"); ?>
</body>

</html>