<?php
error_reporting(E_ALL);     #Errors encountered are reported

require "connect.php";      #Establish a connection with the PDO object created

session_start();            #Begin a Session   

htmlspecialchars($_SERVER["PHP_SELF"]);    #To protect against XSS injection

#Function to ascertain input is not an sql injection by removing characters and spaces

function _checkInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {         # If form was submitted using POST method
    $username = _checkInput($_POST["username"]);    # Apply security function and assign to variable username
    $password = _checkInput($_POST["password"]);    # Apply security function and assign to variable password
    $newpassword = _checkInput($_POST["newpass"]);
    $confirmpassword = _checkInput($_POST["cnewpass"]);
}


if (!empty($_POST["username"]) && !empty($_POST["password"])) {

    $querypassword = "select password FROM users Where username = '$username' ";    # Select hashed password from DB
    $password_result = $connect->query($querypassword);                             # Execute Query


    foreach ($password_result as $row) {
        $_SESSION["password"] = $row['password'];        # Store result in the session password variable
    }

    if (password_verify($password, $_SESSION["password"])) {     # Verify the password matches the hash

        #SQL statement to get details from the database where corresponding username matches
        $queryID = "select userID, username, firstname, lastname, email, password, roleID FROM users Where username = '$username' ";
        $result = $connect->query($queryID);         # Execute query and store in variable result

        # setting the fetch mode
        $result->setFetchMode(PDO::FETCH_ASSOC);

        foreach ($result as $row) {                              # For each column fetched, store in its corresponding session variable
            $_SESSION["userID"] = $row['userID'];
            $_SESSION["username"] = $row['username'];
            $_SESSION["firstname"] = $row['firstname'];
            $_SESSION["lastname"] = $row['lastname'];
            $_SESSION["email"] = $row['email'];
            $_SESSION["password"] = $row['password'];
            $_SESSION["roleID"] = $row['roleID'];
        }

        if (isset($result)) {    # Double check the result is set

            // To take the login Time
            $login_time = date('Y-m-d H:i:s');

            $time = "Insert into access (userName, login_Time) Values ('$username', '$login_time') ";
            $time_query = $connect->query($time);


            if ($_SESSION["roleID"] == 1) {        # If roleID variable is 1,
                $_SESSION["status"] = "Welcome ";    # passed in status message
                $_SESSION["icon"] = "success";
                $location = "Location: home.php";
                header($location);
                exit();
                // header("Location: home.php");    # Forward to the user home page
            } else {
                $_SESSION["status"] = "Admin Logged IN";   # passed in status message
                $_SESSION["icon"] = "success";
                $location = "Location: admin.php";     # Else forward to the admin Page
                header($location);
                exit();
            }

            exit();                                # Exit from here, no continuation. 
        } else {
            $_SESSION["status"] = "User Not Found";      # passed in status message
            $_SESSION["icon"] = "error";
            $location = "Location: login.php";
            header($location);
            exit();
        }
    } else {
        $_SESSION["status"] = "Incorrect password";      # passed in status message
        $_SESSION["icon"] = "info";
        $location = "Location: login.php";
        header($location);
        exit();
    }
} elseif (isset($_POST["resetPass"])) {

    if ($newpassword == $confirmpassword) {

        $probeName = "Select username FROM Users where username = '$username'";
        $probeNameResult = $connect->query($probeName);

        if ($probeNameResult->rowCount() > 0) {

            /* Hashing the new Password */
            $options = [
                'cost' => 12,
            ];
            $hashed_password = password_hash($newpassword, PASSWORD_BCRYPT, $options);
            $resetquery = "Update users SET password = '$hashed_password' where username = '$username'";

            $result = $connect->query($resetquery);
            if ($result) {
                $_SESSION["status"] = "Updated Effected";
                $_SESSION["icon"] = "success";
                $location = "Location: login.php";
                header($location);
                exit();
            } else {
                $_SESSION["status"] = "There seems to be an error??";
                $_SESSION["icon"] = "error";
                $location = "Location: login.php";
                header($location);
                exit();
            }
        } else {
            $_SESSION["status"] = "No account associated with username";  ##passed in
            $_SESSION["icon"] = "info";
            $location = "Location: login.php";
            header($location);
            exit();
        }
    } else {
        $_SESSION["status"] = "Both Passwords are not the same";   ##passed in
        $_SESSION["icon"] = "warning";
        $location = "Location: login.php";
        header($location);
        exit();
    }
} else {
    $_SESSION["status"] = "Please fill Username and Password";   ##passed in
    $_SESSION["icon"] = "warning";
    $location = "Location: login.php";
    header($location);
    exit();
}
