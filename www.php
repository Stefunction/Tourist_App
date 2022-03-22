<?php
session_start();            //retrieve session		


if (!isset($_SESSION["username"])) { //if not previoulsly logged on	
  header("Location: login.php");
}              //redirect to login page
$username = $_SESSION["username"];    //get user name into variable $username

$firstname = $_SESSION["firstname"];  //get first name into variable $username

$lastname = $_SESSION["lastname"];


?>



<!DOCTYPE html>
<html>

<head>
  <title>User Home</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.css" />






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
  <!-- Header section -->
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






  <!-- Sidebar/menu -->
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
      <a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-padding"><i class="fa fa-envelope fa-fw w3-margin-right"></i>CONTACT</a>
    </div>
    <div class="w3-panel w3-large">
      <i class="fa fa-facebook-official w3-hover-opacity"></i>
      <i class="fa fa-instagram w3-hover-opacity"></i>
      <i class="fa fa-snapchat w3-hover-opacity"></i>
      <i class="fa fa-pinterest-p w3-hover-opacity"></i>
      <i class="fa fa-twitter w3-hover-opacity"></i>
      <i class="fa fa-linkedin w3-hover-opacity"></i>
    </div>
  </nav>

  <!-- Overlay effect when opening sidebar on small screens -->
  <div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="profile_Overlay"></div>

  <!-- !PAGE CONTENT! -->
  <div class="w3-main" style="margin-left:300px">

    <!-- Header -->
    <header id="adventure">
      <a href="#"><img src="Assets/Images/IMG_20200620_083445.jpg" style="width:65px;" class="w3-circle w3-right w3-margin w3-hide-large w3-hover-opacity"></a>
      <span class="w3-button w3-hide-large w3-xxlarge w3-hover-text-grey" onclick="w3_open()"><i class="fa fa-bars"></i></span>
      <div class="w3-container">
        <h1><b>My Adventures</b></h1>
        <div class="w3-section w3-bottombar w3-padding-16">
          <span class="w3-margin-right">Filter:</span>

          <a href="#adventure" onclick="w3_close()" class="w3-bar-item w3-button w3-padding w3-text-teal"><i class="fa fa-th-large fa-fw w3-margin-right"></i>My adventures</a>


          <button class="w3-button w3-black" onclick="all_content()">ALL</button>
          <button class="w3-button w3-white" onclick="add_adventure()"><i class="fa fa-diamond w3-margin-right"></i>Add Adventure</button>
          <button class="w3-button w3-white w3-hide-small"><i class="fa fa-photo w3-margin-right"></i>Photos</button>
          <button class="w3-button w3-white w3-hide-small"><i class="fa fa-map-pin w3-margin-right"></i>Art</button>
        </div>
      </div>
    </header>

    <div id="div_content">
      <!-- First Photo Grid-->
      <div class="w3-row-padding">
        <div class="w3-third w3-container w3-margin-bottom">
          <img src="https://www.w3schools.com/w3images/mountains.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
          <div class="w3-container w3-white">
            <p><b>Lorem Ipsum</b></p>
            <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue
              gravida diam non fringilla.</p>
          </div>
        </div>
        <div class="w3-third w3-container w3-margin-bottom">
          <img src="https://www.w3schools.com/w3images/lights.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
          <div class="w3-container w3-white">
            <p><b>Lorem Ipsum</b></p>
            <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue
              gravida diam non fringilla.</p>
          </div>
        </div>
        <div class="w3-third w3-container">
          <img src="https://www.w3schools.com/w3images/nature.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
          <div class="w3-container w3-white">
            <p><b>Lorem Ipsum</b></p>
            <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue
              gravida diam non fringilla.</p>
          </div>
        </div>
      </div>

      <!-- Second Photo Grid-->
      <div class="w3-row-padding">
        <div class="w3-third w3-container w3-margin-bottom">
          <img src="https://www.w3schools.com/w3images/p1.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
          <div class="w3-container w3-white">
            <p><b>Lorem Ipsum</b></p>
            <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue
              gravida diam non fringilla.</p>
          </div>
        </div>
        <div class="w3-third w3-container w3-margin-bottom">
          <img src="https://www.w3schools.com/w3images/p2.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
          <div class="w3-container w3-white">
            <p><b>Lorem Ipsum</b></p>
            <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue
              gravida diam non fringilla.</p>
          </div>
        </div>
        <div class="w3-third w3-container">
          <img src="https://www.w3schools.com/w3images/p3.jpg" alt="Norway" style="width:100%" class="w3-hover-opacity">
          <div class="w3-container w3-white">
            <p><b>Lorem Ipsum</b></p>
            <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue
              gravida diam non fringilla.</p>
          </div>
        </div>
      </div>

    </div>
    <br><br>




    <div class="w3-row-padding" id="div_add" style="display: none;">
      <h3>File Upload</h3>
      <form action="upload.php" method="post" enctype="multipart/form-data">
        <div class="custom-file-container" data-upload-id="imageFileID">

          <div class="w3-half w3-container w3-margin-bottom">
            <label>Upload Image
              <!-- Clear Button -->
              <a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">
                &times;
              </a>
            </label>

            <label class="custom-file-container__custom-file">
              <input class="custom-file-container__custom-file__custom-file-input" type="file" name="FTU" id="FTU" accept="*" multiple aria-label="Choose File" />
              <input type="hidden" name="MAX_FILE_SIZE" value="512000" />

              <span class="custom-file-container__custom-file__custom-file-control"></span>
            </label>
            <div class="custom-file-container__image-preview"></div>
          </div>


          <div class="w3-half w3-container w3-white">

            <div class="w3-card-4">
              <div class="w3-container w3-green">
                <h2>Tell Us More!!!</h2>
              </div>

              <!-- <form class="w3-container" action="upload.php" method="post" enctype="multipart/form-data"> -->
              <div class=" w3-row-padding">
                <p>
                  <textarea class="w3-input w3-hover-yellow w3-animate-input" type="text" style="width: 100px;" placeholder="Description" rows="3" cols="40""></textarea>
              </p>
              </div>
              <div class=" w3-row-padding">
                  <div class="w3-half">
                  <input class="w3-input w3-animate-input" type="date" placeholder="Date Experienced" style="width: 100px;">
                  </div>
                  <div class="w3-half">
                  <select class="w3-select" name="category">
                    <option value="" disabled selected>Choose a Category</option>
                    <option value="Food">Food</option>
                    <option value="Culture">Culture</option>
                    <option value="Adventures">Adventures</option>
                    <option value="History">History</option>
                    <option value="Others">Others</option>
                  </select>
                  </div>
               </div><br>

               <!-- <div class=" w3-row-padding">
                Please include the image
                <input class="custom-file-container__custom-file__custom-file-input" type="file" name="FTU" id="FTU" accept="*" multiple aria-label="Choose File" >
              </div><br> -->

              <div class=" w3-row-padding ">
                You can include a URL here:
                <input type="url" class="w3-animate-input" name="url" id="url">
              </div><br>
   
        </div>
      </div>
          <div class="w3-container">
          <p><button class="w3-btn w3-red" value="Upload" name="upload">Add new Adventure</button></p>
          </div>
      </div>
      </form> 
    </div>




 <!-- Bootstrap Bundle with Popper -->
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- File Upload With Preview JS -->
<script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>


 <!--File Upload With Preview Initialization  -->
 <script>
    let upload = new FileUploadWithPreview("imageFileID"); // use input id
  </script>






    <!-- Images of Me -->
    <div class="w3-row-padding w3-padding-16" id="about">
      <div class="w3-col m6">
        <img src="https://www.w3schools.com/w3images/avatar_g.jpg" alt="Me" style="width:100%">
      </div>
      <div class="w3-col m6">
        <img src="https://www.w3schools.com/w3images/me2.jpg" alt="Me" style="width:100%">
      </div>
    </div>

    <div class="w3-container w3-padding-large" style="margin-bottom:32px">
      <h4><b>About Me</b></h4>
      <p>Just me, myself and I, exploring the universe of unknownment. I have a heart of love and an interest of lorem
        ipsum and mauris neque quam blog. I want to share my world with you. Praesent tincidunt sed tellus ut rutrum.
        Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non fringilla. Praesent tincidunt
        sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue gravida diam non
        fringilla.</p>
      <hr>

      <h4>Technical Skills</h4>
      <!-- Progress bars / Skills -->
      <p>Photography</p>
      <div class="w3-grey">
        <div class="w3-container w3-dark-grey w3-padding w3-center" style="width:95%">95%</div>
      </div>
      <p>Web Design</p>
      <div class="w3-grey">
        <div class="w3-container w3-dark-grey w3-padding w3-center" style="width:85%">85%</div>
      </div>
      <p>Photoshop</p>
      <div class="w3-grey">
        <div class="w3-container w3-dark-grey w3-padding w3-center" style="width:80%">80%</div>
      </div>
      <p>
        <button class="w3-button w3-dark-grey w3-padding-large w3-margin-top w3-margin-bottom">
          <i class="fa fa-download w3-margin-right"></i>Download Resume
        </button>
      </p>
      <hr>

      <h4>How much I charge</h4>
      <!-- Pricing Tables -->
      <div class="w3-row-padding" style="margin:0 -16px">
        <div class="w3-third w3-margin-bottom">
          <ul class="w3-ul w3-border w3-white w3-center w3-opacity w3-hover-opacity-off">
            <li class="w3-black w3-xlarge w3-padding-32">Basic</li>
            <li class="w3-padding-16">Web Design</li>
            <li class="w3-padding-16">Photography</li>
            <li class="w3-padding-16">1GB Storage</li>
            <li class="w3-padding-16">Mail Support</li>
            <li class="w3-padding-16">
              <h2>$ 10</h2>
              <span class="w3-opacity">per month</span>
            </li>
            <li class="w3-light-grey w3-padding-24">
              <button class="w3-button w3-teal w3-padding-large w3-hover-black">Sign Up</button>
            </li>
          </ul>
        </div>

        <div class="w3-third w3-margin-bottom">
          <ul class="w3-ul w3-border w3-white w3-center w3-opacity w3-hover-opacity-off">
            <li class="w3-teal w3-xlarge w3-padding-32">Pro</li>
            <li class="w3-padding-16">Web Design</li>
            <li class="w3-padding-16">Photography</li>
            <li class="w3-padding-16">50GB Storage</li>
            <li class="w3-padding-16">Endless Support</li>
            <li class="w3-padding-16">
              <h2>$ 25</h2>
              <span class="w3-opacity">per month</span>
            </li>
            <li class="w3-light-grey w3-padding-24">
              <button class="w3-button w3-teal w3-padding-large w3-hover-black">Sign Up</button>
            </li>
          </ul>
        </div>

        <div class="w3-third">
          <ul class="w3-ul w3-border w3-white w3-center w3-opacity w3-hover-opacity-off">
            <li class="w3-black w3-xlarge w3-padding-32">Premium</li>
            <li class="w3-padding-16">Web Design</li>
            <li class="w3-padding-16">Photography</li>
            <li class="w3-padding-16">Unlimited Storage</li>
            <li class="w3-padding-16">Endless Support</li>
            <li class="w3-padding-16">
              <h2>$ 25</h2>
              <span class="w3-opacity">per month</span>
            </li>
            <li class="w3-light-grey w3-padding-24">
              <button class="w3-button w3-teal w3-padding-large w3-hover-black">Sign Up</button>
            </li>
          </ul>
        </div>
      </div>
    </div>

    <!-- Contact Section -->
    <div class="w3-container w3-padding-large w3-grey">
      <h4 id="contact"><b>Contact Me</b></h4>
      <div class="w3-row-padding w3-center w3-padding-24" style="margin:0 -16px">
        <div class="w3-third w3-dark-grey">
          <p><i class="fa fa-envelope w3-xxlarge w3-text-light-grey"></i></p>
          <p>email@email.com</p>
        </div>
        <div class="w3-third w3-teal">
          <p><i class="fa fa-map-marker w3-xxlarge w3-text-light-grey"></i></p>
          <p>Chicago, US</p>
        </div>
        <div class="w3-third w3-dark-grey">
          <p><i class="fa fa-phone w3-xxlarge w3-text-light-grey"></i></p>
          <p>512312311</p>
        </div>
      </div>
      <hr class="w3-opacity">
      <form action="/action_page.php" target="_blank">
        <div class="w3-section">
          <label>Name</label>
          <input class="w3-input w3-border" type="text" name="Name" required>
        </div>
        <div class="w3-section">
          <label>Email</label>
          <input class="w3-input w3-border" type="text" name="Email" required>
        </div>
        <div class="w3-section">
          <label>Message</label>
          <input class="w3-input w3-border" type="text" name="Message" required>
        </div>
        <button type="submit" class="w3-button w3-black w3-margin-bottom"><i class="fa fa-paper-plane w3-margin-right"></i>Send Message</button>
      </form>
    </div>

    <!-- Footer -->
    <footer class="w3-container w3-padding-32 w3-dark-grey">
      <div class="w3-row-padding">
        <div class="w3-third">
          <h3>FOOTER</h3>
          <p>Praesent tincidunt sed tellus ut rutrum. Sed vitae justo condimentum, porta lectus vitae, ultricies congue
            gravida diam non fringilla.</p>
          <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
        </div>

        <div class="w3-third">
          <h3>BLOG POSTS</h3>
          <ul class="w3-ul w3-hoverable">
            <li class="w3-padding-16">
              <img src="https://www.w3schools.com/w3images/workshop.jpg" class="w3-left w3-margin-right" style="width:50px">
              <span class="w3-large">Lorem</span><br>
              <span>Sed mattis nunc</span>
            </li>
            <li class="w3-padding-16">
              <img src="https://www.w3schools.com/w3images/gondol.jpg" class="w3-left w3-margin-right" style="width:50px">
              <span class="w3-large">Ipsum</span><br>
              <span>Praes tinci sed</span>
            </li>
          </ul>
        </div>

        <div class="w3-third">
          <h3>POPULAR TAGS</h3>
          <p>
            <span class="w3-tag w3-black w3-margin-bottom">Travel</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">New York</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">London</span>
            <span class="w3-tag w3-grey w3-small w3-margin-bottom">IKEA</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">NORWAY</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">DIY</span>
            <span class="w3-tag w3-grey w3-small w3-margin-bottom">Ideas</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Baby</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Family</span>
            <span class="w3-tag w3-grey w3-small w3-margin-bottom">News</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Clothing</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Shopping</span>
            <span class="w3-tag w3-grey w3-small w3-margin-bottom">Sports</span> <span class="w3-tag w3-grey w3-small w3-margin-bottom">Games</span>
          </p>
        </div>

      </div>
    </footer>

    <div class="w3-black w3-center w3-padding-24">Made with <a href="https://www.w3schools.com/spaces" title="spaces" target="_blank" class="w3-hover-opacity">W3Schools Spaces</a></div>

    <!-- End page content -->
  </div>

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

    function add_adventure() {
      document.getElementById("div_add").style.display = "block";
      document.getElementById("div_content").style.display = "none";
    }

    function all_content() {
      document.getElementById("div_add").style.display = "none";
      document.getElementById("div_content").style.display = "block";
    }
    

  </script>

</body>

</html>