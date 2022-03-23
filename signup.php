<?php
    error_reporting(E_ALL);

    require "connect.php";

    session_start();

    if (isset($_SESSION["username"])) {   //if  logged on	
        echo "Already signed in";
        header("Location: home.php");       //redirect to home page----- work on thiss to say already signed in
        exit();
    }

    function _checkInput($data){ #to validate input
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $errMesg = "";
    $perrMesg = "";
    $result = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") { #to check if form was submitted

        if (empty(($_POST["firstname"]) && ($_POST["username"]) && ($_POST["email"]) && ($_POST["password"]))){
            
            $errMesg = " * Necessary Fields required";

        }
        elseif (($_POST["password"]) != ($_POST["Cpassword"])){
            $perrMesg = " Passwords must be the same --- Form not Submitted";
        }
        else{
            $firstname = _checkInput($_POST["firstname"]); #to get the usernam input from login form
            $lastname = _checkInput($_POST["lastname"]);
            $username = _checkInput($_POST["username"]);
            $gender = _checkInput($_POST["gender"]);
            $email = _checkInput($_POST["email"]);
            $password = _checkInput($_POST["password"]);

            /* Hashing the Password */
            $options = [ 
                'cost' => 12,
            ];
            $hashed_password = password_hash($password, PASSWORD_BCRYPT, $options);


            $query = "Insert into Users (firstname, lastname, username, genderID, email, password)";
            $query .= "Values ('$firstname', '$lastname', '$username', '$gender', '$email', '$hashed_password')";

            $result=$connect->exec($query);	//execute SQL

            if ($result){
                $_SESSION["status"] = "Registration Successful!!!";
                header("Location: login.php");
            }else{
                $_SESSION["status"] = "Registration not Successful!!!";
                header("Location: signup.php");
            }

	        $connect=null;	
        }
    
    }

?>




<!DOCTYPE html>
<html lang="en">

<!-- Linking the stylesheet-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp page</title>
    <link rel="stylesheet" href="Assets/CSS/style.css">
    <link rel="stylesheet" href="Assets/CSS/w3.css">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
    <script>
        $(function() {
            $("#Cpassword").keyup(function(){
                var match = $("#password").val();
                $("#checkpassword").html(match == $(this).val()
                    ? "Password matches"
                    : "Both password combinatination must be same"
                );
            });
        });
    </script>
    <script>
        // Function to disable form submission if there are empty fields
        $(function () {
            'use strict'

            // Get the class of the forms to check validation
            var forms = document.querySelectorAll('.needs-validation')

            // Iterate over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
    <title>Aventura</title>
</head>

<body id="signup">
    <div class="container-fluid">
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
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#nav_collapse" aria-controls="nav_collapse" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!--Assigning the id of the buttion to the div class housing the varius links-->
                <div class="collapse navbar-collapse" id="nav_collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.html">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="gallery.html">Gallery</a></li>
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


    <main class="container" >
        <div class="row">
        <div class="col-7">
            <div class="d-flex flex-column">
            <form class="form_contain needs-validation" novalidate method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                
            <div class="row"><h5>Signup Here</h5></div>

           <div class="row">
            <div class="col-md-6">
                <label for="firstname" class="form-label col-3">First name: </label>
                <input type="text" class="form-control " id="firstname" name="firstname" required>
                <div class = "invalid-feedback" ><?php echo $errMesg; ?></div>
            </div>

            <div class="col-md-6">
                <label for="lastname" class="form-label col-3">Last name: </label>
                <input type="text" class="form-control" id="lastname" name="lastname" required>
                <span class = "invalid-feedback"><?php echo $errMesg; ?></span><br>
            </div>
            

            <div class="col-md-5">
                <label for="username" class="form-label">Username</label>
                <div class="input-group has-validation">
                    <span class="input-group-text" id="inputGroupPrepend">@</span>
                    <input type="text" class="form-control" id="username" name="username"  
                    aria-describedby="inputGroupPrepend" required>
                    <!-- <div class="invalid-feedback">
                    Please choose a username.
                </div> -->
                <span class = "errorsign"><?php echo $errMesg; ?></span><br><br>
                </div>
            </div>

            <div class="col-md-7">
                <label for="gender" class="form-label">Gender: </label>
                <select class="form-select" id="gender" name="gender" required>
                    <option selected disabled value="">Choose...</option>
                    <option value='F'>Female</option>
                    <option value='M'>Male</option>
                </select><br>
                <!-- <div class="invalid-feedback">
                Please select a valid state.
            </div> -->
            </div>

            <div class="col-md-12">
                <label for="email" class="form-label">Email: </label>
                <input type="email" class="form-control" id="email" name="email" required>
                <!-- <div class="invalid-feedback">
                Please provide a valid city.
            </div> -->
            <span class = "errorsign"><?php echo $errMesg; ?></span><br>
            </div>

            <div class="col-md-6">
                <label for="password" class="form-label">Password: </label>
                <input type="password" class="form-control" id="password" name="password" required>
                <!-- <div class="invalid-feedback">
                Please provide a valid city.
            </div> -->
            <span class = "errorsign"><?php echo $errMesg; ?></span><br><br>
            </div>
             
            <div class="col-md-6">
                <label for="Cpassword" class="form-label">Confirm Password: </label>
                <input type="password" class="form-control" id="Cpassword" name="Cpassword" required>
                <div class="alert" id="checkpassword"><?php echo $perrMesg; ?> </div>
                <!-- <div class="invalid-feedback">
                Please provide a valid city.
            </div> -->
            <span class = "errorsign"><?php echo $errMesg; ?></span><br><br>
            </div>
            <div class="col-8">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                        Agree to terms and conditions
                    </label>
                    <!-- <div class="invalid-feedback">
                    You must agree before submitting.
                </div> -->
                </div>
            </div>
            <div class="col-4">
            <button type="submit"  class="btn btn-primary">SignUp</button>
                <!-- <button class="btn btn-primary" type="submit">Submit form</button> -->
            </div>
            
            <div class="col-12">
                <p>----- OR -----</p>
            </div>
            <div class="col-12">
                <p>Sign up with <a href="#"><img src="#" alt="google link"></a></p>
            </div>
            </div>
            </form>

            
            </div>
            
        </div>

        <div class="col-5">
        <aside>
            <img src="#" alt="Video/slideshow">
            <!--add a slideshow-->
            <p>add some smal captions that explains the video </p>
        </aside>
        </div>
        </div>

    </main>

    <!--Footer-->
    <!-- <footer>
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
    </footer> -->
    </div>
</body>

</html>
