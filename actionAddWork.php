<?php
	include('conn.php');
	include('head.php');

	$username = $_SESSION['Username'];
	echo $_POST['workid'];
	$workID = $_POST['workid'];
	
	$company = $_POST['company'];
	$position = $_POST['position'];
	$length = $_POST['length'];
	$desc = $_POST['description'];

	echo $username.$workID.$company.$position.$length.$desc;

	$sql = "INSERT INTO WorkExperience (`workID`, `Username`, `Company`, `Position`, `Length`, `Description`) VALUES (NULL, '$username', '$company', '$position', $length, '$desc')";

	mysqli_query($connect, $sql);

	header('location:editprofile.php');
?>