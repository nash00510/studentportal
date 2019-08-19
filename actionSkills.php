<?php
	include('conn.php');
	include('head.php');
	
	$student = $_SESSION['Username'];
	echo $student;

	$javascript =  isset($_POST['skill1']) ? 't' : 'f';
	$css = isset($_POST['skill2']) ? 't' : 'f';
	$sql = isset($_POST['skill3']) ? 't' : 'f';
	$webdesign = isset($_POST['skill4']) ? 't' : 'f';
	$html = isset($_POST['skill5']) ? 't' : 'f';
	$php = isset($_POST['skill6']) ? 't' : 'f';
	$photoshop = isset($_POST['skill7']) ? 't' : 'f';
	$content = isset($_POST['skill8']) ? 't' : 'f';
	
	$check = "SELECT * FROM Skills WHERE Username = '$student'";

	if(mysqli_num_rows(mysqli_query($connect, $check)) > 0){
		$query = "UPDATE `Skills` SET `Javascript` = '$javascript', `CSS3` = '$css', `EssQueEl` = '$sql', `WebDesign` = '$webdesign', `HTML5` = '$html', `PHP5` = '$php', `Photoshop` = '$photoshop', `ContentOptimisation` = '$content' WHERE Username = '$student'";
	}else{
		$query = "INSERT INTO Skills `Skills`(`skillID`, `Username`, `Javascript`, `CSS3`, `EssQueEl`, `WebDesign`, `HTML5`, `PHP5`, `Photoshop`, `ContentOptimisation`) VALUES (NULL,'$student','$javascript','$css','$sql','$webdesign','$html','$php','$photoshop','$content')";
	}

	if(mysqli_query($connect, $query)){
		$_SESSION['message'] = 'Successfully Updated Skills';
		header('location:editprofile.php');
	}else{
		$_SESSION['message'] = 'Failed to Update Skills';
	}


?>