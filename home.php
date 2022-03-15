<?php
	session_start();			//retrieve session		

	if (!IsSet($_SESSION["userID"]) || !IsSet($_SESSION["username"]))	//if not previoulsly logged on	
		header("Location: login.php");	            //redirect to login page
	$username=$_SESSION["username"];		//get user name into variable $username
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Home Page</title>
</head>
<body>
<h2>home sweet home</h2>
    
</body>
</html>