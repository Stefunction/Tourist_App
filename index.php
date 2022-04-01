<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">

<!-- Linking the stylesheet-->

<head>
    <title>Aventura</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Cinzel|Fauna+One">
    <!-- <link href='https://fonts.googleapis.com/css?family=Akaya Kanadaka' rel='stylesheet'> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="Assets/CSS/style.css">

</head>

<body class="home">
    <div class="container-fluid ">
        <!-- Header section -->
        <?php include("navbar.php") ?>


        <main class="container-fluid">
            <div class="row">
                <div class="col-8 col-md-8">
                    <div class="grid-container">
                        <img class="img-fluid img_1" src="Assets/Images/elephants.jpg" alt="Snow">
                        <img class="img-fluid img_2" src="Assets/Images/mountain_top.jpg" alt="Snow"">
                        <img class=" img-fluid img_3" src="Assets/Images/tan_1.jpg" alt="Snow"">
                    </div>
                </div>

                <div class=" col-4 col-md-4">
                        <!--col 1-->
                        <div class="share d-flex flex-column align-items-center ">
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat facilis
                                dolore ipsa
                                officiis
                                natus ex nam
                                odio tempora in.</p>
                            <!-- <a href="gallery.html" class="w3-button w3-black">Gallery</a> -->
                            <a href="gallery.html" class="btn btn-outline-info btn-lg">Gallery</a>
                            <!--change button class-->
                        </div>
                    </div>

                </div>

        </main>

        <!--Footer-->
        <?php include("footer.php") ?>

    </div>

</body>

</html>