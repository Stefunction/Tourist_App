<?php
	session_start();				//retrieve session
	session_destroy();				// destroy
	header("Location: login.php");	//redirect to login page
?>