<?php
session_start();            #retrieve session		

if (isset($_SESSION["username"]))        # if logged on	
{
    header("Location: home.php");       # redirect to home page
    exit();
}

?>

<head>
<!-- Sweet Alert plugin and stylesheet -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<?php
if (isset($_SESSION["status"])) {
?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            swal({
                title: "<?php echo $_SESSION["status"] ?>",
                icon: "<?php echo $_SESSION["icon"] ?>",
                button: "Close!",
            });
        });
    </script>

<?php
    unset($_SESSION["status"]);
}
?>

<?php
if (isset($_SESSION["del_account"])) {
?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            swal({
                title: "<?php echo $_SESSION["del_account"] ?>",
                icon: "<?php echo $_SESSION["icon"] ?>",
                button: "Close!",
            });
        });
    </script>

<?php
    session_destroy();
}
?>







<!DOCTYPE html>
<html lang="en">

<!-- Linking the stylesheet-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="Assets/CSS/style.css"> -->
    <link rel="stylesheet" href="Assets/CSS/w3.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <title>Login Page</title>



</head>

<body>
    <!-- Header section -->
    <header class="sticky-top">
        <!--An opening horizontal line for decoration-->
        <hr>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <!--Creating a logo with the span description-->
                <a class="navbar-brand" id="logo" href="#"><img src="img/abc.jpg" alt="Logo">
                    <span title="Click logo for Home Page">Tanzanian Beauty</span>
                </a>
                <!--Creating a collapsible navigation button-->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav_collapse" aria-controls="nav_collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--Assigning the id of the buttion to the div class housing the varius links-->
                <div class="collapse navbar-collapse" id="nav_collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="gallery.php">Gallery</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                        <li class="nav-item"><a class="nav-link" href="signup.php">Signup</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!--A closing horizontal line for decoration-->
        <hr>
    </header>


    <main class="container">
        <!--content-->
        <div class="row">
            <!--row-->

            <div class="col">
                <!--col 1-->
                <p>Lorem ipsum dolor sit amet <br> consectetur adipisicing elit. Fugiat facilis <br> dolore ipsa officiis
                    natus ex nam
                    odio tempora in.</p>
            </div>

            <div class="col">
                <div class="row">
                    <form id="login" method="post" action="verify.php">
                        <img src="#" alt="User logo">
                        <hr>
                        <input type="text" name="username" placeholder="Username">
                        <input type="password" name="password" placeholder="Password">

                        <button type="submit">Login</button>

                    </form>
                </div>
                <div class="row">
                    <h4>Forgot Password??</h4>
                    <form method="POST" action="verify.php">
                        <input type="text" name="username" placeholder="Username">


                        <input type="password" class="form-control" id="newpass" name="newpass" placeholder="New Password" required>
                        <input type="password" class="form-control" id="cnewpass" name="cnewpass" placeholder="Confirm New Password" required>


                        <button type="submit" name="resetPass">
                            Reset Password
                        </button>
                    </form>
                </div>

            </div>

        </div>

    </main>

    <!--Footer-->
    <footer>
        <div>
            <p>Lorem ipsum dolor sit amet <br> consectetur adipisicing elit. Fugiat facilis <br> dolore ipsa officiis
                natus ex nam
                odio tempora in.</p>
        </div>
        <div>

        </div>
        <div>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat facilis dolore ipsa officiis natus ex nam
                odio tempora in.</p>
        </div>
    </footer>


</body>




</html>