<?php

$contactKey = bin2hex(random_bytes(64));
$contactToken = hash_hmac('sha256', 'this is for contact', $contactKey);

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
    <div class="container-fluid py-5 my-5">
        <div class="container d-flex flex-column flex-md-row justify-content-evenly align-items-center">
            <div class="contact-left">
                <h1 class="fw-bold display-2">Let's get in touch!</h1>
                <p>For more information just fill out the form below.</p>
                <form method="post" id="contact" class="w-100">
                    <input type="hidden" name="csrfToken" value="<?php echo $contactToken; ?>" />
                    <input type="hidden" name="key" value="<?php echo $contactKey; ?>" />
                    <div>
                        <div class="form-floating">
                            <input type="text" name="name" id="name" class="form-control rounded-3" placeholder="Name" required />
                            <label for="name">Name</label>
                        </div>
                        <div class="row">
                        <div class="col-12 col-md-6 form-floating mt-3">
                            <input type="tel" name="phone" id="phone" class="form-control rounded-3" placeholder="Phone" required />
                            <label for="phone">Phone</label>
                        </div>
                        <div class="col-12 col-md-6 form-floating mt-3">
                            <input type="date" name="date" id="date" class="form-control rounded-3" placeholder="Date" required />
                            <label for="date">Date</label>
                        </div>
                        </div>
                        <div class="form-floating mt-3">
                            <input type="email" name="email" id="email" class="form-control rounded-3" placeholder="Email" required />
                            <label for="email">Email</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark rounded-3 mt-3 w-100">
                        Submit
                    </button>
                </form>
            </div>
            <div class="contact-right px-3 px-md-5 mt-5 mt-md-0">
                <p><strong>Book a meeting</strong> with us! We offer a <strong>free</strong> consultation for our customers with no hiddne charges. If you have any concerns you may also reach us on our following contact information below.</p>
            </div>
        </div>
        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d5544.426471895551!2d122.563479342513!3d10.695743714818656!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sph!4v1714572587981!5m2!1sen!2sph" width="600" height="450" style="border:0; width: 100%" allowfullscreen="" class="py-5 px-3 px-md-4 px-lg-5 d-block mx-auto" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <?php include("layout/footer.php") ?>
</body>

</html>

<script>
    $(document).ready(function() {
        $("#contact").submit(function(e) {
            e.preventDefault();
            var contact_data = $(this).serialize();

            const Toast = Swal.mixin({
                toast: true,
                position: center,
                cuustomClass: {
                    popup: "colored-toast",
                },
                showConfirmButton: false,
                timer: 1000,
                timerProgressBar: true,
            });

            $.ajax({
                type: "POST",
                url: "contact_process.php",
                data: contact_data,
                success: function(response) {
                    switch (response) {
                        case "success":
                            // login
                            Toast.fire({
                                icon: "success",
                                title: "Your contact information has been submitted.",
                                text: "",
                            }).then(() => {
                                window.location = "home.php";
                            });
                            break;
                        case "invalidcsrf":
                            // no csrf
                            Toast.fire({
                                icon: "error",
                                title: "Invalid Token",
                                text: "Please try again...",
                            }).then(() => {
                                window.location = "index.php";
                            });
                            break;
                        default:
                            // error
                            Toast.fire({
                                icon: "error",
                                title: "Something went wrong",
                                text: "Please try again...",
                                showConfirmButton: false,
                            });
                    }
                },
            });
        });
    });
</script>