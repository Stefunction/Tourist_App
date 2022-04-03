<?php
session_start();            #retrieve session		

if (isset($_SESSION["username"]) && $_SESSION["username"] == 1)        # if logged on	
{
    $_SESSION["status"] = "Already signed in ";     // Prompt user to remind 
    $_SESSION["icon"] = "info";
    $location = "Location: home.php";
    header($location);
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
    <link rel="stylesheet" href="Assets/CSS/w3.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="Assets/CSS/style.css">
    <title>Login Page</title>



</head>

<body class="log">
    <div class="container-fluid">
        <!-- Header section -->
        <?php include("navbar.php") ?>


        <main class="container">
            <!--content-->
            <div class="row g-5">
                <!--row-->

                <div class="col-md-6 d-flex align-items-center justify-content-center pe-4">
                    <!--col 1-->
                    <div class="p-4">
                        <p class="login-left-text text-center text-white">Dare to Dream...., Dare to Speak...., <br> Tell your Story and let us pick.<br> Remember,<br> "I am You"
                            and "You are Me", <br>Hop Right in and lets paint our Space.....
                        </p>
                    </div>

                </div>

                <div class="col-md-6">
                    <div class="d-flex justify-content-center">
                        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" fill="currentColor" class="mb-2 text-info" viewBox="0 0 16 16">
                            <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                            <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
                        </svg>
                    </div>

                    <form method="POST" action="verify.php">
                        <div class="mb-3">
                            <label for="username-input-1" class="form-label text-white">Username</label>
                            <input type="text" name="username" class="form-control" id="username-input-1">
                        </div>

                        <div class="mb-3">
                            <label for="password-input-1" class="form-label text-white">Password</label>
                            <input type="password" name="password" class="form-control" id="password-input-1">
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-lg btn-primary">Login</button>
                        </div>
                    </form>

                    <hr>

                    <div class="row text-white">

                        <h4>Forgot Password??</h4>

                        <form method="POST" action="verify.php">

                            <div class="mb-3">
                                <label for="username-input-2" class="form-label ">Username</label>
                                <input type="text" name="username" class="form-control" id="username-input-2" required>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-6">
                                    <label for="password-input-1" class="form-label">New Password</label>
                                    <input type="password" class="form-control" id="password-input-2" name="newpass" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                </div>

                                <div class="mb-3 col-md-6">
                                    <label for="password-input-1" class="form-label">Confirm New Password</label>
                                    <input type="password" class="form-control" id="password-input-3" name="cnewpass" required>
                                </div>
                            </div>


                            <div class="d-flex justify-content-center">
                                <button class="btn btn-lg btn-outline-primary" type="submit" name="resetPass">
                                    Reset Password
                                </button>
                            </div>
                        </form>
                    </div>

                </div>

            </div>

        </main>


        <!--Footer-->
        <?php include("footer.php") ?>

    </div>


</body>




</html>