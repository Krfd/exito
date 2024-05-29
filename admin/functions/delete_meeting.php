<?php
include("connect.php");

if (isset($_GET['id'])) {
    $del_id = $_GET['id'];

    // Query for deleting meeting
    $query_res = "SELECT * FROM meeting WHERE id = $del_id";
    $res = $conn->query($query_res);

    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
    }

    $reserve = "DELETE FROM meeting WHERE id = $id";
    $conn->exec($reserve);

    echo "success";
} else {
    echo "error";
}