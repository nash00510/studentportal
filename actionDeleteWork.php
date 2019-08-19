<?php
	include('conn.php');
	include('head.php');

	$workID = $_POST['workid'];
	echo $workid;

	$sql = "DELETE FROM WorkExperience WHERE `workID` = $workID";

	mysqli_query($connect, $sql);

	header('location:editprofile.php');
?>