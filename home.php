<?php
session_start();            #retrieve session		

require "connect.php";     # Establish a connection with the PDO object created

if (!isset($_SESSION["username"]))          # if not logged on	
{
    header("Location: login.php");          # redirect to login page
}

$username = $_SESSION["username"];              # get user name into variable $username

$firstname = $_SESSION["firstname"];            # get names into variable $username

$lastname = $_SESSION["lastname"];

$email = $_SESSION["email"];

$password = $_SESSION["password"];

//  SQL statements to carry out instructions
$query = "select uploadID, uploadPath, description, categoryName, date, url from uploads, category";
$query .= " WHERE uploads.categoryID = category.categoryID and userName =  '$username' ";

$result = $connect->query($query);    //execute SQL

//  SQL statements to carry out instructions
$query2 = "select uploadID, uploadPath, description, categoryName, date, url from uploads, category";
$query2 .= " WHERE uploads.categoryID = category.categoryID and userName =  '$username' ";

$result2 = $connect->query($query2);    //execute SQL

?>


<!-- Check if there is a session status to display -->
<?php
if (isset($_SESSION["status"])) {
?>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            swal({
                title: "<?php echo $_SESSION["status"] . $username ?> ",
                icon: "<?php echo $_SESSION["icon"] ?>",

                button: "Close!",
            });
        });
    </script>

<?php
    unset($_SESSION["status"]);
}
?>




<!DOCTYPE html>
<html>

<head>

    <title>User Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Font Styling -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <!-- Font- Awesome (ICon) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Boostrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Image Preview CSS-->
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />
    <!-- Image preview JS -->
    <script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>
    <!-- bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Windows colours for styling -->
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-colors-win8.css">
    <!-- W3 CSS -->
    <link rel="stylesheet" href="assets/CSS/w3.css">
    <!-- CSS Stylesheets -->
    <link rel="stylesheet" href="assets/CSS/style.css">
    <!-- Sweet Alert plugin and stylesheet -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


    <script>
        // Script to open and close sidebar
        function w3_open() {
            document.getElementById("profile_Side").style.display = "block";
            document.getElementById("profile_Overlay").style.display = "block";
        }

        function w3_close() {
            document.getElementById("profile_Side").style.display = "none";
            document.getElementById("profile_Overlay").style.display = "none";
        }

        // Script to include and exclude adventure and add section
        function add_adventure() {
            document.getElementById("div_add").style.display = "block";
            document.getElementById("div_content").style.display = "none";
            document.getElementById("edit_profile").style.display = "none";
            document.getElementById("adventure_edit").style.display = "none";
        }

        function all_content() {
            document.getElementById("div_add").style.display = "none";
            document.getElementById("div_content").style.display = "block";
            document.getElementById("edit_profile").style.display = "none";
            document.getElementById("adventure_edit").style.display = "none";
        }

        function edit_personal() {
            document.getElementById("div_add").style.display = "none";
            document.getElementById("div_content").style.display = "none";
            document.getElementById("edit_profile").style.display = "block";
            document.getElementById("adventure_edit").style.display = "none";
        }

        function advent_edit() {
            document.getElementById("adventure_edit").style.display = "block";
            document.getElementById("div_add").style.display = "none";
            document.getElementById("div_content").style.display = "none";
            document.getElementById("edit_profile").style.display = "none";
        }

        // Script to launch the redo and delete modal
        function launchRedo(imgID) {
            document.getElementById('redo').style.display = 'block';
            var imageInput = document.querySelector("#uploadID");
            imageInput.value = imgID;
        }

        function launchDelete(imgID) {
            document.getElementById('delete_adventure').style.display = 'block';
            var adventureInput = document.querySelector("#adventureID");
            adventureInput.value = imgID;
        }
    </script>


    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-family: "Raleway", sans-serif
        }
    </style>

</head>


<body class="w3-light-grey w3-content" style="max-width:1600px">

    <div class="container-fluid">

        <!-- Header section -->
        <div class="w3-black">
            <?php include("navbar.php") ?>
        </div>

        <main class="w3-black w3-text-black">

            <!-- Profile Sidebar Menu -->
            <nav class="w3-sidebar w3-collapse w3-black w3-animate-left" style="z-index:3;width:300px;" id="profile_Side"><br>

                <div class="w3-container">
                    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
                        <i class="fa fa-remove"></i>
                    </a>

                    <svg class="w3-round" xmlns="http://www.w3.org/2000/svg" width="100" height="80" fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                        <path d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                    </svg><br><br>
                    <h4 class="w3-win8-lime p-2" style="text-shadow:1px 1px 0 #444"><b><?php print $username; ?>'s Wall</b></h4>
                    <p class="w3-text-aqua w3-win8-brown p-2"><?php print $firstname . " " . $lastname; ?></p>
                </div>

                <div class="w3-bar-block">
                    <a href="#adventure" onclick="w3_close(), all_content()" class="w3-bar-item w3-button w3-padding w3-text-orange"><i class="fa fa-th-large fa-fw w3-margin-right"></i>My Adventures</a>
                    <a href="#about" onclick="w3_close(), edit_personal()" class="w3-bar-item w3-button w3-padding w3-text-white"><i class="fa fa-user fa-fw w3-margin-right"></i>My Personal Space</a>
                    <a href="logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-white"><i class="fa fa-close fa-fw w3-margin-right"></i>Logout</a>
                </div>

                <div class="w3-container w3-padding-top">
                    <h6 class="w3-text-orange">Follow Admin.....</h6>
                    <img src="Assets/Images/admin/IMG_20200620_083445.jpg" style="width:42%;" class="w3-round">

                    <div class="d-inline-flex">
                        <a class="link-light w3-xlarge" href="https://www.facebook.com/stephanie.udejiofor" target="_blank"><i class="fa fa-facebook-official w3-hover-opacity m-1"></i></a>
                        <a class="link-light w3-xlarge" href="https://www.instagram.com/reina.shona/" target="_blank"><i class="fa fa-instagram w3-hover-opacity m-1"></i></a>
                        <a class="link-light w3-xlarge" href="https://www.snapchat.com/add/cuteslinky/" target="_blank"><i class="fa fa-snapchat w3-hover-opacity m-1"></i></a>
                        <a class="link-light w3-xlarge" href="https://twitter.com/Steph_nmanie" target="_blank"><i class="fa fa-twitter w3-hover-opacity m-1"></i></a>
                    </div>
                </div>
            </nav>

            <!-- On smaller screens, overlay to fit -->
            <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="profile_Overlay"></div>

            <!-- Body Contents -->
            <div class="w3-main userHome pb-4" style="margin-left:300px">

                <!-- Body Header -->
                <header>

                    <a href="#"><img src="Assets/Images/admin/IMG_20200620_083445.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
                    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
                    <div class="w3-container">
                        <h1 class="w3-text-white mt-2"><b>My Adventures</b></h1>
                        <div class="w3-section w3-bottombar w3-padding-16">
                            <span class="w3-margin-right w3-text-white fw-bold">Filter:</span>

                            <button class="w3-button w3-lime" onclick="add_adventure()"><i class="fa fa-diamond w3-margin-right"></i>Add Adventure</button>
                            <button class="w3-button w3-brown" onclick="advent_edit()"><i class="fa fa-photo w3-margin-right"></i>Edit Adventure</button>
                        </div>
                    </div>

                </header>
                <!-- End of Body Header -->


                <!-- Initial content to be displayed containing previous uploads-->
                <div id="div_content">
                    <div class="w3-row-padding">

                        <?php

                        if ($result->rowCount() == 0) {

                        ?>
                            <div class="w3-third w3-container w3-margin-bottom">
                                <img src="https://www.w3schools.com/w3images/nature.jpg" alt="No Uploaded Data in your Profile." style="width:100%" class="w3-hover-opacity">
                                <div class="w3-container w3-white">
                                    <h5><b>Lorem Ipsum</b></h5><br>
                                    <p>No Uploaded Data in your Profile.!</p>
                                </div>
                            </div>

                            <?php
                        } else {

                            // Iterate over array and store variables
                            foreach ($result as $img) {

                                $imgPath = $img["uploadPath"];
                                $imgDescription = $img["description"];
                                $imgCategory = $img["categoryName"];
                                $imgdate = $img["date"];
                                $imgurl = $img["url"];
                                $imgID = $img["uploadID"] ?>

                                <div class="w3-third w3-container w3-margin-bottom">
                                    <img src="<?php echo $imgPath ?>" alt="Uploaded_Pic Description" style="width:100%" class="w3-hover-opacity">

                                    <div class="w3-container w3-white">

                                        <h5><b><?php echo $imgCategory ?></b></h5>
                                        <p><b>Date: </b> <?php echo $imgdate ?></p>
                                        <p><b>Description: </b><?php echo $imgDescription ?></p>
                                        <p><b>URL: </b><?php echo $imgurl ?></p>

                                    </div>

                                </div>

                        <?php
                            }
                        }
                        $connect = null;
                        ?>

                    </div>
                </div>


                <!-- Add Adventure Section (Initially hidden) -->
                <div class="w3-row-padding bg-white p-2 text-black" id="div_add" style="display: none;">

                    <div class="w3-win8-brown w3-margin-bottom">
                        <h3 class="text-center p-2">File Upload</h3>
                    </div>

                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="custom-file-container" data-upload-id="imageFileID">

                            <!--Preview of the uploaded Images  -->
                            <div class="w3-half w3-container w3-margin-bottom">
                                <label class="w3-win8-lime p-2">Upload Image
                                    <!-- Clear Button -->
                                    <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">
                                        &times;
                                    </a>
                                </label>

                                <label class="custom-file-container__custom-file">
                                    <input class="custom-file-container__custom-file__custom-file-input" type="file" name="FTU" id="FTU" accept="*" aria-label="Choose File" />
                                    <input type="hidden" name="MAX_FILE_SIZE" value="512000" />

                                    <span class="custom-file-container__custom-file__custom-file-control"></span>
                                </label>
                                <div class="custom-file-container__image-preview"></div>
                            </div>


                            <!-- Form Section to take descripton of upload -->
                            <div class="w3-half w3-container">

                                <div class="w3-card-4">
                                    <div class="w3-container w3-win8-lime">
                                        <h2>Tell Us More!!!</h2>
                                    </div>


                                    <div class=" w3-row-padding">
                                        <textarea class="w3-input w3-hover-khaki w3-animate-input" name="description" type="text" style="width: 100px;" placeholder="Description" rows="3" cols="40" required></textarea>
                                    </div>

                                    <div class="w3-row-padding w3-margin-top">
                                        <div class="w3-half">
                                            <input class="w3-input w3-animate-input" name="date" type="date" placeholder="Date Experienced" style="width: 100px;" required>
                                        </div>
                                        <div class="w3-half">
                                            <select class="w3-select" name="category" required>
                                                <option value="" disabled selected>Choose a Category</option>
                                                <option value="C1">Food</option>
                                                <option value="C2">Culture</option>
                                                <option value="C3">Adventure</option>
                                                <option value="C4">History</option>
                                                <option value="C5">Others</option>
                                            </select>
                                        </div>
                                    </div>

                                    <br>

                                    <div class="w3-row-padding">
                                        <span>You can include a URL here:</span>
                                        <input type="url" class="w3-animate-input" name="url" id="url">
                                    </div>

                                    <br>

                                </div>
                            </div>

                            <div class="w3-container">
                                <p><button class="w3-btn w3-lime w3-hover-brown" value="Upload" name="upload">Add new Adventure</button></p>
                            </div>

                        </div>
                    </form>
                </div>
                <!-- End Add Adventure Section (Initially hidden) -->


                <!--File Upload With Preview Initialization  -->
                <script>
                    let upload = new FileUploadWithPreview("imageFileID"); //GetImageFileID
                </script>


                <!-- Edit Adventure Story Section -->
                <div id="adventure_edit" class="pb-2" style="display: none;">

                    <!-- Grid to display uploaded Pictures-->
                    <div class=" w3-row-padding">

                        <?php

                        if ($result2->rowCount() == 0) {

                        ?>
                            <div class="w3-third w3-container w3-margin-bottom">
                                <img src="https://www.w3schools.com/w3images/nature.jpg" alt="No Uploaded Data in your Profile." style="width:100%" class="w3-hover-opacity">
                                <div class="w3-container w3-white">
                                    <h5><b>Lorem Ipsum</b></h5><br>
                                    <p>No Uploaded Data in your Profile.!</p>
                                </div>
                            </div>

                            <?php
                        } else {

                            foreach ($result2 as $img) {

                                $imgPath = $img["uploadPath"];
                                $imgDescription = $img["description"];
                                $imgCategory = $img["categoryName"];
                                $imgdate = $img["date"];
                                $imgurl = $img["url"];
                                $imgID = $img["uploadID"] ?>


                                <div class="w3-third w3-container w3-margin-bottom">
                                    <img src="<?php echo $imgPath ?>" alt="Uploaded_Pic Description" style="width:100%" class="w3-hover-opacity">

                                    <div class="w3-container w3-white pb-2">
                                        <h5><b><?php echo $imgCategory ?></b></h5>
                                        <p><b>Date: </b> <?php echo $imgdate ?></p>
                                        <p><b>Description: </b><?php echo $imgDescription ?></p>
                                        <p><b>URL: </b><?php echo $imgurl ?></p>
                                        <div>
                                            <button onclick="launchRedo(<?php echo $imgID; ?>)" class=" btn btn-sm btn-info" type="submit">Edit</button>
                                            <button onclick="launchDelete(<?php echo $imgID; ?>)" class=" btn btn-sm btn-danger" type="submit">Delete</button>
                                        </div>
                                    </div>

                                </div>

                        <?php
                            }
                        }
                        $connect = null;
                        ?>

                    </div>


                    <!-- UPDATE ADVENTURE MODAL -->
                    <div id="redo" class="w3-modal">
                        <div class="w3-modal-content w3-card-4 w3-animate-left" style="max-width:500px">

                            <div class="w3-center w3-lime p-2"><br>
                                <span onclick="document.getElementById('redo').style.display='none'" class="w3-button w3-large w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                                <h4>Change Adventure Details</h4>
                            </div>


                            <form class="w3-container" action="update.php" method="POST">
                                <input type="hidden" name="img_id" id="uploadID" value="">
                                <div class="w3-section">
                                    <div class="w3-row-padding">
                                        <label for="change_description" class="form-label w3-col m4"><b>Change Description: </b></label>
                                        <textarea class="w3-input w3-hover-khaki w3-animate-input" name="change_description" type="text" style="width: 100px;" rows="3" cols="40" required></textarea>
                                    </div>

                                    <hr>
                                    <br>

                                    <div class="w3-row-padding">
                                        <select class="w3-select" name="change_category">
                                            <option value="" disabled selected>Choose a Category</option>
                                            <option value="C1">Food</option>
                                            <option value="C2">Culture</option>
                                            <option value="C3">Adventure</option>
                                            <option value="C4">History</option>
                                            <option value="C5">Others</option>
                                        </select>
                                    </div>

                                    <hr>
                                    <br>

                                    <div class="w3-row-padding">
                                        <label for="change_date" class="form-label w3-col m4"><b>Change Date Entered: </b></label>
                                        <input class="w3-input w3-animate-input" name="change_date" type="date" style="width: 100px;">
                                    </div>
                                    <div class="text-muted">
                                        <p>Please make sure to refill form before submission</p>
                                    </div>
                                    <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="update_adventure">Update Details</button>

                                </div>
                            </form>


                            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                                <button onclick="document.getElementById('redo').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>

                            </div>

                        </div>
                    </div>


                    <!-- DELETE ADVENTURE MODAL -->
                    <div id="delete_adventure" class="w3-modal">
                        <div class="w3-modal-content w3-card-4 w3-animate-left" style="max-width:500px">

                            <div class="w3-center w3-lime p-2"><br>
                                <span onclick="document.getElementById('delete_adventure').style.display='none'" class="w3-button w3-large w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                                <h4>Delete Adventure Details</h4>
                            </div>


                            <form class="w3-container" action="update.php" method="POST">
                                <input type="hidden" name="adventure_id" id="adventureID" value="">
                                <div class="w3-section">
                                    <div class="w3-row-padding">
                                        <h4>Confirm Delete Selection ???</h4>
                                    </div>

                                    <hr>
                                    <br>

                                    <button class="w3-button w3-block w3-red w3-section w3-padding" type="submit" name="delete_adventure">Delete Adventure</button>

                                </div>
                            </form>


                            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                                <button onclick="document.getElementById('delete_adventure').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>

                            </div>

                        </div>
                    </div>

                </div>
                <!-- End of Story Adventure Section -->


                <!-- Profile Section (Initially hidden) -->
                <div class="w3-row-padding" id="edit_profile" style="display: none;">

                    <div class="w3-win8-brown w3-margin-bottom">
                        <h3 class="text-center p-2">About Me</h3>
                    </div>

                    <div class="w3-row-padding">

                        <!-- Table with Information -->
                        <div class="w3-twothird">
                            <div class="w3-row-padding">
                                <table class="w3-table w3-bordered w3-card-4">
                                    <tr class="w3-grey">
                                        <th style="width: 30%;">FirstName:</th>
                                        <td style="width: 50%;"><?php echo $firstname;   ?></td>

                                    </tr>
                                    <tr class="w3-white">
                                        <th style="width: 30%;">LastName:</th>
                                        <td style="width: 50%;"><?php echo $lastname;   ?></td>
                                    </tr>
                                    <tr class="w3-grey">
                                        <th style="width: 30%;">UserName:</th>
                                        <td style="width: 50%;"><?php echo $username;   ?></td>
                                    </tr>
                                    <tr class="w3-white">
                                        <th style="width: 30%;">Email:</th>
                                        <td style="width: 50%;"><?php echo $email;   ?></td>
                                    </tr>

                                </table>
                            </div>

                        </div>

                        <!-- Action buttons -->
                        <div class="w3-third ">

                            <div class="w3-row-padding w3-margin-bottom">
                                <button onclick="document.getElementById('edit').style.display='block'" class="btn btn-sm btn-info" type="submit">Edit Profile</button>
                            </div>
                            <div class="w3-row-padding w3-margin-bottom">
                                <button onclick="document.getElementById('change_pass').style.display='block'" class="  btn btn-sm btn-warning" type="submit">Change Password</button>
                            </div>
                            <div class="w3-row-padding w3-margin-bottom">
                                <form action="update.php" method="POST">
                                    <button class=" btn btn-sm btn-danger" type="submit" name="delete">Delete Account</button>
                                </form>
                            </div>

                        </div>

                    </div>


                    <!-- UPDATE PROFILE MODAL -->
                    <div id="edit" class="w3-modal">
                        <div class="w3-modal-content w3-card-4 w3-animate-left" style="max-width:500px">

                            <div class="w3-center w3-lime p-2"><br>
                                <span onclick="document.getElementById('edit').style.display='none'" class="w3-button w3-large w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                                <h4>Update Profile Details</h4>
                            </div>

                            <form class="w3-container" action="update.php" method="POST">
                                <div class="w3-section">
                                    <div class="w3-row-padding">
                                        <label for="firstname" class="form-label w3-col m4"><b>First name: </b></label>
                                        <input type="text" class="w3-col m8 w3-input w3-margin-bottom" id="firstname" name="firstname" value="<?php echo $firstname;  ?>">
                                    </div>
                                    <div class="w3-row-padding">
                                        <label for="lastname" class="form-label w3-col m4"><b>Last name: </b></label>
                                        <input type="text" class="w3-col m8 w3-input w3-margin-bottom " id="lastname" name="lastname" value="<?php echo $lastname;  ?>">
                                    </div>
                                    <div class="w3-row-padding">
                                        <label for="username" class="form-label w3-col m4"><b>User name: </b></label>
                                        <input type="text" class="w3-col m8 w3-input w3-margin-bottom " id="username" name="username" value="<?php echo $_SESSION["username"] ?>">
                                    </div>
                                    <div class="w3-row-padding">
                                        <label for="email" class="form-label w3-col m4"><b>Email: </b></label>
                                        <input type="email" class="w3-col m8 w3-input w3-margin-bottom" id="email" name="email" value="<?php echo $_SESSION["email"] ?>">
                                    </div>

                                    <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="update_profile">Update Details</button>

                                </div>
                            </form>

                            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                                <button onclick="document.getElementById('edit').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
                            </div>

                        </div>
                    </div>


                    <!-- CHANGE PASSWORD MODAL -->
                    <div id="change_pass" class="w3-modal">
                        <div class="w3-modal-content w3-card-4 w3-animate-left" style="max-width:500px">

                            <div class="w3-center w3-lime p-2"><br>
                                <span onclick="document.getElementById('change_pass').style.display='none'" class="w3-button w3-large w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                                <h4>Change Password</h4>
                            </div>

                            <form class="w3-container" action="update.php" method="POST">
                                <div class="w3-section">

                                    <div class="w3-row-padding">
                                        <label for="password" class="form-label w3-col m4"><b>Old Password: </b></label>
                                        <input type="password" class="w3-col m8 w3-input w3-margin-bottom" id="password" name="password">
                                    </div>
                                    <div class="w3-row-padding">
                                        <label for="new_password" class="form-label w3-col m4"><b>New Password: </b></label>
                                        <input type="password" class="w3-col m8 w3-input w3-margin-bottom" id="new_password" name="new_password">
                                    </div>
                                    <div class="w3-row-padding">
                                        <label for="confirm_password" class="form-label w3-col m4"><b>Confirm New Pass: </b></label>
                                        <input type="password" class="w3-col m8 w3-input w3-margin-bottom" id="confirm_password" name="confirm_password">
                                    </div>

                                    <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="change">Change Password</button>

                                </div>
                            </form>

                            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                                <button onclick="document.getElementById('change_pass').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>
                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </main>

    </div>

</body>

</html>