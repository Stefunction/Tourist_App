<?php
    error_reporting(E_ALL);     #Errors encountered are reported

    require "connect.php";      #Establish a connection with the PDO object created

    session_start();            #Begin a Session   

    htmlspecialchars($_SERVER["PHP_SELF"]) ;    #To protect against XSS injection

    if (empty($_POST["username"]) && empty($_POST["password"])) {       # If username and password input is empty
        session_destroy();                                              # Terminate the session and
        header("Location: login.php");                                  # Redirect to the login page
        exit();                                                         # Exit from here, no continuation.
    }
    
    #Function to ascertain input is not an sql injection by removing characters and spaces

    function _checkInput($data){    
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    if ($_SERVER["REQUEST_METHOD"] == "POST") {         # If form was submitted using POST method
        $username = _checkInput($_POST["username"]);    # Apply security function and assign to variable username
        $password = _checkInput($_POST["password"]);    # Apply security function and assign to variable password
    }


    $querypassword = "select password FROM users Where username = '$username' ";    # Select hashed password from DB
    $password_result = $connect->query($querypassword);                             # Execute Query

    foreach($password_result as $row){
        $_SESSION["password"] = $row['password'];        # Store result in the session password variable
    }

    if (password_verify($password, $_SESSION["password"])){     # Verify the password matches the hash

        #SQL statement to get details from the database where corresponding username matches
        $queryID = "select userID, username, firstname, lastname, roleID FROM users Where username = '$username' ";
        $result = $connect->query($queryID);         # Execute query and store in variable result

        # setting the fetch mode
        $result->setFetchMode(PDO::FETCH_ASSOC);

        foreach ($result as $row){                              # For each column fetched, store in its corresponding session variable
                $_SESSION["userID"] = $row['userID'];
                $_SESSION["username"] = $row['username'];
                $_SESSION["firstname"] = $row['firstname'];
                $_SESSION["lastname"] = $row['lastname'];
                $_SESSION["roleID"] = $row['roleID'];
            }

            if (isset($result)){    # Double check the result is set

                  if($_SESSION["roleID"] == 1) {        # If roleID variable is 1,
                       header("Location: home.php");    # Forward to the user home page
                   } else{
                       header("Location: admin.php");   # Else forward to the admin Page
                   }
                    
                   exit();	                            # Exit from here, no continuation. 
                }  
                 # else{
                #echo "User not found"; kit said must not have a generated output before header call, else header wont work
             #   header("Location: login.html");
              #  exit();
               # }

    }else{
         session_destroy();
            header("Location: login.php");
    }


        // }
            
            // session_destroy();
            // header("Location: login.php");
           // echo "No user Found";  #change this to a modal on the login page
