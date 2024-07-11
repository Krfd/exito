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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="wrapper">
        <?php include("sidebar.php"); ?>
        <div class="main px-5 py-3">
            <h1 class="fw-bold display-1">Analytics</h1>
            <br>
            <div class="d-md-flex flex-wrap gap-3">
                <div class="col shadow-sm p-3 d-flex border-start border-success border-5 rounded-3">
                    <div class="col mr-2">
                        <div class="text-success fw-bold mb-1">Total Clients</div>
                        <div class="fw-bold mb-0">
                            <?php

                            $total = $conn->prepare("SELECT COUNT(id) FROM reservation WHERE status = 'Fully Paid'");
                            $total->execute();

                            $totalBooked = $total->fetch(PDO::FETCH_ASSOC);
                            echo $totalBooked['COUNT(id)'];

                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <!-- <i class="fa-solid fa-bookmark fa-3x text-secondary"></i> -->
                        <i class="fa-solid fa-users fa-3x text-secondary"></i>
                    </div>
                </div>
                <div class="col shadow-sm p-3 d-flex border-start border-primary border-5 rounded-3 mt-3 mt-md-0">
                    <div class="col mr-2">
                        <div class="text-primary fw-bold mb-1">Approved Reservation</div>
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
                        <div class="text-warning fw-bold mb-1">Pending Reservation</div>
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
                        <div class="text-danger fw-bold mb-1">Declined Reservation</div>
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
            <div class="d-md-flex flex-wrap gap-3 mt-3">
                <div class="col shadow-sm p-3 d-flex border-start border-primary-subtle border-5 rounded-3">
                    <div class="col mr-2">
                        <div class="text-primary-emphasis fw-bold mb-1">Total Earnings</div>
                        <div class="fw-bold mb-0">
                            <?php

                            $total = $conn->prepare("SELECT SUM(price) FROM reservation WHERE status = 'Fully Paid'");
                            $total->execute();

                            $totalBooked = $total->fetch(PDO::FETCH_ASSOC);
                            // echo "₱ ". substr($totalBooked['SUM(price)'], 0, 3) . ","  . substr($totalBooked['SUM(price)'], 3);

                            if(strlen($totalBooked['SUM(price)']) > 5) {
                                echo "₱ ". substr($totalBooked['SUM(price)'], 0, 3) . ","  . substr($totalBooked['SUM(price)'], 3);
                            } else if(strlen($totalBooked['SUM(price)']) > 4) {
                                echo "₱ ". substr($totalBooked['SUM(price)'], 0, 2) . ","  . substr($totalBooked['SUM(price)'], 2);
                            } else echo "₱ ". "0";

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

                            $total = $conn->prepare("SELECT SUM(price) FROM reservation WHERE MONTH(DATE(date_approved)) = MONTH(DATE(CURDATE())) AND status = 'Fully Paid'");
                            $total->execute();

                            $monthlyTotal = $total->fetch(PDO::FETCH_ASSOC);
                            // echo "₱ ". substr($monthlyTotal['SUM(price)'], 0, 3) . ","  . substr($monthlyTotal['SUM(price)'], 3);

                            if(strlen($monthlyTotal['SUM(price)']) > 5) {
                                echo "₱ ". substr($monthlyTotal['SUM(price)'], 0, 3) . ","  . substr($monthlyTotal['SUM(price)'], 3);
                            } else if(strlen($monthlyTotal['SUM(price)']) > 4) {
                                echo "₱ ". substr($monthlyTotal['SUM(price)'], 0, 2) . ","  . substr($monthlyTotal['SUM(price)'], 2);
                            } else echo "₱ ". "0";

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

                            $total = $conn->prepare("SELECT SUM(price) FROM reservation WHERE WEEK(DATE(date_approved)) = WEEK(DATE(CURDATE())) AND status = 'Fully Paid'");
                            $total->execute();

                            $weeklyTotal = $total->fetch(PDO::FETCH_ASSOC);

                            if(strlen($weeklyTotal['SUM(price)']) > 5) {
                                echo "₱ ". substr($weeklyTotal['SUM(price)'], 0, 3) . ","  . substr($weeklyTotal['SUM(price)'], 3);
                            } else if(strlen($weeklyTotal['SUM(price)']) > 4) {
                                echo "₱ ". substr($weeklyTotal['SUM(price)'], 0, 2) . ","  . substr($weeklyTotal['SUM(price)'], 2);
                            } else echo "₱ ". "0";
                            
                            // else if(strlen($weeklyTotal['SUM(price)']) < 3 || $weeklyTotal['SUM(price)'] == 0 || $weeklyTotal['SUM(price)'] == "") {
                            //     echo "₱ ". "0";
                            // }

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

                            if(strlen($pending) > 5) {
                                echo "₱ ". substr($pending, 0, 3) . ","  . substr($pending, 3);
                            } else if(strlen($pending) > 4) {
                                echo "₱ ". substr($pending, 0, 2) . ","  . substr($pending, 2);
                            } else if(strlen($pending) < 3 || $pending == 0 || $pending == "") {
                                echo "₱ ". "0";
                            }

                            ?>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fa-solid fa-hourglass-half fa-3x text-secondary"></i>
                    </div>
                </div>
            </div>
            <div class="d-block d-md-flex gap-3 my-5">
                <div class="d-block col-12 col-md-6">
                    <div class="my-5 my-md-3">
                        <canvas id="incomeChart"></canvas>
                    </div>
                    <div class="my-5 my-md-3">
                        <canvas id="userChart"></canvas>
                    </div>
                </div>
                <div class="col-12 col-md-6 my-5 my-md-3">
                    <canvas id="statusChart"></canvas>
                </div>
            </div>
            <!-- <div class="mt-5">
                <div class="table-responsive h-100">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Date Inquired</th>
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
                                        case "Fully Paid":
                                            $status = '<span class="badge badge-success">'.$data['status'].'</span>';
                                            break;
                                        case "Approved":
                                            $status = '<span class="badge badge-primary">'.$data['status'].'</span>';
                                            break;
                                        case "Declined":
                                            $status = '<span class="badge badge-danger">'.$data['status'].'</span>';
                                            break;
                                        default:
                                            $status = '<span class="badge badge-warning text-white">'.$data['status'].'</span>';
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
                                    <td colspan="10" class="text-center"><i>No Data</i></td>
                                </tr>';
                            } 

                            ?>
                        </tbody>
                    </table>
                </div>
            </div> -->
            <div class="text-center">
                <small><i>Copyright &copy; <?php echo date("Y"); ?>. All rights reserved.</i></small>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
    <script src="js/time.js"></script>
    <?php include("layout/script.php"); ?>
    <script>
        fetch('chartex.php')
            .then(response => response.json())
            .then(data => {
                const month = data.map(item => item.month);
                const total = data.map(item => item.total);

                const ctx = document.getElementById('incomeChart').getContext('2d');
                const scoreChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                        labels: month,
                        datasets: [{    
                            label: 'Monthly Earnings as of <?php echo date("Y") ?>',
                            data: total,
                            backgroundColor: 'rgba(54, 162, 235, 0.2)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));



        fetch('userChart.php')
            .then(response => response.json())
            .then(data => {
                const clients = data.map(item => item.clients);
                const total = data.map(item => item.total);

                const ctx = document.getElementById('userChart').getContext('2d');
                const scoreChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: clients,
                        datasets: [{    
                            label: 'Monthly Client/s as of <?php echo date("Y")?>',
                            data: total,
                            backgroundColor: "rgba(0, 255, 0, 0.2)",
                            // borderColor: ['#CB4335', '#1F618D', '#F1C40F', '#27AE60', '#884EA0', '#D35400'],
                            borderColor: "rgba(0, 255, 0, 1)",
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));

        fetch('statusChart.php')
            .then(response => response.json())
            .then(data => {
                const status = data.map(item => item.status);
                const count = data.map(item => item.count);

                const ctx = document.getElementById('statusChart').getContext('2d');
                const scoreChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: status,
                        datasets: [{    
                            label: 'Reservation Status',
                            data: count,
                            backgroundColor: ['rgba(54, 162, 235, .5)', 'rgba(255, 0, 0, .5)', 'rgba(0, 255, 0, .5)', 'rgba(255, 255, 0, .5)', '#884EA0', '#D35400'],
                            borderColor: ['rgba(54, 162, 235, .5)', 'rgba(255, 0, 0, .5)', 'rgba(0, 255, 0, .5)', 'rgba(255, 255, 0, .5)', '#884EA0', '#D35400'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            responsive: true,
                            y: {
                                beginAtZero: true
                            }
                        },
                        plugins: {
                            title: {
                                display: true,
                                text: "Reservation Status"
                            }
                        }
                    }
                });
            })
            .catch(error => console.error('Error fetching data:', error));

    </script>
</body>
</html>