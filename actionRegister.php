<?php
include('conn.php');

$fname = $_POST['fName'];
$lname = $_POST['lName'];
$company = $_POST['company'];
$username = $_POST['username'];
$password = $_POST['password'];
$cPassword = $_POST['confirmPassword'];
$email = $_POST['email'];

$communityTable = "INSERT INTO `Community` (`CommunityID`, `Username`, `FirstName`, `Surname`, `Company`, `Mobile`, `Email`) VALUES (NULL, '$username', '$fname', '$lname', '$company', 'NULL', '$email');";



$results = mysqli_query($connect, "SELECT * FROM `Users` WHERE Username = '$username'");
if($results->num_rows > 0){
	echo "Username already exists";	
}else if($password != $cPassword){
	echo "Passwords do not match";
}else {
	$salt = md5(rand(0,microtime(true)*100000));
	$hashedPassword = hash('sha512', $password.$salt);
	$userTable = "INSERT INTO `Users` (`Username`, `Password`, `Salt`, `AccountType`) VALUES ('$username', '$hashedPassword', '$salt', 'Community');";
	mysqli_query($connect, $userTable);
	mysqli_query($connect, $communityTable);
	
	
	echo 'user added to the database';
}


?>