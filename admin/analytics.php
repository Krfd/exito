<?php

include("config.php");

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
            <h1 class="fw-bold display-1">Analytics</h1>
            <br>
            <div class="d-md-flex gap-3">
                <div class="col shadow-sm p-3 d-flex border-start border-success border-5 rounded-3">
                    <div class="col mr-2">
                        <div class="text-success fw-bold mb-1">Total Clients</div>
                        <div class="fw-bold mb-0">
                            <?php

                            $total = $conn->prepare("SELECT COUNT(id) FROM reservation WHERE status = 'Done'");
                            $total->execute();

                            $totalBooked = $total->fetch(PDO::FETCH_ASSOC);
                            echo $totalBooked['COUNT(id)'];

                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-bookmark fa-3x text-secondary"></i>
                    </div>
                </div>
                <div class="col shadow-sm p-3 d-flex border-start border-primary border-5 rounded-3 mt-3 mt-md-0">
                    <div class="col mr-2">
                        <div class="text-primary fw-bold mb-1">Approved</div>
                        <div class="fw-bold mb-0">
                            <?php

                            $total = $conn->prepare("SELECT COUNT(id) FROM reservation WHERE status = 'Approved'");
                            $total->execute();

                            $totalBooked = $total->fetch(PDO::FETCH_ASSOC);
                            echo $totalBooked['COUNT(id)'];

                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-clipboard-check fa-3x text-secondary"></i>
                    </div>
                </div>
                <div class="col shadow-sm p-3 d-flex border-start border-warning border-5 rounded-3 mt-3 mt-md-0">
                    <div class="col mr-2">
                        <div class="text-warning fw-bold mb-1">Pending</div>
                        <div class="fw-bold mb-0">
                            <?php

                            $total = $conn->prepare("SELECT COUNT(id) FROM reservation WHERE status = 'Pending'");
                            $total->execute();

                            $totalBooked = $total->fetch(PDO::FETCH_ASSOC);
                            echo $totalBooked['COUNT(id)'];

                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-clock fa-3x text-secondary"></i>
                    </div>
                </div>
                <div class="col shadow-sm p-3 d-flex border-start border-danger border-5 rounded-3 mt-3 mt-md-0">
                    <div class="col mr-2">
                        <div class="text-danger fw-bold mb-1">Declined</div>
                        <div class="fw-bold mb-0">
                            <?php

                            $total = $conn->prepare("SELECT COUNT(id) FROM reservation WHERE status = 'Declined'");
                            $total->execute();

                            $totalBooked = $total->fetch(PDO::FETCH_ASSOC);
                            echo $totalBooked['COUNT(id)'];

                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-thumbs-down fa-3x text-secondary"></i>
                    </div>
                </div>
            </div>
            <div class="d-md-flex gap-3 mt-3">
                <div class="col shadow-sm p-3 d-flex border-start border-primary-subtle border-5 rounded-3">
                    <div class="col mr-2">
                        <div class="text-primary-emphasis fw-bold mb-1">Total Earnings</div>
                        <div class="fw-bold mb-0">
                            <?php

                            $total = $conn->prepare("SELECT SUM(price) FROM reservation WHERE status = 'Done'");
                            $total->execute();

                            $totalBooked = $total->fetch(PDO::FETCH_ASSOC);
                            echo "₱ ". substr($totalBooked['SUM(price)'], 0, 3) . ","  . substr($totalBooked['SUM(price)'], 3);

                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-peso-sign fa-3x text-secondary"></i>
                    </div>
                </div>
                <div class="col shadow-sm p-3 d-flex border-start border-success-subtle border-5 rounded-3 mt-3 mt-md-0">
                    <div class="col mr-2">
                        <div class="text-success-emphasis fw-bold mb-1">Monthly Earnings</div>
                        <div class="fw-bold mb-0">
                            <?php

                            $month = date('n');

                            $total = $conn->prepare("SELECT SUM(price) FROM reservation WHERE MONTH(CURDATE()) = '$month' AND status = 'Done'");
                            $total->execute();

                            $monthlyTotal = $total->fetch(PDO::FETCH_ASSOC);
                            echo "₱ ". substr($monthlyTotal['SUM(price)'], 0, 3) . ","  . substr($monthlyTotal['SUM(price)'], 3);

                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-calendar fa-3x text-secondary"></i>
                    </div>
                </div>
                <div class="col shadow-sm p-3 d-flex border-start border-info-subtle border-5 rounded-3 mt-3 mt-md-0">
                    <div class="col mr-2">
                        <div class="text-info-emphasis fw-bold mb-1">Weekly Earnings</div>
                        <div class="fw-bold mb-0">
                            <?php

                            $query = $conn->prepare("SELECT created FROM reservation WHERE status = 'Done' OR status = 'Approved'");
                            $query->execute();

                            $fetch_date = $query->fetch(PDO::FETCH_ASSOC);

                            foreach($fetch_date as $weekly['created']) {
                                $week = $weekly['created'];
                                $wk = date("Y-m-d", strtotime($week));
                                echo $wk;

                                echo "<br>";

                                var_dump($week);

                                echo "<br>";
                            }

                            $total = $conn->prepare("SELECT SUM(price) FROM reservation WHERE WEEKOFYEAR(CURRENT_DATE()) = WEEK(CURDATE()) AND status = 'Done'  OR status = 'Approved'");
                            $total->execute();

                            $weeklyTotal = $total->fetch(PDO::FETCH_ASSOC);
                            echo $weeklyTotal['SUM(price)'];


                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-calendar-week fa-3x text-secondary"></i>
                    </div>
                </div>
                <div class="col shadow-sm p-3 d-flex border-start border-warning-subtle border-5 rounded-3 mt-3 mt-md-0">
                    <div class="col mr-2">
                        <div class="text-warning fw-bold mb-1">Pending Payments</div>
                        <div class="fw-bold mb-0">
                            <?php

                            $total = $conn->prepare("SELECT SUM(price) FROM reservation WHERE is_approve = 1 AND status = 'Approved'");
                            $total->execute();

                            $totalBooked = $total->fetch(PDO::FETCH_ASSOC);
                            $pending = $totalBooked['SUM(price)'] / 2;
                            echo "₱ ". substr($pending, 0, 3) . ","  . substr($pending, 3);

                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-hourglass-half fa-3x text-secondary"></i>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <div class="table-responsive h-100">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $set = $conn->prepare("SELECT id, name, email, status, created FROM reservation");
                            $set->execute();
                            
                            if($set->rowCount() > 0){
                                foreach($set as $data) {

                                    $created = date('M. d, Y - h:i A', strtotime($data['created']));

                                    switch($data['status']) {
                                        case "Done":
                                            $status = '<span class="badge badge-success">'.$data['status'].'</span>';
                                            break;
                                        case "Approved":
                                            $status = '<span class="badge badge-primary">'.$data['status'].'</span>';
                                            break;
                                        case "Declined":
                                            $status = '<span class="badge badge-danger">'.$data['status'].'</span>';
                                            break;
                                        default:
                                            $status = '<span class="badge badge-warning">'.$data['status'].'</span>';
                                    }

                                    echo '<tr>
                                        <td>'.$data['id'].'</td>
                                        <td>'.$data['name'].'</td>
                                        <td>'.$data['email'].'</td>
                                        <td>'.$status.'</td>
                                        <td>'.$created.'</td>
                                    </tr>';
                                }
                            }
                            else {
                                echo '<tr>
                                    <td colspan="10"><i>No Data</i></td>
                                </tr>';
                            } 

                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
    <script src="js/time.js"></script>
    <?php include("layout/script.php"); ?>
</body>

</html>