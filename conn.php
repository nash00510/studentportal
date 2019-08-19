<?php
	/*We populate these variables with information from our database*/
	$db_host="localhost:3306"; //Usually Localhost
	$db_user="ns12345"; //Database Admin
	$db_pass="ns12345";//User Password for Database
	$db_name="ns032_studentportal";//Name of the database
	
	/*Create the connection*/
	$connect = mysqli_connect($db_host,$db_user,$db_pass,$db_name);
	
	/*If statement to test if the connection is working*/
	if (mysqli_connect_errno()) {
		echo "Failed to connect to database: ".msqli_connect_error();
	}else {
		//echo "Database Connected";
	}
?>