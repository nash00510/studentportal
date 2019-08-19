<?php
	include('conn.php');
	//if there is a user logged in
	if(isset($_SESSION['Username'])){

	//else no one is logged in
	}else{
		//redirect to the login page
		header('location:login.php');
	}
?>