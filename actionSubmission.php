<?php
	include('conn.php');
	include('head.php');
	include('checkLoggedIn.php');

	//Get field values from the form on submitAssignment.php
	$assignment = $_POST['assignment'];
	$notes = $_POST['submissionNotes'];
	
	//if a file was uploaded to the input
	if(isset($_FILES['file']["name"])){
		//folder
		$dir = "submissions/";
		//full file path
		$file = $dir . basename($_FILES["file"]["name"]);
		//file extension
		$imageFileType = pathinfo($file,PATHINFO_EXTENSION);
		//the name of the file before the extension
		$filesName = basename($file, '.'.$imageFileType);
	
		$count = 1;
		while(file_exists($file)){
			//if a file exists even with the number on the end
			if(file_exists($dir.$filesName.$count.'.'.$imageFileType)){
				//dont rename anything
			}else { //if not
				$filesName = $filesName.$count; //update the file name
				$file = $dir.$filesName.'.'.$imageFileType;//update the full path
			}
			$count++;//increase count
		}
		
		$insertFileUrl = "INSERT INTO `Submissions` (Username, AssignmentCode, FilePath, DateSubmitted, Notes) VALUES ('".$_SESSION['Username']."', '$assignment', '$file', DATE '".date('Y-m-d')."', '$notes')";
		
		if(move_uploaded_file($_FILES["file"]["tmp_name"], $file)){
			//insert the file url into the images table
			mysqli_query($connect, $insertFileUrl);
			$_SESSION['uploadMessage'] = "File was uploaded";
		}else {
			$_SESSION['uploadMessage'] = "File was not uploaded";
		}
		
		header('location:'.$_SERVER['HTTP_REFERER']);
		
	}
?>