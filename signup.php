<?php
error_reporting(E_ALL);         # Errors encountered are reported

require "connect.php";          # Establish a connection with the PDO object created

session_start();

// If Logged On to the system, redirect to either
if (isset($_SESSION["username"]) && $_SESSION["roleID"] == 1) {         # User Home Page

    $_SESSION["status"] = "Already signed in ";
    $_SESSION["icon"] = "info";
    $_SESSION["display"] = "Redirecting....";
    $location = "Location: home.php";
    header($location);
    exit();
} else if (isset($_SESSION["username"]) && $_SESSION["roleID"] == 2) {      # Admin Home Page

    $_SESSION["status"] = "Already signed in ";
    $_SESSION["icon"] = "info";
    $_SESSION["display"] = "Redirecting....";
    $location = "Location: admin.php";
    header($location);
    exit();
}

// Function to validate input to the system
function _checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {             # To check if form was submitted

    // Assign the various inputs to variables
    $firstname = _checkInput($_POST["firstname"]);
    $lastname = _checkInput($_POST["lastname"]);
    $username = _checkInput($_POST["username"]);
    $gender = _checkInput($_POST["gender"]);
    $email = _checkInput($_POST["email"]);
    $password = _checkInput($_POST["password"]);
    $Cpassword = _checkInput($_POST["Cpassword"]);

    // Confirm Password and Confirm are the same
    if ($password == $Cpassword) {

        $probeEmail = "Select email FROM Users where email = '$email' ";        # check if email exists in database
        $probeEmailResult = $connect->query($probeEmail);                       # SQL statement to query database

        if ($probeEmailResult->rowCount() > 0) {
            $_SESSION["status"] = "Email already Registered ";
            $_SESSION["icon"] = "error";
            $_SESSION["display"] = "Thank you...";
            $location = "Location: signup.php";
            header($location);
            exit();
        } else {

            $probeName = "Select username FROM Users where username = '$username'";        # check if username exists in database
            $probeNameResult = $connect->query($probeName);                                # SQL statement to query database

            if ($probeNameResult->rowCount() > 0) {
                $_SESSION["status"] = "Username already Taken ";
                $_SESSION["icon"] = "info";
                $_SESSION["display"] = "Pick another one";
                header("Location: signup.php");
                exit();
            } else {

                /* Hashing the Password */
                $options = [
                    'cost' => 12,
                ];
                $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);

                // Insert / Register User into the Database
                $query = "Insert into Users (firstname, lastname, username, genderID, email, password)";
                $query .= "Values ('$firstname', '$lastname', '$username', '$gender', '$email', '$hashed_password')";

                $result = $connect->exec($query);    //execute SQL

                // If Registration goes through
                if ($result) {
                    $_SESSION["status"] = "Registration Successful!!!";
                    $_SESSION["icon"] = "success";
                    $_SESSION["display"] = "You can now login.";
                    $location = "Location: login.php";
                    header($location);
                    exit();
                } else {
                    $_SESSION["status"] = "Registration not Successful!!!";
                    $_SESSION["icon"] = "Error";
                    $_SESSION["display"] = "Try again Later";
                    $location = "Location: signup.php";
                    header($location);
                    exit();
                }
            }
        }
    } else {
        $_SESSION["status"] = "Both Passwords are not the same";        # If passwords are different
        $_SESSION["icon"] = "warning";
        $_SESSION["display"] = "Retype please";
        $location = "Location: signup.php";
        header($location);
        exit();
    }

    $connect = null;            # Terminate PDO object
}

?>



<!DOCTYPE html>
<html lang="en">

<!-- Linking the stylesheet-->

<head>
    <title>SignUp page</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Styling -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Boostrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Ajax JQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <!-- w3 CSS -->
    <link rel="stylesheet" href="Assets/CSS/w3.css">
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="Assets/CSS/style.css">

    <!-- Script to check if passwords are the same-->
    <script>
        $(function() {
            $("#Cpassword").keyup(function() {
                var match = $("#password").val();
                $("#checkpassword").html(match == $(this).val() ?
                    "Password matches" :
                    "Both password combination must be same"
                );
            });
        });
    </script>

    <script>
        // Function to disable form submission if there are empty fields
        $(function() {
            'use strict'

            // Get the class of the forms to check validation
            var forms = document.querySelectorAll('.needs-validation')

            // Iterate over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })
    </script>

</head>


<body id="signup">

    <div class="container-fluid">
        <!-- Header section -->
        <?php include("navbar.php") ?>

        <!-- Beginning of main header -->
        <main class="container-fluid me-2 mx-2">

            <div class="row text-white">

                <div class="col-lg-7 col-md-6">

                    <div class="d-flex flex-column">

                        <!-- Sign Up Form -->
                        <form class="form_contain needs-validation" novalidate method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

                            <div class="row text-center my-4">
                                <h3>SIGNUP HERE</h3>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <label for="firstname" class="form-label">First name: </label>
                                    <input type="text" class="form-control " id="firstname" name="firstname" required>
                                    <div class="invalid-feedback">First Name Please</div>
                                </div>

                                <div class="col-md-6">
                                    <label for="lastname" class="form-label">Last name: </label>
                                    <input type="text" class="form-control" id="lastname" name="lastname" required>
                                    <div class="invalid-feedback">Last name Please</div><br>
                                </div>

                                <div class="col-md-5">
                                    <label for="username" class="form-label">Username</label>
                                    <div class="input-group has-validation">
                                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                                        <input type="text" class="form-control" id="username" name="username" aria-describedby="inputGroupPrepend" required>
                                        <div class="invalid-feedback">Please choose a username.</div>
                                    </div>
                                </div>

                                <div class="col-md-7">
                                    <label for="gender" class="form-label">Gender: </label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option value='F'>Female</option>
                                        <option value='M'>Male</option>
                                    </select>
                                    <div class="invalid-feedback">Please select an option</div><br>
                                </div>

                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email: </label>
                                    <input type="email" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Input a valid email address" required>
                                    <div class="invalid-feedback">Email is required</div><br>
                                </div>

                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password: </label>
                                    <input type="password" class="form-control" id="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required>
                                    <div class="invalid-feedback">Password does not meet requirements<br>Hover for more</div>
                                    <br>
                                </div>

                                <div class="col-md-6">
                                    <label for="Cpassword" class="form-label">Confirm Password: </label>
                                    <input type="password" class="form-control" id="Cpassword" name="Cpassword" required>
                                    <!-- <div class="alert" ></div> -->
                                    <div class="invalid-feedback" id="checkpassword">Confirm Password</div>
                                    <br>
                                </div>

                                <div class="col-8">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                        <label class="form-check-label" for="invalidCheck"><a href="#" style="color: white;">
                                                Agree to terms and conditions</a>
                                        </label>
                                        <div class="invalid-feedback">Do agree to the terms and conditions stated</div>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <button type="submit" class="btn btn-primary">SignUp</button>
                                </div>

                            </div>

                        </form>

                    </div>

                </div>

                <div class="col-lg-5 col-md-6 d-sm-none d-md-block">

                    <div class="w3-content w3-section" style="max-width:500px">

                        <img class="mySlides signup_Image" src="assets/Images/carousel/africa.webp" style="width:100%; height: 470px;">
                        <img class="mySlides signup_Image" src="assets/Images/carousel/logo.png" style="width:100%">
                        <img class="mySlides signup_Image" src="assets/Images/carousel/tanzania.jpg" style="width:100%; height: 470px">
                        <img class="mySlides signup_Image" src="assets/Images/carousel/butterfly.avif" style="width:100%; height: 470px">
                        <img class="mySlides signup_Image" src="assets/Images/carousel/camera.avif" style="width:100%; height: 480px;">

                    </div>

                </div>

            </div>

        </main>

    </div>

</body>


<!-- Side Picture Carousel -->
<script>
    var myIndex = 0;
    carousel();

    function carousel() {
        var i;
        var x = document.getElementsByClassName("mySlides");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        myIndex++;
        if (myIndex > x.length) {
            myIndex = 1
        }
        x[myIndex - 1].style.display = "block";
        setTimeout(carousel, 1700); // Change image every 2 seconds
    }
</script>

<!-- Sweet Alert plugin and stylesheet -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<?php
if (isset($_SESSION["status"])) {
?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            swal({
                title: "<?php echo $_SESSION["status"] ?>",
                text: "<?php echo $_SESSION["display"] ?>",
                icon: "<?php echo $_SESSION["icon"] ?>",
                button: "Close!",
            });
        });
    </script>


<?php
    unset($_SESSION["status"]);
}
?>

</html>