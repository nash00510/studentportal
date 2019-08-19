<?php
	include('conn.php');
	include('head.php');
	
	$action = $_GET['action'];
	$studentID = $_POST['studentID'];
	$communityID = $_POST['communityID'];

	$studentInfo = mysqli_query($connect, "SELECT Mobile FROM Student WHERE StudentID = '$studentID'");
	
	echo $action.' '.$studentID.''.$communityID;
	
	while($info = $studentInfo->fetch_assoc()){
		echo $info['Mobile'];
		if($action == 'accept'){

		$update = "UPDATE Requests SET Mobile = '".$info['Mobile']."' WHERE StudentID = '$studentID' AND CommunityID = '$communityID'";
		mysqli_query($connect, $update);
			
		}else if($action == 'decline'){
			$update = "UPDATE Requests SET Mobile = NULL WHERE StudentID = '$studentID' AND CommunityID = '$communityID'";
			mysqli_query($connect, $update);
		}
	}

	header('location:requests.php');
?>