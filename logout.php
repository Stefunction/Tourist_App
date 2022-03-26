<?php
	session_start();				//retrieve session
	
	require "connect.php"; 
	
	
	if(isset($_SESSION["username"])){

		$username = $_SESSION["username"];
		$login_time = $_SESSION["login_time"];
	}
	
			$logout_time = date('Y-m-d H:i:s');

			print_r($_SESSION["username"]);
            
            // $time = "Insert into access (userName, login_Time, logout_Time) Values ('$username', '$login_time', '$logout_time') ";
            // $time_query = $connect->query($time);

			// && !empty($_SESSION["login_time"])
	session_destroy();				// destroy
	header("Location: login.php");	//redirect to login page
?>