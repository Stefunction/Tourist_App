<?php
session_start();            //retrieve session		


// if (!isset($_SESSION["username"])) {            //if not previoulsly logged on	

// }              //do not display comment section--- to do

// $username = $_SESSION["username"];    //get user name into variable $username

require "connect.php";

$query = "select uploadPath, description, categoryName, date, url from uploads, category";
$query .= " WHERE uploads.categoryID = category.categoryID";


$result = $connect->query($query);    //execute SQL

?>


<!DOCTYPE html>
<html lang="en">

<!-- Linking the stylesheet-->

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Assets/CSS/style.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Aventura</title>




    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <!-- <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> style font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />


    <script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script> <!-- Preview JS for file Upload -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <!-- Bootstrap with Popper -->






</head>

<body>
    <!-- Header section -->
    <div class="container-fluid">
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





        <main class="container-fluid">
            <div class="w3-row">
                <div class="w3-quarter">
                    <form>
                        <div class="row">
                            <!--col for filter and buttons-->

                            <div class="col">
                                <label for="date">Date: </label>
                                <input type="date" name="date" min="2022-01-01">
                            </div>

                            <div class="col">
                                <label for="date">Category: </label>
                                <input list="category">
                                <datalist id="category" name="category">
                                    <option value="testing"></option>
                                    <!--append value from database-->
                                    <option value="Firefox">
                                    <option value="Chrome">
                                    <option value="Opera">
                                </datalist>
                                <!--select from list in database-->
                            </div>

                            <div class="col">
                                <label for="date">Location: </label>
                                <datalist id="location" name="location">
                                    <option value="testing"></option>
                                    <!--append value from database-->

                                </datalist>
                                <!--select from list in database-->
                            </div>

                        </div>
                        <div class="row">
                            <button type="submit">Submit</button>
                        </div>
                    </form>
                </div>

                <div class="w3-threequarter">
                    <div class="w3-row-padding">
                        <!--col for images-->
                        <?php

                        if ($result->rowCount() == 0) {

                        ?>
                            <!-- <div class="picture" style="background-image:url(Assets/Images/img_snowtops.jpg) ; background-position: center;
                    background-size: contain; width: 400px; height: 300px; background-repeat: no-repeat;">
                
                </div> -->
                            <div class="w3-card-4 w3-third w3-container w3-margin-bottom">
                                <!-- <img src="<?php echo $imgPath ?>" alt="Uploaded_Pic Description" style="width:100%" class="w3-hover-opacity"> -->

                                <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                    <title>Placeholder</title>
                                    <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                                </svg>


                                <div class="w3-container w3-white">
                                    <h5><b>Lorem Ipsum</b></h5><span> -- / -- / ----</span><br>
                                    <p class="p-2">No Data Entered by any User yet</p>
                                </div>
                            </div>

                            <?php
                        } else {

                            foreach ($result as $img) {

                                $imgPath = $img["uploadPath"];
                                $imgDescription = $img["description"];
                                $imgCategory = $img["categoryName"];
                                $imgdate = $img["date"];
                                $imgurl = $img["url"];
                            ?>

                                <div class="w3-card-4 w3-third w3-container w3-margin-bottom">
                                    <img src="<?php echo $imgPath ?>" alt="Uploaded_Pic Description" style="width:100%" class="w3-hover-opacity">

                                    <div class="w3-container w3-white">
                                        <h5><b>Lorem Ipsum</b></h5><span><?php echo $imgdate ?></span><br>
                                        <p class="p-2"><?php echo $imgDescription ?>!</p>
                                    </div>
                                </div>











                                <!-- <div class="w3-card-4 w3-third w3-container w3-margin-bottom">
                        <img src="assets/Images/testing mountains.jpg" alt="Uploaded_Pic Description" style="width:100%" class="w3-hover-opacity">

                        <div class="w3-container w3-white">
                            <h5><b>Lorem Ipsum</b></h5><span>22/03/21</span><br>
                            <p class="p-2">Testing here</p>
                        </div>
                    </div> -->





                        <?php
                            }
                        }
                        $connect = null;
                        ?>




                        <!-- <div class="picture" style="border: 1px solid red; max-width: 200px;">
                    <img class="img-fluid" src="Assets/Images/img_snowtops.jpg" alt="Snow">
                </div>
                <div class="picture" style="border: 1px solid red; max-width: 200px;">
                    <img class="img-fluid" src="Assets/Images/img_snowtops.jpg" alt="Snow">
                </div>
                <div class="picture" style="border: 1px solid red; max-width: 200px;">
                    <img class="img-fluid" src="Assets/Images/img_snowtops.jpg" alt="Snow">
                </div> --> -->
                        <!-- <div class="item1">1</div>
                <div class="item2">2</div>
                <div class="item3">3</div>  
                <div class="item4">4</div>
                <div class="item5">5</div>
                <div class="item6">6</div>
                <div class="item7">7</div> -->

                        <!-- <div class="slideshow">to put video here</div> -->
                    </div>

                </div>



            </div>

        </main>

        <!--Footer-->
        <footer>
            <div>
                <p>Lorem ipsum dolor sit amet <br> consectetur adipisicing elit. Fugiat facilis <br> dolore ipsa
                    officiis
                    natus ex nam
                    odio tempora in.</p>
            </div>
            <div>

            </div>
            <div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fugiat facilis dolore ipsa officiis natus ex
                    nam
                    odio tempora in.</p>
            </div>
        </footer>


    </div>
</body>

</html>