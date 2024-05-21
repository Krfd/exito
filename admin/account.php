<?php

$key = bin2hex(random_bytes(64));
$token = hash_hmac('sha256', "for update", $key);

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

<body>
    <div class="wrapper">
        <?php include("sidebar.php"); ?>
        <div class="main px-5 py-3">
            <h1 class="fw-bold display-1">Account</h1>
            <hr>
            <div class="table-responsive">
                <table class="table table-hover table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th colspan="2">Account Created</th>
                            <th>Updated</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $admin = $conn->prepare("SELECT * FROM admin");
                            $admin->execute();

                            $account = $admin->fetchAll(PDO::FETCH_ASSOC);

                            if($admin->rowCount() > 0) {
                                foreach($account as $acc) {
                                    $id = $acc['id'];
                                    $name = $acc['name'];
                                    $email = $acc['email'];
                                    $created = $acc['created'];
                                    $updated = $acc['updated'];

                                    $day = date('M. d, Y - ', strtotime($created));
                                    $hr = date('h:i A', strtotime($updated));

                                    $created = $day . " ". $hr;

                                    echo 
                                    '<tr>
                                        <td>'.$id.'</td>
                                        <td>'.$name.'</td>
                                        <td>'.$email.'</td>
                                        <td>'.$created.'</td>
                                        <td>'.$updated.'</td>
                                        <td><button type="button" class="btn btn-sm rounded text-center btn-primary" data-bs-toggle="modal" data-bs-target="#update">Update</button></td>
                                    </tr>';

                                    echo 
                                    '
                                    <div class="modal fade" id="update">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title">Update Account</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="update" method="post">
                                                        <input type="hidden" name="key" value='.$key.'/>
                                                        <input type="hidden" name="token" value='.$token.'/>
                                                        <div class="form-floating">
                                                            <input type="password" name="old_pass" id="old_pass" class="form-control pass" placeholder="Old Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
                                                            <label for="old_pass">Old Password</label>
                                                        </div>
                                                        <div class="form-floating mt-3">
                                                            <input type="password" name="new_pass" id="new_pass" class="form-control pass" placeholder="New Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
                                                            <label for="new_pass">New Password</label>
                                                        </div>
                                                        <div class="form-floating mt-3">
                                                            <input type="password" name="confirm_pass" id="confirm_pass" class="form-control pass" placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" required/>
                                                            <label for="confirm">Confirm Password</label>
                                                        </div>
                                                        <div class="mt-3">
                                                            <input type="checkbox" onclick="showPassword()" class="form-check-input"/> Show Password
                                                        </div>
                                                        <button type="submit" name="update" class="btn btn-primary mt-3 w-100">Save</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    ';
                                }
                            } else {
                                echo 
                                '<tr>
                                    <td colspan="5" class="text-center"><i>No Account</i></td>
                                </tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <script src="js/script.js"></script>
    <script>
        function showPassword() {
            var x = document.getElementsByClassName('pass');
                for(var i = 0; i < x.length; i++) {
                    if(x[i].type == "password") {
                        x[i].type = "text";
                    } else {
                        x[i].type = "password";
                    }
                }
            }

        $(document).ready(function () {
            $("#update").submit(function (e) {
                e.preventDefault();
                var formData = $(this).serialize();
                    $.ajax({
                        type: "POST",
                        url: "update.php",
                        data: formData,
                        success: function (response) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top",
                                customClass: {
                                    popup: "colored-toast",
                                },
                                showConfirmButton: false,
                                timer: 1000,
                                timerProgressBar: true,
                            });
                            switch (response) {
                                case "success":
                                    Toast.fire({
                                        icon: "success",
                                        title: "Updated successfully.",
                                        iconColor: "#28a745",
                                    }).then(() => {
                                        var delay = 100;
                                        setTimeout(function () {
                                            location.reload();
                                        }, delay);
                                    });
                                    break;
                                case "invalid":
                                    Toast.fire({
                                        icon: "error",
                                        title: "Invalid input. Please try again.",
                                        iconColor: "#dc3545",
                                    }).then(() => {
                                        location.reload();
                                    });
                                    break;
                                case "error":
                                    Toast.fire({
                                        icon: "error",
                                        title: "Can't update. Please try again.",
                                        iconColor: "#dc3545",
                                    }).then(() => {
                                        location.reload();
                                    });
                                    break;
                                default:
                                    Toast.fire({
                                        icon: "error",
                                        title: "something went wrong!",
                                        iconColor: "#dc3545",
                                    }).then(() => {
                                        location.reload();
                                    });
                            }
                        },
                    });
                });
            });
    </script>

    <?php include("layout/script.php"); ?>
</body>
</html>