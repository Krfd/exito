<?php
include("connect.php");

if (isset($_GET['id'])) {
    $res_id = $_GET['id'];

    // Query for approving reservation
    $query_res = "SELECT * FROM reservation WHERE id = $res_id";
    $res = $conn->query($query_res);

    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
    }

    $reserve = "UPDATE reservation SET is_declined = 1, status = 'Declined' WHERE id = $id";
    $conn->exec($reserve);

    echo "success";
} else {
    echo "error";
}