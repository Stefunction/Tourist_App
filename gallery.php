<?php
session_start();            //retrieve session		

require "connect.php";      // Establish a connection with the PDO object created

$query = "select userName, uploadPath, description, categoryName, date, url from uploads, category";
$query .= " WHERE uploads.categoryID = category.categoryID";

$result2 = $connect->query($query);    //execute SQL

?>


<!DOCTYPE html>
<html lang="en">

<!-- Linking the stylesheet-->

<head>
    <title>Gallery Page</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Styling -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <!-- Font- Awesome (ICon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Boostrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="//code.jquery.com/jquery-1.12.0.min.js"></script> -->

    <!-- W3 CSS  -->
    <link rel="stylesheet" href="./Assets/CSS/w3.css">
    <!-- CSS Style sheets -->
    <link rel="stylesheet" href="assets/CSS/style.css">

    <!-- JS to load event handler -->
    <script src="galleryAjax.js"></script>

</head>


<!-- Beginning of body Tag -->

<body class="gall">
    <!-- Header section -->
    <div class="container-fluid">
        <!-- Header -->
        <?php include("navbar.php") ?>

        <!-- Beginning of main body -->
        <main class="container-fluid">

            <div class="w3-row">

                <div class="row mb-3 my-1">

                    <!-- To cature input keywords -->
                    <form action="">

                        <div class="d-flex bg-white p-3" style="border-radius: 8px;">
                            <label for="category-input" class="me-2 col-form-label text-black">Category:</label>

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
                                <button id="clear" class="w3-xlarge w3-amber"><i class="fa fa-refresh fa-fw"></i></button>
                            </div>

                            <div class="p-2"><span class="text-black">NB: Type a Keyword or Click on input Tab to select an Option</span></div>

                        </div>

                    </form>

                </div>

                <!-- Grid for Gallery -->
                <div class="w3-row">

                    <div class="w3-row-padding">

                        <!-- Initial Fill of grid from DB  -->
                        <?php

                        // IF empty result returned

                        if ($result2->rowCount() == 0) {

                        ?>

                            <div class="w3-card-4 w3-third w3-container w3-margin-bottom">

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
                        }
                        // Else tabulate initial Fill of grid from DB
                        else {
                        ?>
                            <div id="gallery-grid" class="row">
                                <?php

                                foreach ($result2 as $row) {
                                ?>

                                    <div class="col-md-4">
                                        <div class="card">
                                            <img src="<?php echo $row["uploadPath"]  ?>" alt='Uploaded_Pic Description' style='width:100%' class='w3-hover-opacity card-img-top'>

                                            <div class="card-body">
                                                <h5 class="p-2"><b><?php echo $row["categoryName"] ?></b></h5>
                                                <div class="row">
                                                    <p class="col-md-6">Owner: <?php echo $row["userName"] ?></p>
                                                    <p class="col-md-6">Date: <?php echo $row["date"] ?></p>
                                                    <p class="col"><strong>Description: </strong> <?php echo $row["description"] ?></p>
                                                    <p class="col-md-12"><strong>URL: </strong> <?php echo $row["url"] ?></p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
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

<!-- Script to set keyup to a null value -->
<script>
    $("#clear").on("click", function() {
        var keyword = document.querySelector("#keyword");
        // console.log(keyword);
        keyword.value = '';
        $("#keyword").trigger("keyup");
    });
</script>

</html>