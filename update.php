<?php
error_reporting(E_ALL);     #Errors encountered are reported

require "connect.php";      #Establish a connection with the PDO object created

session_start();            #Begin a Session   

htmlspecialchars($_SERVER["PHP_SELF"]);    #To protect against XSS injection

if (!isset($_SESSION["username"]))              # if not logged on	
{
    header("Location: login.php");          # redirect to login page
}

$username = $_SESSION["username"];  


#Function to ascertain input is not an sql injection by removing characters and spaces

function _checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {  

    //  To delete users account when activated 
            
    if(isset($_POST["delete"])){

        #SQL statement to delete details from the database where corresponding username matches
        $delete = "DELETE FROM users WHERE username = '$username' ";
        $result_delete = $connect->query($delete);

        if ($result_delete){
            $_SESSION["del_account"] = "Account Deleted";
            $_SESSION["icon"] = "success";
            unset($_SESSION["username"]);               //To unset the username from the session
            $location = "Location: login.php";
            header($location);
            exit();
        }else{
            $_SESSION["status"] = "There seems to be an error??";
            $_SESSION["icon"] = "error";
            $location = "Location: home.php";
            header($location);
            exit();
        }
    }

// End of delete button section

//  To update the users account when activated 
    if(isset($_POST["update"])) {
                    
        // Check to ascertain none of this input is empty
            if(!empty($_POST["firstname"] && $_POST["lastname"] && $_POST["username"] && $_POST["email"])){
                
                $firstname = _checkInput($_POST["firstname"]);
                $lastname = _checkInput($_POST["lastname"]);
                $username = _checkInput($_POST["username"]);
                $email = _checkInput($_POST["email"]);
                
            
                #SQL statement to delete details from the database where corresponding username matches
                $update = "UPDATE users SET firstname = '$firstname', lastname = '$lastname', username = '$username', email = '$email' WHERE username = '$username' ";
                $result = $connect->query($update);

                // If resut is queried, carry out this functions
                if ($result){
                    $_SESSION["firstname"] = $firstname;
                    $_SESSION["lastname"] = $lastname;
                    $_SESSION["username"] = $username;
                    $_SESSION["email"] = $email;
                    $_SESSION["status"] = "Update Effected! ";
                    $_SESSION["icon"] = "success";
                    $location = "Location: home.php";
                    header($location);
                    exit();
                }else{
                    $_SESSION["status"] = "Not Effected";
                    $_SESSION["icon"] = "error";
                    $location = "Location: home.php";
                    header($location);
                    exit();   
                }
            }  // Else complete the update form to avoid empty fills
            else{
                $_SESSION["status"] = "Not Effected, Please Complete the update form ";
                $_SESSION["icon"] = "error";
                $location = "Location: home.php";
                header($location);
                exit();
                }
    }
    // End of the user update button

    // To change the users password when activated
    if(isset($_POST["change"])) {

        // Check to ascertain newpassword is not empty and it is the same with the confirm password
            if(!empty($newpassword) || ($newpassword == $confirmpassword)){

                $password = _checkInput($_POST["password"]);      # Apply security function and assign to variable password
                $newpassword = _checkInput($_POST["new_password"]);
                $confirmpassword = _checkInput($_POST["confirm_password"]);

        // Query the database to get the old password 
                $querypassword = "select password FROM users Where username = '$username' ";    # Select hashed password from DB
                $password_result = $connect->query($querypassword);                             # Execute Query
            
                foreach ($password_result as $row) {
                    $_SESSION["password"] = $row['password'];        # Store result in the session password variable
                }
            
                if (password_verify($password, $_SESSION["password"])) {     # Verify the password matches the hash
                     
                    /* Hashing the New Password */
                    $options = [
                        'cost' => 12,
                    ];
                    $hashed_password = password_hash($newpassword, PASSWORD_BCRYPT, $options);


                    $update = "UPDATE users SET password = '$hashed_password' WHERE username = '$username' ";
                    $result = $connect->query($update);

                    if ($result) {
                        $_SESSION["status"] = "Password Changed ";
                        $_SESSION["icon"] = "success";
                        $location = "Location: home.php";
                        header($location);
                        exit();
                    } else {
                        $_SESSION["status"] = "Password not changed ";
                        $_SESSION["icon"] = "Error";
                        $location = "Location: home.php";
                        header($location);
                        exit();
                    }
                } // Else old password cannot ascertain the new change
                else {
                        $_SESSION["status"] = "Old Password is not verified ";
                        $_SESSION["icon"] = "error";
                        $location = "Location: home.php";
                        header($location);
                        exit();
                    }

                } // if newpassword is empty and it is not the same with the confirm password, give warning
                else {
                    $_SESSION["status"] = "Both Passwords are not the same ";
                    $_SESSION["icon"] = "warning";
                    $_SESSION["display"] = "Retype please";
                    $location = "Location: home.php";
                    header($location);
                    exit();
                }
            }

            
            
        $connect = null;
}

?>