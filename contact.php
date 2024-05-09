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

    <!-- JQuery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <!-- Sweet Alert 2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php include("layout/header.php") ?>
</head>

<body>
    <?php include("layout/navbar.php") ?>
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
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d5544.426471895551!2d122.563479342513!3d10.695743714818656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1714572587981!5m2!1sen!2sph" width="600" height="450" style="border:0; width: 100%" allowfullscreen="" class="py-5 px-3 px-md-0 d-block mx-auto" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
    <?php include("layout/footer.php") ?>
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
                timer: 10000,
                timerProgressBar: true,
            });

            $.ajax({
                type: "POST",
                url: "meeting.php",
                data: contact_data,
                success: function(response) {
                    switch (response) {
                        case "success":
                            // login
                            Toast.fire({
                                icon: "success",
                                title: "Successfully sent!",
                                text: "We will keep in touch for confirmation.",
                            }).then(() => {
                                window.location = "contact.php";
                            });
                            break;
                        case "invalidcsrf":
                            // no csrf
                            Toast.fire({
                                icon: "error",
                                title: "Invalid Token",
                                text: "Please try again...",
                            }).then(() => {
                                window.location = "contact.php";
                            });
                            break;
                        default:
                            // error
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
        });
    });
</script>