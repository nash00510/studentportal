<?php
	include('head.php');
	include('conn.php');

	$username = $_POST['lUsername'];
	$password = $_POST['lPassword'];

	$results = mysqli_query($connect, "SELECT * FROM `Users` WHERE Username = '$username'");
	$num = $results -> num_rows;

	if($num > 0){
		while($row = $results->fetch_assoc()){
			if($row['Password'] == hash('sha512', $password.$row['Salt'])){
				$_SESSION['Type'] = $row['AccountType'];
				$_SESSION['Username'] = $username;
				if($row['ProfilePicture'] != NULL){
					$_SESSION['ProfilePicture'] = $row['ProfilePicture'];
				}else{
					$_SESSION['ProfilePicture'] = "images/profiletemp.jpg";
				}
				if($row['Banner'] != "" && $row['Banner'] != NULL){
					$_SESSION['Banner'] = $row['Banner'];
				}else{
					$_SESSION['Banner'] = "images/profiletemp.jpg";
				}
				
				
				if($_SESSION['Type'] == "Student"){
					$course = mysqli_query($connect, "SELECT CourseCode, FirstName, MiddleName, Surname FROM `Student` WHERE Username = '$username'");
					while($row2 = $course->fetch_assoc()){
						$_SESSION['Course'] = $row2['CourseCode'];
						$_SESSION['FirstName'] = $row2['FirstName'];
						$_SESSION['MiddleName'] = $row2['MiddleName'];
						$_SESSION['Surname'] = $row2['Surname'];
						echo $_SESSION['Course'];
					}
				}else if($_SESSION['Type'] == "Tutor"){
					$course = mysqli_query($connect, "SELECT TutorID, FirstName, Surname FROM `Tutor` WHERE Username = '$username'");
					while($row2 = $course->fetch_assoc()){
						$_SESSION['ID'] = $row2['TutorID'];
						$_SESSION['FirstName'] = $row2['FirstName'];
						$_SESSION['Surname'] = $row2['Surname'];
					}
				}
				
				
				echo $_SESSION['Type'].' and '.$_SESSION['Username'];
				header('location:index.php');
			}else{
				echo 'Incorrect Password';
			}
		}
	}else {
		echo 'Could not find user';	
	}
?>