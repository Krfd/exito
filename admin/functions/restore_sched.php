<?php
include("connect.php");

if (isset($_GET['id'])) {
    $meeting_id = $_GET['id'];

    // Query for restoring meeting
    $query_meeting = "SELECT * FROM meeting WHERE id = $meeting_id";
    $res = $conn->query($query_meeting);

    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $id = $row['id'];
    }

    $meeting = "UPDATE meeting SET is_declined = 0 WHERE id = $id";
    $conn->exec($meeting);

    echo "success";
} else {
    echo "error";
}