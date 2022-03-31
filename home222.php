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

?>

<head>
    <!-- Sweet Alert plugin and stylesheet -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>

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
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="assets/CSS/style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <!-- <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> style font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script> -->

    <script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script> <!-- Preview JS for file Upload -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <!-- Bootstrap with Popper -->


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
            document.getElementById("come_on").style.display = "none";
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
            // document.getElementById("div_content").style.display = "none";
            // document.getElementById("div_add").style.display = "none";
            // document.getElementById("edit_profile").style.display = "none";

            document.getElementById("div_add").style.display = "none";
            document.getElementById("div_content").style.display = "block";
            document.getElementById("edit_profile").style.display = "none";
            document.getElementById("come_on").style.display = "block";
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
        <?php include("navbar.php") ?>

        <main>
            <!-- Profile Sidebar Menu -->
            <nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="profile_Side"><br>
                <div class="w3-container">
                    <a href="#" onclick="w3_close()" class="w3-hide-large w3-right w3-jumbo w3-padding w3-hover-grey" title="close menu">
                        <i class="fa fa-remove"></i>
                    </a>
                    <img src="Assets/Images/IMG_20200620_083445.jpg" style="width:45%;" class="w3-round"><br><br>
                    <h4><b><?php print $username; ?>'s WALL</b></h4>
                    <p class="w3-text-grey"><?php print $firstname . " " . $lastname; ?></p>
                </div>

                <div class="w3-bar-block">
                    <a href="#adventure" onclick="w3_close(), all_content()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>My Adventures</a>
                    <a href="#about" onclick="w3_close(), edit_personal()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>My Personal Space</a>
                    <a href="logout.php" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>Logout</a>
                </div>

                <div class="w3-panel w3-large">
                    <i class="fa fa-facebook-official w3-hover-opacity"></i>
                    <i class="fa fa-instagram w3-hover-opacity"></i>
                    <i class="fa fa-snapchat w3-hover-opacity"></i>
                    <i class="fa fa-twitter w3-hover-opacity"></i>
                </div>
            </nav>

            <!-- On smaller screens, overlay to fit -->
            <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="profile_Overlay"></div>

            <!-- Body Contents -->
            <div class="w3-main" style="margin-left:300px">

                <!-- Body Header -->
                <header>
                    <!-- id="adventure" -->

                    <a href="#"><img src="Assets/Images/IMG_20200620_083445.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
                    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
                    <div class="w3-container">
                        <h1><b>My Adventures</b></h1>
                        <div class="w3-section w3-bottombar w3-padding-16">
                            <span class="w3-margin-right">Filter:</span>

                            <button class="w3-button w3-white" onclick="add_adventure()"><i class="fa fa-diamond w3-margin-right"></i>Add Adventure</button>
                            <button class="w3-button w3-white " onclick="advent_edit()"><i class="fa fa-photo w3-margin-right"></i>Edit Adventure</button>
                            <button class="w3-button w3-white w3-hide-small"><i class="fa fa-map-pin w3-margin-right"></i>Art</button>
                        </div>
                    </div>

                </header>
                <!-- End of Body Header -->



                <!-- Grid for Pictures-->
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
                                        <h5><b><?php echo $imgCategory ?></b></h5><span><?php echo $imgdate ?></span><br>
                                        <p class="p-2"><?php echo $imgDescription ?></p><span><?php echo $imgurl ?></span>
                                        <!-- <div><input type="hidden" name="img-id" value="<?php echo $imgID;   ?>">
                    <button id="come_on" onclick="document.getElementById('redo').style.display='block'" class=" btn btn-sm btn-info" type="submit">Edit</button>
                    <button id="come_on" onclick="document.getElementById('edit').style.display='block'" class=" btn btn-sm btn-danger" type="submit">Delete</button>
                </div> -->
                                    </div>

                                </div>

                        <?php
                            }
                        }
                        $connect = null;
                        ?>

                    </div>
                </div>


















                <!-- Adventure Story Section -->
                <div id="adventure_edit">

                    <!-- Grid for Pictures-->
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
                                        <h5><b><?php echo $imgCategory ?></b></h5><span><?php echo $imgdate ?></span><br>
                                        <p class="p-2"><?php echo $imgDescription ?></p><span><?php echo $imgurl ?></span>
                                        <div><input type="hidden" name="img-id" value="<?php echo $imgID;   ?>">
                                            <button id="come_on" onclick="document.getElementById('redo').style.display='block'" class=" btn btn-sm btn-info" type="submit">Edit</button>
                                            <button id="come_on" onclick="document.getElementById('edit').style.display='block'" class=" btn btn-sm btn-danger" type="submit">Delete</button>
                                        </div>
                                    </div>

                                </div>

                        <?php
                            }
                        }
                        $connect = null;
                        ?>

                    </div>



                    <div id="redo" class="w3-modal">
                        <div class="w3-modal-content w3-card-4 w3-animate-left" style="max-width:500px">

                            <div class="w3-center"><br>
                                <span onclick="document.getElementById('redo').style.display='none'" class="w3-button w3-large w3-hover-red w3-display-topright" title="Close Modal">&times;</span>
                                <h4>Change Adventure Details</h4>
                            </div>


                            <form class="w3-container" action="update.php" method="POST">
                                <div class="w3-section">
                                    <div class="w3-row-padding">
                                        <label for="change_description" class="form-label w3-col m4"><b>Change Description: </b></label>
                                        <textarea class="w3-input w3-hover-yellow w3-animate-input" name="change_description" type="text" style="width: 100px;" placeholder="<?php echo $imgDescription ?>" rows="3" cols="40"></textarea>
                                    </div>

                                    <hr>
                                    <br>

                                    <div class="w3-row-padding">
                                        <select class="w3-select" name="change_category">
                                            <option value="<?php echo $imgCategory ?>" selected><?php echo $imgCategory ?></option>
                                            <option value="" disabled>Choose a Category</option>
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
                                        <input class="w3-input w3-animate-input" name="change_date" type="date" value="<?php echo $imgdate ?>" style="width: 100px;">
                                    </div>

                                    <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="update">Update Details</button>

                                </div>
                            </form>


                            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                                <button onclick="document.getElementById('edit').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>

                            </div>

                        </div>
                    </div>









                </div>
                <!-- End of Story Adventure Section -->

                <br><br>







                <!-- Add Adventure Section (Initially hidden) -->
                <div class="w3-row-padding" id="div_add" style="display: none;">
                    <h3>File Upload</h3>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <div class="custom-file-container" data-upload-id="imageFileID">

                            <!--Preview of the uploaded Images  -->
                            <div class="w3-half w3-container w3-margin-bottom">
                                <label>Upload Image
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
                            <div class="w3-half w3-container w3-white">

                                <div class="w3-card-4">
                                    <div class="w3-container w3-green">
                                        <h2>Tell Us More!!!</h2>
                                    </div>


                                    <div class=" w3-row-padding">
                                        <textarea class="w3-input w3-hover-yellow w3-animate-input" name="description" type="text" style="width: 100px;" placeholder="Description" rows="3" cols="40" required></textarea>
                                    </div>

                                    <div class=" w3-row-padding">
                                        <div class="w3-half">
                                            <input class="w3-input w3-animate-input" name="date" type="date" placeholder="Date Experienced" style="width: 100px;">
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


                                    <br>

                                    <div class=" w3-row-padding ">
                                        <span>You can include a URL here:</span>
                                        <input type="url" class="w3-animate-input" name="url" id="url">
                                    </div>

                                    <br>

                                </div>
                            </div>

                            <div class="w3-container">
                                <p><button class="w3-btn w3-red" value="Upload" name="upload">Add new Adventure</button></p>
                            </div>

                        </div>
                    </form>
                </div>
                <!-- End Add Adventure Section (Initially hidden) -->


                <!--File Upload With Preview Initialization  -->
                <script>
                    let upload = new FileUploadWithPreview("imageFileID"); // use input id
                </script>




                <!-- Edit Profile Section (Initially hidden) -->
                <div class="w3-row-padding" id="edit_profile" style="display: none;">

                    <div class="w3-container w3-yellow w3-margin-bottom">
                        <h3>About Me</h3>
                    </div>
                    <div class="w3-row-padding">
                        <div class="w3-third">
                            <img src="https://www.w3schools.com/w3images/avatar_g.jpg" alt="Me" style="width:100%">
                        </div>

                        <div class="w3-twothird">
                            <div class="w3-row-padding">
                                <table class="w3-table w3-bordered w3-card-4">
                                    <tr>
                                        <th class="w3-red" style="width: 30%;">FirstName:</th>
                                        <td class="w3-yellow" style="width: 50%;"><?php echo $firstname;   ?></td>

                                    </tr>
                                    <tr>
                                        <th class="w3-red" style="width: 30%;">LastName:</th>
                                        <td class="w3-yellow" style="width: 50%;"><?php echo $lastname;   ?></td>
                                    </tr>
                                    <tr>
                                        <th class="w3-red" style="width: 30%;">UserName:</th>
                                        <td class="w3-yellow" style="width: 50%;"><?php echo $username;   ?></td>
                                    </tr>
                                    <tr>
                                        <th class="w3-red" style="width: 30%;">Email:</th>
                                        <td class="w3-yellow" style="width: 50%;"><?php echo $email;   ?></td>
                                    </tr>
                                    <tr>
                                        <th class="w3-red" style="width: 30%;">Change Password:</th>
                                        <td class="w3-yellow" hidden><?php echo $password;   ?></td>
                                    </tr>

                                </table>
                            </div>

                            <div class="w3-row-padding">

                                <button onclick="document.getElementById('edit').style.display='block'" class=" btn btn-sm btn-warning" type="submit">Edit Profile</button>
                                <button onclick="document.getElementById('change_pass').style.display='block'" class="  btn btn-sm btn-warning" type="submit">Change Password</button>


                                <form action="update.php" method="POST">
                                    <button class=" btn btn-sm btn-danger" type="submit" name="delete">Delete Account</button>
                                </form>

                            </div>

                        </div>

                    </div>




                    <div id="edit" class="w3-modal">
                        <div class="w3-modal-content w3-card-4 w3-animate-left" style="max-width:500px">

                            <div class="w3-center"><br>
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

                                    <button class="w3-button w3-block w3-green w3-section w3-padding" type="submit" name="update">Update Details</button>

                                </div>
                            </form>

                            <div class="w3-container w3-border-top w3-padding-16 w3-light-grey">
                                <button onclick="document.getElementById('edit').style.display='none'" type="button" class="w3-button w3-red">Cancel</button>

                            </div>

                        </div>
                    </div>





                    <div id="change_pass" class="w3-modal">
                        <div class="w3-modal-content w3-card-4 w3-animate-left" style="max-width:500px">

                            <div class="w3-center"><br>
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