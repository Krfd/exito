<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Services</title>
    <?php include("layout/header.php") ?>

</head>

<body>
    <?php include("layout/navbar.php") ?>
    <div class="container-fluid hero-services py-5">
        <div class="container text-center my-5 py-5">
            <h1 class="fw-semibold text-white display-1">Our Kitchen</h1>
            <div class="text-white mt-5 pt-5 services">
                <h4 class="fw-bold">What we serve?</h4>
                <p class="fw-light">We serve different foods on different events such as Birthday, Wedding, Christening, Festivals, and many more. Exito has served countless events since its deliciously indulging foods became popular for most Ilonggos. They serve multiple best tasting foods from local to luxury dishes.</p>
            </div>
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row gap-0">
        <div class="col-12 col-md-4 beef">
            <a href="beef.php" class="text-decoration-none text-white">
                <div class="dish-desc p-3 p-lg-5 text-white">
                    <h2 class="dish-name">Beef</h2>
                    <small><i>Taste our best tasting beef dishes.</i></small>
                </div>
                <img src="assets/img/services/beef.jpg" class="dish beef" alt="Beef">
            </a>
        </div>
        <div class="col-12 col-md-8 pork">
            <a href="pork.php" class="text-decoration-none text-white">
                <div class="dish-desc p-3 p-lg-5 text-white">
                <h2 class="dish-name">Pork</h2>
                <small>Delicious and juicy pork dishes.</small>
                </div>
                <img src="assets/img/services/pork.jpg" class="dish pork" alt="Pork">
            </a>
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row gap-0">
        <div class="col-12 col-md-6">
            <a href="chicken.php" class="text-decoration-none text-white">
                <div class="dish-desc p-3 p-lg-5 text-white">
                <h2 class="dish-name">Chicken</h2>
                <small>
                    Indulge our local chicken dishes.
                </small>
                </div>
                <img src="assets/img/services/chicken1.jpg" class="dish chicken" alt="Chicken">
            </a>
        </div>
        <div class="col-12 col-md-6">
            <a href="seafoods.php" class="text-decoration-none text-white">
                <div class="dish-desc p-3 p-lg-5 text-white">
                <h2 class="dish-name">Seafoods</h2>
                <small>
                    Fresh from the sea, our quality and seafood cuisine dishes.
                </small>
                </div>
                <img src="assets/img/services/seafood1.jpg" class="dish seafood" alt="Seafood">
            </a>
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row gap-0">
        <div class="col-12 col-md-8">
            <a href="soup.php" class="text-decoration-none text-white">
                <div class="dish-desc p-3 p-lg-5 text-white">
                <h2 class="dish-name">Soup</h2>
                <small class="txet-white">Fill your stomach with our flavorful soups.</small>
                </div>
                <img src="assets/img/services/soup.jpg" class="dish soup" alt="Soup">
            </a>
        </div>
        <div class="col-12 col-md-4">
            <a href="vegetables.php" class="text-decoration-none text-white">
                <div class="dish-desc p-3 p-lg-5 text-white">
                <h2 class="dish-name">Vegetables</h2>
                <small>
                    Keep your appetite healthy with our organic and fresh vegetable dishes.
                </small>
                </div>
                <img src="assets/img/services/vegetable.jpg" class="dish vegetable" alt="Vegetables">
            </a>
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row gap-0">
        <div class="col-12 col-md-4">
            <a href="appetizer.php" class="text-decoration-none text-white">
                <div class="dish-desc p-3 p-lg-5 text-white">
                <h2 class="dish-name">Appetizer</h2>
                <small>Match your foods with our <br> quality tasting appetizers.</small>
                </div>
                <img src="assets/img/services/appetizer1.jpg" class="dish appetizer" alt="Appetizer">
            </a>
        </div>
        <div class="col-12 col-md-4">
            <a href="paste.php" class="text-decoration-none text-white">
                <div class="dish-desc p-3 p-lg-5 text-white">
                <h2 class="dish-name">Pasta</h2>
                <small class="txet-white">We serve creamy <br> pasta you can seek.</small>
                </div>
                <img src="assets/img/services/pasta.jpg" class="dish pasta" alt="Pasta">
            </a>
        </div>
        <div class="col-12 col-md-4">
            <a href="desserts.php" class="text-decoration-none text-white">
                <div class="dish-desc p-3 p-lg-5 text-white">
                <h2 class="dish-name">Desserts</h2>
                <small>Satisfy your cravings in desserts.</small>
                </div>
                <img src="assets/img/services/dessert.jpg" class="dish desserts" alt="Dessert">
            </a>
        </div>
    </div>
    <div class="d-flex flex-column flex-md-row gap-0">
        <div class="col-12 col-md-6">
            <a href="salad.php" class="text-decoration-none text-white">
                <div class="dish-desc p-3 p-lg-5 text-white">
                <h2 class="dish-name">Salad</h2>
                <small>
                    Extraordinary salad only here in Exito
                </small>
                </div>
                <img src="assets/img/services/salad.jpg" class="dish salad" alt="Salad">
            </a>
        </div>
        <div class="col-12 col-md-6">
            <a href="beverages.php" class="text-decoration-none text-white">
                <div class="dish-desc p-3 p-lg-5 text-white">
                <h2 class="dish-name">Beverages</h2>
                <small>
                    Fill your thirst with our freshly made beverages.
                </small>
                </div>
                <img src="assets/img/services/beverage.jpg" class="dish beverage" alt="Beverage">
            </a>
        </div>
    </div>
    <?php include("layout/footer.php") ?>
</body>

</html>