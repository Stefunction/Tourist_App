<?php

session_start();    # To change navigation bar tabs when user logs in

?>
<!DOCTYPE html>
<html lang="en">

<!-- Linking the stylesheet-->

<head>
    <title>Aventura</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Styling -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Boostrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <!-- Styling CSS -->
    <link rel="stylesheet" href="Assets/CSS/style.css">
    <link rel="stylesheet" href="assets/css/w3.css">

    <style>
        body,
        h1,
        h2,
        h3,
        h5,
        h6 {
            font-family: "Raleway", sans-serif
        }
    </style>
</head>

<!-- Beginning of Body Tag -->

<body class="home">
    <div class="container-fluid ">
        <!-- Header section, Including the navbar php file-->
        <?php include("navbar.php") ?>

        <!-- Beginning of Main body -->
        <main class="container-fluid">
            <!-- Beginning of row -->
            <div class="row">
                <!-- First Half of Column -->
                <div class="col-8 col-md-8">
                    <!-- OverLaid Home grid pictures -->
                    <div class="grid-container">
                        <img class="img-fluid img_1" src="Assets/Images/overlay/elephants.jpg" alt="Snow">
                        <img class="img-fluid img_2" src="assets/images/overlay/beads.jfif" alt="Snow"">
                        <img class=" img-fluid img_3" src="Assets/images/overlay/tanzania.jpg" alt="Snow"">
                    </div>
                </div>

                <!-- Second half of Column -->
                <div class=" col-4 col-md-4">
                        <div class="share d-flex flex-column align-items-center ">
                            <p class="text-white">Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat facilis
                                dolore ipsa
                                officiis
                                natus ex nam
                                odio tempora in.</p>
                            <a href="gallery.php" class="btn btn-info btn-lg w3-hover-lime">Gallery</a>
                        </div>
                    </div>
                </div>
                <!-- End of Row -->
        </main>
        <!-- End of Main Body -->

        <!--Footer, Including the footer file-->
        <?php include("footer.php") ?>

    </div>
</body>

</html>