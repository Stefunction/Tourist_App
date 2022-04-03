<?php
session_start();            //retrieve session		

require "connect.php";

$query = "select userName, uploadPath, description, categoryName, date, url from uploads, category";
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

    <script src="//code.jquery.com/jquery-1.12.0.min.js"></script>

    <!-- Load the JavaScript which set up the event handler, etc. -->
    <script src="galleryAjax.js"></script>
    <!-- <script src="timeAjax.js"></script> -->




</head>

<body>
    <!-- Header section -->
    <div class="container-fluid">
        <?php include("navbar.php") ?>

        <main class="container-fluid">
            <div class="w3-row">


                <div class="row mb-3 my-1">

                    <div class="d-flex">
                        <label for="category-input" class="me-2 col-form-label">Category:</label>
                        <div class="me-3">
                            <input id="keyword" class="me-2 form-control" name="category" list="datalistOptions" placeholder="Type to search...">
                            <datalist id="datalistOptions">
                                <option value="Food">
                                <option value="Culture">
                                <option value="Adventure">
                                <option value="History">
                                <option value="Others">
                            </datalist>
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary" id="searchButton">Search</button>
                        </div>
                        <div class="p-2"><span class="text-muted">NB: Clear Field and Search to Refresh</span></div>
                    </div>


                </div>





                <div class="w3-row">
                    <div class="w3-row-padding">
                        <!--col for images-->
                        <?php

                        if ($result->rowCount() == 0) {

                        ?>

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
                        } else { ?>

                            <div id="gallery-grid" class="row">







                            </div>

                        <?php

                        }
                        $connect = null;
                        ?>



                    </div>

                </div>



            </div>

        </main>

        <!--Footer-->
        <?php include("footer.php") ?>


    </div>
</body>

</html>