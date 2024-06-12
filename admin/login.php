<?php

    $key = bin2hex(random_bytes(64));
    $token = hash_hmac('sha256', 'For login', $key);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exito - Admin</title>
    <!-- Logo -->
    <link rel="icon" href="../assets/logo.jpg" />
    <!-- External CSS -->
    <link rel="stylesheet" href="form.css">
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- Sweet Alert 2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <div class="bg-image"></div>
<div class="bg-form rounded-3">
  <form id="login" method="post" enctype="multipart/form-data" class="form d-block mx-auto p-3 p-md-5">
    <h1 class="fw-bold text-white text-center display-4"><i class="fa-solid fa-right-to-bracket"></i> <span class="green">Login</span></h1>
    <h3 class="fw-semibold text-white text-center"><span class="green">Exito</span> Catering Services</h3>
    <hr>
    <input type="hidden" name="key" value="<?php echo $key ?>">
    <input type="hidden" name="token" value="<?php echo $token ?>">
    
    <label for="email">Email <span class="red">*</span></label> <br>
    <input type="email" name="email" id="email" class="form-input rounded-3 border-0 ps-2 py-2 mt-1" autocomplete="off" style="width: 100%" required>
    <label for="password" class="mt-3">Password <span class="red">*</span></label> <br>
    <input type="password" name="password" id="password" class="form-input rounded-3 border-0 ps-2 py-2 mt-1" autocomplete="off" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" style="width: 100%" required>
    <div class="mt-3">
    <input type="checkbox" class="fw-light form-check-input" onclick="showPass()"> Show Password
    </div>
    <button class="btn btn-primary text-uppercase my-3 d-block mx-auto w-100" name="login" type="submit">Login</button>
    <p>Don't have an account? <a href="signup.php" class="text-decoration-none text-white blue">Signup</a></p>
</form>
</div>
</body>
</html>

<script>
    $(document).ready(function() {
        $('#login').submit(function(e) {
            e.preventDefault();
            var loginData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "login_process.php",
                data: loginData,
                success: function(res) {
                    switch(res) {
                        case "success":
                        Swal.fire({
                                        icon: "success",
                                        title: "Welcome!",
                                        text:"Access granted",
                                        confirmButtonColor: "#67CC65",
                                        confirmButtonText: "Continue",
                                    }).then(() => {
                                        window.location.href = "requests.php"
                                    })
                            break;
                            case "invalid": 
                            Swal.fire({
                                        icon: "error",
                                        title: "Invalid email or password",
                                        text:"Please check your email or password",
                                        confirmButtonColor: "#EB5546",
                                        confirmButtonText: "Try Again",
                                    }).then(() => {
                                        window.location.href = "login.php"
                                    })
                            break;
                            case "no account": 
                                Swal.fire({
                                        icon: "error",
                                        title: "No account has been found.",
                                        text:"Please register before logging in.",
                                        confirmButtonColor: "#EB5546",
                                        confirmButtonText: "Try Again",
                                    }).then(() => {
                                        window.location.href = "login.php"
                                    })
                            break;
                            case "invalidcsrf":
                            Swal.fire({
                                        icon: "error",
                                        title: "Login failed",
                                        text: "Invalid CSRF Token", 
                                        confirmButtonColor: "#EB5546",
                                        confirmButtonText: "Try Again",
                                    }).then(() => {
                                        window.location.href = "login.php"
                                    })
                                break;
                                default:
                                    Swal.fire({
                                        icon: "error",
                                        title: res,
                                        confirmButtonColor: "#EB5546",
                                        confirmButtonText: "Try Again",
                                    }).then(() => {
                                        window.location.href = "login.php"
                                    })
                    }
                }
            })
            return false;
        })
    })

    function showPass() {
        let pass = document.getElementById("password");
        if(pass.type === "password") {
            pass.type = "text";
        } else {
            pass.type = "password";
        }
    }
</script>