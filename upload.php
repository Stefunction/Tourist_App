<?php

error_reporting(E_ALL);

require "connect.php";

session_start();   #start a session

$username = $_SESSION["username"];

htmlspecialchars($_SERVER["PHP_SELF"]);    #For protection against xss injection

#Function to ascertain input is not an sql injection by removing characters and spaces
function _checkInput($data)
{ #to validate input
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") { #to check if form was submitted

  $description = _checkInput($_POST["description"]); #To sanitize input
  $date = _checkInput($_POST["date"]);
  $category = _checkInput($_POST["category"]);
  $url = _checkInput($_POST["url"]);


  // File information
  $uploaded_name = $_FILES['FTU']['name'];
  $uploaded_ext  = substr($uploaded_name, strrpos($uploaded_name, '.') + 1);
  $uploaded_size = $_FILES['FTU']['size'];
  $uploaded_type = $_FILES['FTU']['type'];
  $uploaded_tmp  = $_FILES['FTU']['tmp_name'];


  // Where are we going to be writing to?
  $target_path   = "Assets/uploads/";

  //Hashing the image name
  $target_file   =  md5(uniqid() . $uploaded_name) . '.' . $uploaded_ext;
  $temp_file     = ((ini_get('upload_tmp_dir') == '') ? (sys_get_temp_dir()) : (ini_get('upload_tmp_dir')));
  $temp_file    .= DIRECTORY_SEPARATOR . md5(uniqid() . $uploaded_name) . '.' . $uploaded_ext;
  $imageOK = 1;

  if (isset($_POST['upload'])) {

    if (!empty($_POST["MAX_FILE_SIZE"])) {

      // Is it an image?

      if (getimagesize($uploaded_tmp) !== false) {
        echo "File is an image - " . $check_Image["mime"] . ".";
        $imageOK = 1;
      } else {
        $imageOK = 0;
        echo "Sorry, The file is not an image";
      }

      if ($uploaded_size > 2000000) {
        echo "Sorry, your file is larger than 2MB";
        $imageOK = 0;
      }

      if ((strtolower($uploaded_ext) == 'jpg' || strtolower($uploaded_ext) == 'jpeg' || strtolower($uploaded_ext) == 'png' || strtolower($uploaded_ext) == 'gif')
        && ($uploaded_type == 'image/jpeg' || $uploaded_type == 'image/png' || $uploaded_type == 'image/jpg' || $uploaded_type == 'image/gif')
      ) {
        $imageOK = 1;
      } else {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $imageOK = 0;
      }


      if ($imageOK == 0) {
        echo "File not Successfully uploaded";
      } else {
        $target_dir = $target_path . $target_file;

        // Can we move the file to the web root from the temp folder?
        if (move_uploaded_file($uploaded_tmp, $target_dir)) {
          // Yes!

          $query = "Insert into uploads (userName, uploadPath, description, categoryID, date, url)";
          $query .= "Values ('$username', '$target_dir', '$description', '$category', '$date', '$url')";

          $result = $connect->exec($query);  //execute SQL
          // echo "<pre><a href='${target_path}${target_file}'>${target_file}</a> succesfully uploaded!</pre>";
          header("Location: home.php");
        } else {
          // No
          echo '<pre>Your image was not uploaded.</pre>';
        }

        // Delete any temp files
        if (file_exists($temp_file))
          unlink($temp_file);
      }
    } else {
      $_SESSION["status"] = "You must upload an Image!!! ";
      $_SESSION["icon"] = "warning";
      $location = "Location: home.php";
      header($location);
      exit();
    }
  } else {
    $_SESSION["status"] = "Error, Try again ";
    $_SESSION["icon"] = "error";
    $location = "Location: home.php";
    header($location);
    exit();
  }
  $connect = null;
}
