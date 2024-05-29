<?php

$key = bin2hex(random_bytes(64));
$token = hash_hmac('sha256', 'this is for contact', $key);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact</title>

    <?php include("layout/header.php") ?>
</head>

<body>
    <?php include("layout/navbar.php") ?>
    <?php include("layout/bot.php") ?>
    <div class="container-fluid py-5 my-5">
        <div class="container d-flex flex-column flex-md-row justify-content-evenly align-items-center">
            <div class="contact-left">
                <h1 class="fw-bold display-2">Let's get in touch!</h1>
                <p>For more information just fill out the form below.</p>
                <form method="post" id="meeting" class="w-100">
                    <input type="hidden" name="csrfToken" value="<?php echo $token; ?>" />
                    <input type="hidden" name="key" value="<?php echo $key; ?>" />
                    <div>
                    <div class="row">
                        <div class="form-floating col-12 col-md-6">
                            <input type="text" name="name" id="name" class="form-control rounded-3" placeholder="Name" required autocomplete="off" />
                            <label for="name">Name</label>
                        </div>
                        <div class="col-12 col-md-6 form-floating">
                            <input type="tel" name="phone" id="phone" class="form-control rounded-3" placeholder="Phone" minlength="11" maxlength="11" required autocomplete="off"/>
                            <label for="phone">Phone</label>
                        </div>
                        </div>
                        <div class="row mt-3">
                        <div class="col-12 col-md-6 form-floating">
                            <input type="date" name="date" id="date" class="form-control rounded-3" placeholder="Date" required autocomplete="off"/>
                            <label for="date">Date</label>
                        </div>
                        <div class="col-12 col-md-6 form-floating">
                            <input type="time" name="time" id="time" class="form-control rounded-3" placeholder="Time" required autocomplete="off"/>
                            <label for="time">Time</label>
                        </div>
                        </div>
                        <div class="form-floating mt-3">
                            <input type="email" name="email" id="email" class="form-control rounded-3" placeholder="Email" required autocomplete="off"/>
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark rounded-3 mt-3 w-100">
                        Submit
                    </button>
                </form>
            </div>
            <div class="contact-right px-3 px-md-5 mt-5 mt-md-0">
                <p class="para"><strong>Book a meeting</strong> with us! We offer a <strong>free</strong> consultation for our customers with no hiddne charges. If you have any concerns you may also reach us on our following contact information below.</p>
            </div>
        </div>
        <div class="container">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d52657.1499493657!2d122.56654859065625!3d11.204935068250709!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x33af6c519dcd3371%3A0xde59c9ba142284ac!2sBingawan%2C%20Iloilo!5e0!3m2!1sen!2sph!4v1716254346001!5m2!1sen!2sph" width="600" height="450" style="border:0; width: 100%" class="py-5 px-3 px-md-0 d-block mx-auto" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <?php include("layout/footer.php") ?>
    <script src="layout/index.js"></script>
</body>

</html>

<script>
    $(document).ready(function() {
        $("#meeting").submit(function(e) {
            e.preventDefault();
            var contact_data = $(this).serialize();

            const Toast = Swal.mixin({
                toast: true,
                position: "center",
                cuustomClass: {
                    popup: "colored-toast",
                },
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
            });

            $.ajax({
                type: "POST",
                url: "meeting.php",
                data: contact_data,
                success: function(response) {
                    switch (response) {
                        case "success":
                            Toast.fire({
                                icon: "success",
                                title: "Successfully sent!",
                                text: "We will keep in touch for confirmation.",
                            }).then(() => {
                                window.location = "contact.php";
                            });
                            break;
                        case "invalidcsrf":
                            Toast.fire({
                                icon: "error",
                                title: "Invalid Token",
                                text: "Please try again...",
                            }).then(() => {
                                window.location = "contact.php";
                            });
                            break;
                        case "unavailable":
                            Toast.fire({
                                icon: "error",
                                title: "Unavailable time slot.",
                                text: "Please select another day or time.",
                            }).then(() => {
                                window.location = "contact.php";
                            });
                            break;
                        case "full":
                            Toast.fire({
                                icon: "error",
                                title: "Schedule is full.",
                                text: "Please select another time.",
                            }).then(() => {
                                window.location = "contact.php";
                            });
                            break;
                        case "invalidTimestamp": 
                            Toast.fire({
                                    icon: "error",
                                    title: "Invalid date.",
                                    text:"It is recommended to schedule a meeting ahead of time.",
                                    confirmButtonColor: "#EB5546",
                                    confirmButtonText: "Try Again",
                                }).then(() => {
                                    window.location.href = "contact.php";
                                })
                            break;
                        default:
                            Toast.fire({
                                icon: "error",
                                title: response,
                                text: "Please try again...",
                                showConfirmButton: false,
                            }).then(() => {
                                window.location.href = "contact.php"
                            })
                    }
                },
            });
            return false;
        });
    });
</script>