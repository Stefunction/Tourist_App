<?php
session_start();                # Retrieve a session

error_reporting(E_ALL);         #Errors encountered are reported

require "connect.php";          #Establish a connection with the PDO object created

function _checkInput($data)     # To validate input
{ 
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

# Validate the value from the Modal and store in variables
$new_password = _checkInput($_POST['new_password']);
$user_id = _checkInput($_POST['user_id']);


if(isset($_POST['reset_user'])){        # If reset button is activated 
    
    $role  = _checkInput($_POST['user_role']);      # Validate the role value from the Modal and store in variables
    
    if(!empty($role) && !empty($new_password)){     # Check to see role and password input is not empty
    
        if($role == "Admin"){           # If role is picked as Admin
            $new_role = 2;              # Make adequate Changes where Admin = 2 amd User = 1;
        }else{                          # Else all others are Users
            $new_role = 1;
        }

         /* Hashing the Password to correspond to verification if user logs on*/
        $options = [
            'cost' => 12,
        ];
        $hashed_password = password_hash($new_password, PASSWORD_BCRYPT, $options);
    
        /* Carry Out SQL Query */
        $query = "UPDATE `users` SET password ='$hashed_password', roleID = '$new_role' WHERE userID = '$user_id' ";
    
        $result = $connect ->query($query);
        if($result){                    # If successful, store the following into different session variables

            $_SESSION["status"] = "Password set to Default " . $new_password;
            $_SESSION["icon"] = "success";
            $location = "Location: admin.php";          # Store the redirected page to variable location
            header($location);                          # Redirect to the admin page
            exit();                                     # Exit when executed
            
            
        }else{                      # Else send an error message to the admin to show not effected!!!

            $_SESSION["status"] = "Error Occured!!!";
            $_SESSION["icon"] = "error";
            $location = "Location: admin.php";           # Store the redirected page to variable location
            header($location);                          # Redirect to the admin page
            exit();                                     # Exit when executed
            
            }
    }else{              # If role and password input is empty, prompt Admin to select both to apply

        $_SESSION["status"] = "Please Select all to apply ";
        $_SESSION["icon"] = "warning";
        $location = "Location: admin.php";              # Store the redirected page to variable location
        header($location);                              # Redirect to the admin page
        exit();                                         # Exit when executed
        
    }
}
    
if(isset($_POST["delete_user"])){          #If the delete button is activated 

    /* Carry Out SQL Query to get specific User */
    $user = "SELECT username FROM users where userID = '$user_id'";
    $user_result = $connect->query($user);

    foreach($user_result as $known){        
        $Name = $known["username"];             # Store the returned result to name variable
    }

     /* Carry Out SQL Query to delete specific User from DB*/
    $delete_query = "DELETE FROM users where userID = '$user_id'";
    $result = $connect->query($delete_query);

    if($result){                           # If successful, store the following into different session variables

        $_SESSION["status"] = $Name . "'s Account deleted successfully!!!";
        $_SESSION["icon"] = "success";
        $location = "Location: admin.php";
        header($location);
        exit();
        
    }else{                                 # Else send an error message to the admin to show not effected!!!
        $_SESSION["status"] = $Name . "'s Account not deleted... ERROR!!!";
        $_SESSION["icon"] = "error";
        $location = "Location: admin.php";
        header($location);
        exit();
    }
    
}

?>