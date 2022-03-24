<?php
session_start();            //retrieve session		


if (!isset($_SESSION["username"]) && $_SESSION["roleID"] == '1') {            //if not previoulsly logged on	
    header("Location: home.php");
}              //redirect to login page

$username = $_SESSION["username"];    //get user name into variable $username

$firstname = $_SESSION["firstname"];  //get names into variable $username

$lastname = $_SESSION["lastname"];

require "connect.php";

$query = "select userID, firstname, lastname, username, gender.genderName, email, role.role_Name FROM users, role, gender
where users.roleID = role.roleID and users.genderID = gender.genderID";
// $query .= "WHERE users.genderID = gender.genderID and users.roleID = role.roleID";

// userID, firstname, lastname, username, gender.genderName, users.email, role.role_Name
$result = $connect->query($query);    //execute SQL

?>

<!DOCTYPE html>
<html>

<head>
    <title>User Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <!-- <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet"> style font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script> <!-- Preview JS for file Upload -->
    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> <!-- Bootstrap with Popper -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    

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
        }

        function all_content() {
            document.getElementById("div_add").style.display = "none";
            document.getElementById("div_content").style.display = "block";
        }
    </script>

    <script>
        $(document).ready( function () {
            $('.userTable').DataTable();
                } );
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
        <header class="sticky-top">
            <!--An opening horizontal line for decoration-->
            <hr>
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <!--Creating a logo with the span description-->
                    <a class="navbar-brand" id="logo" href="#"><img src="" alt="Logo">
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
                            <li class="nav-item"><a class="nav-link" href="logout.php">Login</a></li>
                            <li class="nav-item"><a class="nav-link" href="signup.php">Signup</a></li>
                            <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!--A closing horizontal line for decoration-->
            <hr>
        </header>
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
                    <a href="#adventure" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>My Adventures</a>
                    <a href="#about" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-user fa-fw w3-margin-right"></i>My Personal Space</a>
                    <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>Contact</a>
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
                <header id="adventure">
                    <a href="#"><img src="Assets/Images/IMG_20200620_083445.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
                    <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
                    <div class="w3-container">
                        <h1><b>My Adventures</b></h1>
                        <div class="w3-section w3-bottombar w3-padding-16">
                            <span class="w3-margin-right">Filter:</span>

                            <!-- <a href="#adventure" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>My adventures</a> -->


                            <button class="w3-button w3-black" onclick="all_content()">ALL</button>
                            <button class="w3-button w3-white" onclick="add_adventure()"><i class="fa fa-diamond w3-margin-right"></i>Add Adventure</button>
                            <button class="w3-button w3-white w3-hide-small"><i class="fa fa-photo w3-margin-right"></i>Photos</button>
                            <button class="w3-button w3-white w3-hide-small"><i class="fa fa-map-pin w3-margin-right"></i>Art</button>
                        </div>
                    </div>
                </header>
                <!-- End of Body Header -->

                <!-- Adventure Story Section -->
                <div id="div_content">

                    <!-- Grid for Pictures-->
                    <div class="w3-row-padding">
                        <table class="userTable">
                            <thead>
                            <tr>
                                <th>UserID</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>UserName</th>
                                <th>Gender</th>
                                <th>Email</th>
                                <th>User Role</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            
                            <tbody>
                            <?php if ($result->rowCount() == 0) { 
                                    echo "No data Retrieved";
                                    }else{ 
                                        foreach($result as $user){ 
                                            ?> 
                            <tr>
                                        <td> <?php echo $user["userID"];   ?> </td>
                                        <td> <?php echo $user["firstname"]; ?> </td>
                                        <td> <?php echo $user["lastname"]; ?> </td>
                                        <td> <?php echo $user["username"]; ?> </td>
                                        <td> <?php echo $user["genderName"]; ?></td>
                                        <td> <?php echo $user["email"]; ?> </td>
                                        <td> <?php echo $user["role_Name"]; ?></td>
                                        <td>
                                            <form action=""> <input type="hidden" name="user-id" value="<?php echo $user["userID"];   ?>">
                                                <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                            </tr>
                            <?php } } $connect = null; ?>
                            </tbody>
                                
                        </table>
                    
  
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


            </div>
        </main>
    </div>

</body>

</html>
<?php
    session_destroy(); 
?>