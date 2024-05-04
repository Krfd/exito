<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>

    <?php include("layout/header.php") ?>
</head>

<body>
    <?php include("layout/navbar.php") ?>
    <div class="container-fluid hero-home py-5">
        <div class="container text-center py-5 my-5">
            <h1 class="fw-semibold text-white">
                Exito Catering Services <br />
                &amp; Event Decorators
            </h1>
            <p class="text-white">
                <i>"Elegant and Quality Food Services"</i>
            </p>
            <a href="offers.php" class="text-center text-decoration-none border px-3 py-1 border-3 border-light text-light rounded-0 book">
                Book Now
            </a>
        </div>
    </div>
    <div class="container-fluid py-5 feature">
        <div class="container py-5">
            <div class="text-center">
                <h2 class="fw-light text-uppercase text-secondary display-5">
                    Your Special Occasion
                </h2>
                <small><i>Indulge a memorable experience with the people you
                        love.</i></small>
            </div>
            <div class="d-block d-lg-flex justify-content-evenly align-items-baseline my-5 py-3">
                <div class="text-center">
                    <img src="./assets/img/partyy.jpg" alt="Party Event" class="object-fit-cover event" />
                    <div class="content mt-3 d-block mx-auto w-50">
                        <h4 class="w-medium">Party Events</h4>
                        <small class="text-secondary">We serve the most popular events of Filipinos,
                            we offer different foods you can love.</small>
                    </div>
                </div>
                <div class="text-center mt-5 md-md-0">
                    <img src="./assets/img/casual.jpg" alt="Corporate Event" class="object-fit-cover event" />
                    <div class="content mt-3 d-block mx-auto w-75">
                        <h4 class="w-medium">Corporate Events</h4>
                        <small class="text-secondary">Enjoy our corporate package with various and
                            assorted foods.</small>
                    </div>
                </div>
                <div class="text-center mt-5 md-md-0">
                    <img src="./assets/img/wedding.jpg" alt="Wedding Event" class="object-fit-cover event" />
                    <div class="content mt-3 d-block mx-auto w-50">
                        <h4 class="w-medium">Wedding Events</h4>
                        <small class="text-secondary">We cater quality wedding event package with
                            customizable theme of your choice.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid icon-container py-5">
        <div class="container d-flex flex-column flex-md-row gap-5 gap-md-3 justify-content-evenly align-items-center">
            <div class="box text-center">
                <i class="fa-solid fa-star icon"></i>
                <br />
                <strong>Quality Service</strong> <br>
                <small>We value the experience of our customers</small>
            </div>
            <div class="box text-center">
                <i class="fa-solid fa-heart icon"></i>
                <br />
                <strong>Liked by many customers</strong><br>
                <small>Promotes customer satisfaction</small>
            </div>
            <div class="box text-center">
                <i class="fa-solid fa-bowl-food icon"></i>
                <br />
                <strong>Delicious dishes</strong> <br>
                <small>Indulge our best tasting dishes</small>
            </div>
            <div class="box text-center">
                <i class="fa-solid fa-peso-sign icon"></i>
                <br />
                <strong>Affordable price</strong> <br>
                <small>Exito offers a catering service for an affordable price.</small>
            </div>
        </div>
    </div>
    <div class="container-fluid py-5">
        <div class="container d-block d-lg-flex justify-content-center align-items-center my-5">
            <div class="box p-5 text-center">
                <h2>Our Chefs</h2>
                <p>
                    Discover the best tasting dishes from our experienced
                    chef's. These professional people showcased their
                    passion and talent in the foods in business industry for
                    several years. Their goal is not just only to satisfy
                    customers but also to provide you with the best quality
                    dishes here in Iloilo.
                </p>
                <button class="btn btn-sm rounded-0 border-3 border-secondary">
                    Learn More
                </button>
            </div>
            <div class="box p-3 p-md-5">
                <img src="./assets/img/cater.jpg" alt="Cater" class="shadow-sm" style="width: 100%" />
            </div>
        </div>
    </div>
    <?php include("layout/footer.php") ?>

</body>

</html>