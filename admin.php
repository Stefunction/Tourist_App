<?php
session_start();            //retrieve session		


if (!isset($_SESSION["username"]) && ($_SESSION["roleID"] == '1')) {            //if not previoulsly logged on and role is not admin	
    header("Location: login.php");                                              //redirect to login page
}

$username = $_SESSION["username"];    // get user name into variable $username

$firstname = $_SESSION["firstname"];  // get names into variable $username

$lastname = $_SESSION["lastname"];

require "connect.php";                  // Establish a connection with the PDO object created

/* SQL statement to select relevant user data from DB */
$query = "select userID, firstname, lastname, username, gender.genderName, email, role.role_Name FROM users, role, gender
where users.roleID = role.roleID and users.genderID = gender.genderID";

$result = $connect->query($query);    // Execute SQL

/* SQL statement to select the gallery upload of evry user */
$gallery_query = "select uploadID, userName, uploadPath, description, categoryName, date, url from uploads, category";
$gallery_query .= " WHERE uploads.categoryID = category.categoryID";

$gallery_result = $connect->query($gallery_query);   //Execute SQL

?>



<!DOCTYPE html>
<html>

<!-- Beginning of head content Tag -->

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
    
    <!-- Sweet Alert plugin and stylesheet -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- PHP script to print out messages if set -->
    <?php
    if (isset($_SESSION["status"])) {
    ?>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                swal({
                    title: "<?php echo $_SESSION["status"] ?>",
                    icon: "<?php echo $_SESSION["icon"] ?>",
                    button: "Close!",
                });
            });
        </script>

    <?php
        unset($_SESSION["status"]);
    }
    ?>

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
        function user_adventure() {
            document.getElementById("user_gallery").style.display = "block";
            document.getElementById("div_users").style.display = "none";
        }

        function all_users() {
            document.getElementById("user_gallery").style.display = "none";
            document.getElementById("div_users").style.display = "block";
        }
    </script>

    <!-- Script to tabulate DataTable -->
    <script>
        $(document).ready(function() {
            $('.userTable').DataTable();
        });
    </script>

    <!--Styling the header Body  -->
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
<!-- End of head content Tag -->

<!-- Beginning of the body Tag -->

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
        <!-- End of Header Section -->


        <!-- Beginning of main tag -->
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


                            <button class="w3-button w3-black" onclick="all_users()">USERS REGISTERED</button>
                            <button class="w3-button w3-white" onclick="user_adventure()"><i class="fa fa-diamond w3-margin-right"></i>User Adventure</button>
                        </div>
                    </div>
                </header>
                <!-- End of Body Header -->


                <!-- Users List Section -->
                <div id="div_users">

                    <!-- Table Executions -->
                    <div class="w3-row-padding">
                        <!-- Table for Users-->
                        <table class="userTable">

                            <!-- Table Header -->
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

                            <!-- Table Body -->
                            <tbody>
                                <?php if ($result->rowCount() == 0) {           # If result count doesnt return anything
                                ?> 
                                    <!-- Respond with the statement -->
                                   <h5>No data Retrieved... Possibly No user has Updated Yet</h5>   

                                <?php 
                                }   else {
                                    foreach ($result as $user) {
                                ?>
                                        <!-- Beginning of each row -->
                                        <!-- Store the array of results as different variables -->
                                        <tr>
                                            <td> <?php echo $user["userID"];   ?> </td>
                                            <td> <?php echo $user["firstname"]; ?> </td>
                                            <td> <?php echo $user["lastname"]; ?> </td>
                                            <td> <?php echo $user["username"]; ?> </td>
                                            <td> <?php echo $user["genderName"]; ?></td>
                                            <td> <?php echo $user["email"]; ?> </td>
                                            <td> <?php echo $user["role_Name"]; ?></td>

                                            <!-- Set the Action buttons -->
                                            <td>
                                                <button class="btn btn-sm btn-primary" data-bs-target="#resetPasswordModal" data-bs-toggle="modal" data-bs-userId="<?php echo $user["userID"]; ?>">
                                                    Reset
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-bs-target="#deleteModal" data-bs-toggle="modal" data-bs-userIdInput="<?php echo $user["userID"]; ?>">
                                                    Delete
                                                </button>
                                            </td>

                                        </tr>
                                        <!-- End of each row -->
                                <?php }
                                }
                                $connect = null;    // Set the PDO object to null afterwards?>  
                            </tbody>
                            <!-- End of Table Body -->

                        </table>
                        <!-- End of Table for Users-->


                        <!-- Reset Password Modal initiated when the Reset button is activated from the Table-->
                        <div class="modal fade" id="resetPasswordModal" tabindex="-1" aria-labelledby="resetPasswordModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="resetPasswordModalLabel">Reset Password</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">

                                        <!-- Form for Reset password and User -->
                                        <form id="resetPasswordForm" action="admin_reset.php" method="POST">

                                            <!-- New Role Designation -->
                                            <div class="mb-3">
                                                <select class="form-select" name="user_role">
                                                    <option disabled selected>Choose Category</option>
                                                    <option value="Admin">Administrator</option>
                                                    <option value="User">User</option>
                                                </select>
                                            </div>

                                            <!-- New Password Input -->
                                            <div class="mb-3">
                                                <label for="new-password" class="col-form-label">New Password:</label>
                                                <input type="text" name="new_password" class="form-control" id="new-password" placeholder="Enter temporary password">
                                            </div>

                                            <!-- Hidden Input with UserID, JavaScript changes its value -->
                                            <input id="user-id-input" type="hidden" name="user_id">

                                            <!-- Reset Submit Button -->
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary" name="reset_user">RESET</button>
                                            </div>

                                        </form>

                                    </div>
                                    <!--End of Modal Body -->
                                </div>
                            </div>
                        </div>
                    <!-- End of Reset Password Modal initiated when the Reset button is activated from the Table-->


                        <!-- JavaScript to Add Hidden Input When You Trigger Reset Modal -->
                        <script>
                            /* Fetch the Reset Modal */
                            var resetPasswordModal = document.querySelector("#resetPasswordModal");

                            /* When Reset Modal is launched, get the event */
                            resetPasswordModal.addEventListener('show.bs.modal', function(event) {

                                /* Fetch the Modal trigger Button */
                                var triggerButton = event.relatedTarget;

                                /* Re-initialize the Form */
                                document.querySelector('#resetPasswordForm').reset();

                                /* Fetch the userID from the data attribute in the trigger */
                                var userId = triggerButton.getAttribute('data-bs-userId');

                                /* Fetch the userID hidden input from the modal */
                                var userIdInput = document.querySelector('#user-id-input');

                                /* Assign the value of the data attribute from trigger to hidden input in modal */
                                userIdInput.value = userId;
                            });
                        </script>


                        <!-- Delete User Modal initiated when the Delete button is activated from the Table-->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <!-- Modal Header -->
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>

                                    <!-- Modal Body -->
                                    <div class="modal-body">

                                        <!-- Form to delete User -->
                                        <form id="deleteForm" action="admin_reset.php" method="POST">

                                            <!-- Hidden Input with UserID, JavaScript changes its value -->
                                            <input id="delete-user-id" type="hidden" name="user_id">

                                            <!-- Delete Submit Button -->
                                            <div class="d-flex justify-content-center">
                                                <button type="submit" class="btn btn-danger" name="delete_user">DELETE USER</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- JavaScript to Add Hidden Input When You Trigger Delete Modal -->
                        <script>
                            /* Fetch the Delete Modal */
                            var deleteModal = document.querySelector("#deleteModal");

                            /* When Delete Modal is launched, get the event */
                            deleteModal.addEventListener('show.bs.modal', function(event) {

                                /* Fetch the Modal trigger Button */
                                var triggerButton = event.relatedTarget;

                                /* Re-initialize the Form */
                                document.querySelector('#deleteForm').reset();

                                /* Fetch the userID from the data attribute in the trigger */
                                var useridInput = triggerButton.getAttribute('data-bs-userIdInput');

                                /* Fetch the userID hidden input from the modal */
                                var userIdDelete = document.querySelector('#delete-user-id');

                                /* Assign the value of the data attribute from trigger to hidden input in modal */
                                userIdDelete.value = useridInput;
                            });
                        </script>

                    </div>
                    <!-- End of Table Executions -->

                </div>
                <!-- End of Users List Section -->

                

                <!-- User List gallery Section (Initially hidden) -->
                <div class="w3-row-padding" id="user_gallery" style="display: none;">

                    <h3>User Uploads</h3>

                    <?php 
                        if ($gallery_result->rowCount() == 0)               # If result count doesnt return anything
                    { ?>        

                        <!-- Place a thumbnail with a message -->
                        <div class="w3-card-4 w3-third w3-container w3-margin-bottom">

                            <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false">
                                <title>Picture Holder</title>
                                <rect width="100%" height="100%" fill="#55595c" /><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text>
                            </svg>


                            <div class="w3-container w3-white">
                                <h5><b>Lorem Ipsum</b></h5><span> -- / -- / ----</span><br>
                                <p class="p-2">No Data Entered by any User yet</p>
                            </div>
                        </div>

                        <?php } 
                        
                        else {
 
                        // Store the array of results as different variables 
                        foreach ($gallery_result as $img) {

                            $imgID = $img["uploadID"];
                            $imgOwner = $img["userName"];
                            $imgPath = $img["uploadPath"];
                            $imgDescription = $img["description"];
                            $imgCategory = $img["categoryName"];
                            $imgdate = $img["date"];
                            $imgurl = $img["url"];
                            
                        ?>
                            <div class="w3-card-4 w3-third w3-display-container w3-margin-bottom">
                                <img src="<?php echo $imgPath ?>" alt="Uploaded_Pic Description" style="width:100%" class="w3-hover-opacity">
                                <div class="w3-display-topleft w3-container w3-text-black">
                                    <h5 style="color: white;"><?php echo $imgOwner ?></h5>
                                </div>
                                <div class="w3-container w3-white">
                                    <h5><b>Lorem Ipsum</b></h5><span><?php echo $imgdate ?></span><br>
                                    <p class="p-2"><?php echo $imgDescription ?>!</p>
                                </div>

                                <!-- Delete Story Button -->
                                <form class="d-flex justify-content-center" action="admin_reset.php" method="POST"> 
                                    <button class="w3-button w3-inline w3-red w3-section w3-padding" type="submit" name="delete_story" value="<?php echo $imgID; ?>">Delete User Story</button>
                                </form>
                            </div>

                    <?php }
                    }
                    $connect = null; ?>

                </div>
                <!-- End of User List gallery Section (Initially hidden) -->

            </div>
        </main>
        <!-- End of main tag -->
    </div>

</body>
<!-- End of the body Tag -->

</html>

