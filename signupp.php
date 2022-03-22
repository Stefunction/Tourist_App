<?php
    error_reporting(E_ALL);

    require "connect.php";

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

            $query = "Insert into Users (firstname, lastname, username, gender, email, password)";
            $query .= "Values ('$firstname', '$lastname', '$username', '$gender', '$email', '$password')";

            $result=$connect->exec($query);	//execute SQL

            // if ($result){
            //     //$sucess = 
            //     //header("Location: login.php");

            // }

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
    
    <link rel="stylesheet" href="Assets/CSS/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
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
    <title>Aventura</title>
</head>

<body>
    <!-- Header section -->
    <header>
        <hr>
        <div>
            <!-- Aventura Logo -->
            <div>
                <a id="logo" href="#"><img src="img/abc.jpg" alt="Logo">
                    <span title="Click logo for Home Page">Tanzanian Beauty</span>
                </a>
            </div>

            <!-- Navigation links -->
            <div>
                <nav>
                    <ul>
                        <li><a href="gallery.html">Gallery</a></li>
                        <li><a href="#">Login</a></li>
                        <li><a href="#">SignUp</a></li>
                        <li><a href="#">About</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>


    <main class="container">
        <div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                
                <label for="firstname">Full name: </label>
                <input type="text" id="firstname" name="firstname">
                <span style="color:red;"><?php echo $errMesg; ?></span><br><br>


                <label for="lastname">Last name: </label>
                <input type="text" id="lastname" name="lastname"><br><br>

                <label for="username">Username: </label>
                <input type="text" id="username" name="username">
                <span class = "errorsign"><?php echo $errMesg; ?></span><br><br>

                <label for="gender">Gender: </label>
                <select type="text" id="gender" name="gender">
                    <option value='F'>Female</option>
                    <option value='M'>Male</option>
                </select>


                <label for="email">Email: </label>
                <input type="email" id="email" name="email">
                <span class = "errorsign"><?php echo $errMesg; ?></span><br><br>


                <div>
                <label for="password">Password: </label>
                <input type="password" id="password" name="password" required>
                <span class = "errorsign"><?php echo $errMesg; ?></span><br><br>

                <label for="Cpassword">Confirm Password: </label>
                <input type="password" id="Cpassword" name="Cpassword" required>
                <div class="alert" id="checkpassword"><?php echo $perrMesg; ?> </div>

                </div>

                <input type="checkbox" name="agree" value="agree"> Agree to Terms and Conditions

                <button type="submit" id="signup" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signedmodal">SignUp</button>
            </form>

<?php
    if (Isset($result)){
        echo 
        "<div class='modal fade' id='signedmodal' tabindex='-1' aria-labelledby='exampleModalLabel' aria-hidden='true'>
          <div class='modal-dialog'>
            <div class='modal-content'>
              <div class='modal-header'>
                <h5 class='modal-title' id='exampleModalLabel'>Modal title</h5>
                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
              </div>
              <div class='modal-body'>
                ...
              </div>
              <div class='modal-footer'>
                <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                <button type='button' class='btn btn-primary'>Save changes</button>
              </div>
            </div>
          </div>
        </div>";

    }
?>










            <div>
                <p>----- OR -----</p>
                <p>Sign up with <a href="#"><img src="#" alt="google link"></a></p>
            </div>
        </div>

        <aside>
            <img src="#" alt="Video/slideshow">
            <!--add a slideshow-->
            <p>add some smal captions that explains the video </p>
        </aside>

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