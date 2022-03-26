<?php
error_reporting(E_ALL);     #Errors encountered are reported

require "connect.php";      #Establish a connection with the PDO object created

session_start();            #Begin a Session   

htmlspecialchars($_SERVER["PHP_SELF"]);    #To protect against XSS injection

// if (isset($_SESSION["username"]))              # if not logged on	
// {
//     header("Location: login.php");          # redirect to login page
// }

$username = $_SESSION["username"];  


#Function to ascertain input is not an sql injection by removing characters and spaces

function _checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


// if ($_SERVER["REQUEST_METHOD"] == "POST") {         # If form was submitted using POST method
//     $firstname = _checkInput($_POST["firstname"]);
//     $lastname = _checkInput($_POST["lastname"]);
//     $username = _checkInput($_POST["username"]);    # Apply security function and assign to variable username
//     $email = _checkInput($_POST["email"]);
//     $password = _checkInput($_POST["password"]);    # Apply security function and assign to variable password
//     $newpassword = _checkInput($_POST["new_password"]);
//     $confirmpassword = _checkInput($_POST["confirm_password"]);
// }

if(isset($_POST["delete"])){

    
    #SQL statement to delete details from the database where corresponding username matches
    $delete = "DELETE FROM users WHERE username = '$username' ";
    $result_delete = $connect->query($delete);

    if ($result_delete){
        echo "Account Deleted Successfully";
    }else{
        echo "Not done";
    }
}






?>