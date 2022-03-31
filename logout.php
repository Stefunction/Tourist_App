<?php
session_start();				//retrieve session

require "connect.php";         // Establish a connection with the PDO object created

if (isset($_SESSION["username"])) {

	$username = $_SESSION["username"];   // Store username to session variable
}

// Take note of the logout time
$logout_time = date('Y-m-d H:i:s');

// Carry Out SQL statement to update access log table
$time = "Update access SET logout_Time = '$logout_time' where userName = '$username'";
$time_query = $connect->query($time);

// Store logout messages to display
$_SESSION["del_account"] = "Logged Out " . $username;
$_SESSION["icon"] = "success";

// Terminate session
unset($_SESSION["username"]);

// Redirect to the login page
$location = "Location: login.php";
header($location);
exit();
