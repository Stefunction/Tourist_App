<?php
    require "connect.php";

    $_SESSION = session_start()  #to start a session

    echo htmlspecialchars($_SERVER["PHP_SELF"]) #for protection against xss injection
    
    function _checkInput($data){ #to validate input
        $data = trim($data);
        $data = striplashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    if ($_SERVER["REQUEST_METHOD"] == "POST") { #to check if form was submitted
        $username = _checkInput($_POST["username"]); #to get the usernam input from login form
        $password = _checkInput($_POST["password"]);
    }
    
    $queryID = "SELECT userID FROM TableName Where Preferred_Name = '$username' and Password = '$password' ";
    $result = $connect -> exec($queryID);

#how do we get the userid in, how do we check user credential to be able to store it to userid
    if (isset($_SESSION["userID"])){ #to check existence of userid in session and if user has logged in
        $_SESSION["userID"] = $username; #to store username into session variable
        header("Location: home.php"); #to forward to another url
    }  
    else{
        #echo "User not found"; kit said must not have a generated output before header call, else header wont work
        header("Location: login.html");
        exit();
    }
?>


