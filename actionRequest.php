<?php
	include('conn.php');
	include('head.php');

	$student = $_POST['student'];
	$user = $_SESSION['Username'];

	$result = mysqli_query($connect, "SELECT StudentID FROM Student WHERE Username = '$student'");
	$value = $result->fetch_row();
	$sID = $value[0];

	$result = mysqli_query($connect, "SELECT CommunityID FROM Community WHERE Username = '$user'");
	$value = $result->fetch_row();
	$cID = $value[0];

	$entryExists = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM Requests WHERE StudentID = '$sID' AND CommunityID = '$cID'"));
	
	if($entryExists > 0){
		if($_GET['req'] == 'email'){
			$insert = "UPDATE Requests SET Email = 'R' WHERE StudentID = '$sID' AND CommunityID = '$cID'";
		}else if($_GET['req'] == 'mobile'){
			$insert = "UPDATE Requests SET Mobile = 'R' WHERE StudentID = '$sID' AND CommunityID = '$cID'";
		}
	}else {
		if($_GET['req'] == 'email'){
			$insert = "INSERT INTO Requests (StudentID, CommunityID, Email) VALUES ('$sID', '$cID', 'R')";
		}else if($_GET['req'] == 'mobile'){
			$insert = "INSERT INTO Requests (StudentID, CommunityID, Mobile) VALUES ('$sID', '$cID', 'R')";
		}
	}

	mysqli_query($connect, $insert);
	echo $insert.'<br>';
	echo $student.'<br>';
	echo $user.'<br>';
	header('location:portfolio.php?student='.$student);
?>