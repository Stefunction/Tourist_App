<?php
	session_start();			//retrieve session		

	if (IsSet($_SESSION["userID"]) || IsSet($_SESSION["username"])){	//if  logged on	
		header("Location: home.php");	   //redirect to home page
        exit();         
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
    <title>Aventura</title>
</head>

<body>
    <!-- Header section -->
    <header >
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
        <!--content-->
        <div class="row"> <!--row-->

            <div class="col"> <!--col 1-->
                <p>Lorem ipsum dolor sit amet <br> consectetur adipisicing elit. Fugiat facilis <br> dolore ipsa officiis
                natus ex nam
                odio tempora in.</p>
            </div>
           
            <div class="col"> <!--col 1-->
                <form id="login" method="post" action="verify.php">
                    <img src="#" alt="User logo">
                    <hr>
                    <input type="text" name="username" placeholder="Username">
                    <input type="password" name="password" placeholder="Password">
                    
                    <input type="reset"><!--reset pass-->
                    <button type="submit">Login</button> 

                </form>

                



               
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