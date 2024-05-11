<nav class="navbar navbar-expand-sm px-1 py-3 shadow">
    <div class="container-fluid">
        <a href="./home.php"><img src="./assets/logo.jpg" alt="Logo" class="logo" style="width: 50px"></a>
        <button class="toggler navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
            <span></span>
            <span></span>
            <span></span>
        </button>
        <div class="collapse navbar-collapse mt-3 mt-md-0" id="collapsibleNavbar">
            <ul class="navbar-nav ms-0 ms-md-3 text-center ">
                <li class="nav-item"><a href="home.php" class="nav-link text-decoration-none text-dark">Home</a></li>
                <li class="nav-item"><a href="about.php" class="nav-link text-decoration-none text-dark">About</a></li>
                <li class="nav-item"><a href="services.php" class="nav-link text-decoration-none text-dark">Services</a></li>
                <li class="nav-item"><a href="contact.php" class="nav-link text-decoration-none text-dark">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
<script>
    let menuToggle = document.querySelector(".toggler");
    menuToggle.onclick = function() {
        menuToggle.classList.toggle("active");
    };
</script>