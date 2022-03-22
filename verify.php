<?php
    error_reporting(E_ALL);  #To report all errors encountered

    require "connect.php";      #Establish a connection using object created

    session_start() ;   #start a session

    htmlspecialchars($_SERVER["PHP_SELF"]) ;    #For protection against xss injection
    

    if ( empty($_POST["username"]) && empty($_POST["password"])) {      # if username and password is empty
        session_destroy();                                              # Terminate session and
        header("Location: login.php");                                  # Redirect to the login page
        exit();                                                         # Exit from here, no continuation.
    } 
    
#Function to ascertain input is not an sql injection by removing characters and spaces

    function _checkInput($data){ #to validate input
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    if ($_SERVER["REQUEST_METHOD"] == "POST") {         # If form was submitted using POST 
        $username = _checkInput($_POST["username"]);    # Apply security function and assign to variable username
        $password = _checkInput($_POST["password"]);    # Apply security function and assign to variable username
    }
    
#SQL statement to get userID and username from the database where corresponding parameters matches
    $queryID = "select userID, username, firstname, lastname FROM users Where username = '$username' and password = '$password' ";
    $result = $connect->query($queryID);         # Execute query and store in variable result

  
# setting the fetch mode
$result->setFetchMode(PDO::FETCH_ASSOC);
  
foreach ($result as $row){
// while($row = $result->fetch()) {
    $_SESSION["userID"] = $row['userID'];
    $_SESSION["username"] = $row['username'];
    $_SESSION["firstname"] = $row['firstname'];
    $_SESSION["lastname"] = $row['lastname'];
    
}





    if (isset($result)){
             #if (!isset($_SESSION["userID"])){ #to check existence of userid in session and if user has logged in

                // $_SESSION["userID"] = $userID;
                // $_SESSION["username"] = $username; #to store username into session variable
                // $_SESSION["firstname"] = $firstname;
               
                header("Location: home.php"); #to forward to another url
                exit();	
             }  
           # else{
                #echo "User not found"; kit said must not have a generated output before header call, else header wont work
             #   header("Location: login.html");
              #  exit();
               # }

        // }
            
            session_destroy();
            header("Location: login.php");
           // echo "No user Found";  #change this to a modal on the login page
