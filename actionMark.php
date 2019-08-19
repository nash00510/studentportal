<?php
	include('conn.php');
	include('head.php');

	$student = $_POST['student'];
	$grade = $_POST['grade'];
	$assignment = $_POST['assignment'];
	
	$check = mysqli_query($connect, "UPDATE Submissions SET Grade = ".$grade.", MarkedRubric = NULL WHERE Username = '".$student."' AND AssignmentCode = '".$assignment."'");

	$query = mysqli_query($connect, "SELECT CourseCode FROM Assignments WHERE AssignmentCode = '$assignment'");
	$course = $query->fetch_row();
	echo $course[0].' '.$assignment;
	//if a file was uploaded to the input
	if(isset($_FILES['rubric']["name"])){
		//folder
		echo $course[0].' '.$assignment;
		$dir = "submissions/".$course[0].'/'.$assignment.'/';
		if(!file_exists($dir)) {
    		mkdir($dir, 0777, true);
		}
		//full file path
		$file = $dir . basename($_FILES["rubric"]["name"]);
		//file extension
		$fileType = pathinfo($file,PATHINFO_EXTENSION);
		//the name of the file before the extension
		$filesName = $student.$assignment."Rubric";
		
		$file = $dir.$filesName.'.'.$fileType;
	
		
		$insertFileUrl = "UPDATE `Submissions` SET MarkedRubric = '$file' WHERE Username = '$student' AND AssignmentCode = '$assignment'";
		
		if(move_uploaded_file($_FILES["rubric"]["tmp_name"], $file)){
			//insert the file url into the images table
			mysqli_query($connect, $insertFileUrl);
			echo 'yeeeeeeet';
			$_SESSION['uploadMessage'] = "File was uploaded";
		}else {
			$_SESSION['uploadMessage'] = "File was not uploaded";
		}
	}

	//header('location:assignment.php?id='.$assignment);
?>