<!-- Admin navigation bar -->
<header class="sticky-top w3-black">
    <!--An opening horizontal line for decoration-->
    <hr>
    <nav class="navbar navbar-expand-lg navbar-dark" style="border-radius: 8px;">
        <div class="bars container-fluid">
            <!--Creating a logo with the span description-->
            <a class="navbar-brand" id="logo" href="index.php">
                <img src="Assets/Images/logo/logo2.png" alt="Logo">
                <span class="fw-bold" title="Click logo for Home Page">Tanzanian Beauty</span>
            </a>
            <!--Creating a collapsible navigation button-->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav_collapse" aria-controls="nav_collapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!--Assigning the id of the buttion to the divs class housing the various links-->
            <div class="collapse navbar-collapse" id="nav_collapse">
                <ul class="navbar-nav ms-auto fw-bold text-dark">
                    <li class="nav-item"><a class="nav-link active w3-hover-brown" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link w3-hover-brown" href="gallery.php">Gallery</a></li>

                    <!-- Switching states of navigation bars -->
                    <?php if (!isset($_SESSION["username"])) { ?>
                        <li class="nav-item"><a class="nav-link w3-hover-brown" href="login.php">Login</a></li>
                    <?php } else { ?>

                        <li class="nav-item"><a class="nav-link w3-hover-brown" href="logout.php">Logout</a></li>
                    <?php } ?>

                    <li class="nav-item"><a class="nav-link w3-hover-brown" href="signup.php">Signup</a></li>

                    <?php if (isset($_SESSION["username"]) && $_SESSION["roleID"] == 1) { ?>
                        <li class="nav-item"><a class="nav-link w3-hover-brown" href="home.php">My Space</a></li>
                    <?php } ?>

                    <?php if (isset($_SESSION["username"]) && $_SESSION["roleID"] == 2) { ?>
                        <li class="nav-item"><a class="nav-link w3-hover-brown" href="admin.php">Admin Space</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <!--A closing horizontal line for decoration-->
    <hr>

</header>