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
            <h1 class="fw-bold display-1">Reservation</h1>
            <hr>
            <div class="table-responsive">
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
                            <th>Message</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $res = $conn->prepare("SELECT * FROM reservation WHERE status = 'Pending'");
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
                                    $message = $req['message'];
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
                                        <td>'.$message.'</td>
                                        <td class="dropdown">
                                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown">'.$status.'</button>
                                            <div class="dropdown-menu">
                                                <li class="px-1">
                                                    <button type="button" class="btn btn-sm rounded text-center bg-primary dropdown-item"><a href="#" class="text-white text-center text-decoration-none approve_req" data-id='.$id.'>Approve</a></button>
                                                </li>
                                                <li class="px-1 mt-1">
                                                    <button type="button" class="btn btn-sm rounded text-center bg-danger dropdown-item"><a href="#" class="text-white text-center text-decoration-none decline_req" data-id='.$id.'>Decline</a></button>
                                                </li>
                                            </div>
                                        </td>
                                    </tr>';
                                }
                            } else {
                                echo 
                                '<tr>
                                    <td colspan="10" class="text-center"><i>No Pending Request</i></td>
                                </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
        crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <script src="js/time.js"></script>
    <script src="js/approve.js"></script>
    <script src="js/decline.js"></script>
    <?php include("layout/script.php"); ?>
</body>

</html>