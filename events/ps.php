<?php 

include("csrfToken.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Party - Standard</title>
    <?php include("layout/header.php") ?>
</head>
<body>
<?php include("layout/navbar.php") ?>
    <div class="container d-flex flex-column flex-lg-row py-5">
        <form id="ps" method="post" class="d-block mx-auto col-12 col-lg-8">
        <h1 class="fw-bold"><span class="green">Party</span> - Standard</h1>
        <input type="hidden" name="key" value="<?php echo $key ?>">
        <input type="hidden" name="token" value="<?php echo $token ?>">
            <div class="row">
                <div class="form-floating col-12 col-md-4 mt-3">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name" autocomplete="off" required>
                    <label for="name">Name</label>
                </div>
                <div class="form-floating col-12 col-md-4 mt-3">
                    <input type="tel" name="phone" id="phone" class="form-control" placeholder="Phone" minlength="11" maxlength="11" autocomplete="off" required>
                    <label for="phone">Phone</label>
                </div>
                <div class="form-floating col-12 col-md-4 mt-3">
                    <input type="email" name="email" id="email" class="form-control" placeholder="Email" autocomplete="off" required>
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating col-12 col-md-3 mt-3">
                    <input type="number" name="guests" id="guests" class="form-control" value="70" placeholder="No. of guests" readonly>
                    <label for="gusts">No. of guests</label>
                </div>
                <div class="form-floating col-12 col-md-3 mt-3">
                    <input type="date" name="date" id="date" class="form-control" placeholder="Date" autocomplete="off" required>
                    <label for="date">Date</label>
                </div>
                <div class="form-floating col-12 col-md-3 mt-3">
                    <input type="time" name="time" id="time" class="form-control" placeholder="Time" autocomplete="off" required>
                    <label for="time">Time</label>
                </div>
                <div class="form-floating col-12 col-md-3 mt-3">
                    <input type="price" name="price" id="price" class="form-control" placeholder="Price" value="45000" readonly>
                    <label for="price">Price</label>
                </div>
            </div>
            <textarea name="message" id="message" class="form-control mt-3" placeholder="You may enter your preferred main and side dishes here..." autocomplete="off"></textarea>
            <button type="submit" class="btn btn-success mt-3 w-100" name="submit">Book Now</button>
        </form>
        <div class="py-3 py-md-5 px-md-3 px-lg-5 col-12 col-lg-4">
            <h3 class="fw-semibold"><span class="green">Remember</span> your choice.</h3>
            <p>Please confirm your reservation before you submit.</p>
            <p class="fw-semibold">Features:</p>
            <ul>
                <li>70 Maximum number of guests</li>
                <li>14 Delicious dishes</li>
                <li>5 Desserts</li>
                <li>4 Beverages</li>
                <li>Free entertainment for the event</li>
                <li>With transportation service</li>
                <li>Free limited random giveaways</li>
            </ul>
            <p><span class="fw-semibold">Note:</span> Exceeding to maximum number of guests will cost extra charges on the day of the event.</p>
        </div>
    </div>
<?php include("layout/footer.php") ?>
</body>
</html>
<script>
    $(document).ready(function() {
        $("#ps").submit(function(e) {
            e.preventDefault();
            var psData = $(this).serialize();

            $.ajax({
                type: "POST",
                url: "function/process.php",
                data: psData,
                success: function(res) {
                    switch(res) {
                        case "success":
                        Swal.fire({
                                icon: "success",
                                title: "Booked Successfully!",
                                text:"We'll get back to you once your request is approved.",
                                confirmButtonColor: "#67CC65",
                                confirmButtonText: "Continue",
                            }).then(() => {
                                window.location.href = "ps.php"
                            })
                        break;
                        case "invalid": 
                        Swal.fire({
                                icon: "error",
                                title: "Booked Unsuccessfully",
                                text:"Unavailable preferred date and time",
                                confirmButtonColor: "#EB5546",
                                confirmButtonText: "Try Again",
                            }).then(() => {
                                window.location.href = "ps.php"
                            })
                        break;
                        case "invalidTime": 
                        Swal.fire({
                                icon: "error",
                                title: "Invalid date and time.",
                                text:"It is advisable to book few days before the event.",
                                confirmButtonColor: "#EB5546",
                                confirmButtonText: "Try Again",
                            }).then(() => {
                                window.location.href = "bc.php";
                            })
                        break;
                        case "invalidcsrf":
                        Swal.fire({
                                icon: "error",
                                title: "Invalid CSRF Token",
                                text: "Something went wrong", 
                                confirmButtonColor: "#EB5546",
                                confirmButtonText: "Try Again",
                            }).then(() => {
                                window.location.href = "ps.php"
                            })
                        break;
                        default:
                            Swal.fire({
                                icon: "error",
                                title: res,
                                confirmButtonColor: "#EB5546",
                                confirmButtonText: "Try Again",
                            }).then(() => {
                                window.location.href = "ps.php"
                            })
                    }
                }
            })
        })
    })
</script>