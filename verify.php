<?php
    error_reporting(E_ALL);

    require "connect.php";


    htmlspecialchars($_SERVER["PHP_SELF"]) ;#for protection against xss injection
   
    $_SESSION = session_start() ; #to start a session

    if(!Isset($_POST["username"]) ||  !Isset($_POST["password"])){

        session_destroy();
        header("Location: login.html");
        exit();

    } else{
  
        function _checkInput($data){ #to validate input
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    
        if ($_SERVER["REQUEST_METHOD"] == "POST") { #to check if form was submitted
            $username = _checkInput($_POST["username"]); #to get the usernam input from login form
            $password = _checkInput($_POST["password"]);
        }
    
        $queryID = "select userID, username FROM users Where username = '$username' and password = '$password' ";
        $result = $connect->exec($queryID);

        if (Isset($result)){

             #if (!isset($_SESSION["userID"])){ #to check existence of userid in session and if user has logged in
                $_SESSION["userID"] = $ui;
                $_SESSION["username"] = $un; #to store username into session variable
                header("Location: home.php"); #to forward to another url
                exit();	
           # }  
           # else{
                #echo "User not found"; kit said must not have a generated output before header call, else header wont work
             #   header("Location: login.html");
              #  exit();
               # }

        }else{
            
            session_destroy();
            header("Location: login.html");
            echo "No user Found";  #change this to a modal on the login page
        }
    }


?>




