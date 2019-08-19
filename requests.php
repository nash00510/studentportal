<?php
	include('conn.php');
	include('head.php');
	include('navigation.php');

	$result = mysqli_query($connect, "SELECT StudentID FROM Student WHERE Username = '$student'");
	$value = $result->fetch_row();
	$sID = $value[0];
	

	
?>

<div class="page">
	<div class="topHeader">
		<img class="topHeaderLogo" src=""><h1>ATC Vision College</h1>
	</div>
	
	<div class="content">
		<?php
			$info = mysqli_query($connect, "SELECT * FROM Requests INNER JOIN Student ON Requests.StudentID = Student.StudentID INNER JOIN Community ON Requests.CommunityID = Community.CommunityID ");

			/*
			*STUDENT PART
			*/
			if($_SESSION['Type'] == 'Student'){
				$result = mysqli_query($connect, "SELECT StudentID FROM Student WHERE Username = '".$_SESSION['Username']."'");
				$value = $result->fetch_row();
				$sID = $value[0];
				$result = mysqli_query($connect, "SELECT CommunityID FROM Community WHERE Username = '".$_SESSION['Username']."'");
				$value = $result->fetch_row();
				$cID = $value[0];
				$info = mysqli_query($connect, "SELECT Requests.*,
				Requests.Email AS rEmail,
				Requests.Mobile AS rMobile,
				Requests.CommunityID AS cID,
				Student.FirstName AS sFirstName,
				Student.Surname AS sSurname,
				Student.Email AS sEmail,
				Student.Mobile AS sMobile,
				Student.Username AS sUsername,
				Community.*
				FROM Requests INNER JOIN Student ON Requests.StudentID = Student.StudentID INNER JOIN Community ON Requests.CommunityID = Community.CommunityID WHERE Requests.StudentID = '$sID'");
				
				while($req = $info->fetch_assoc()){
					$cID = $req['cID'];
					echo '<div class="requestContainer">';
					echo '<form method="post"><input type="hidden" name="studentID" value="'.$sID.'"/><input type="hidden" name="communityID" value="'.$cID.'"/>';
					echo 	'<span class="requestItem">'.$req['FirstName'].' </span>';
					echo 	'<span class="requestItem">'.$req['Surname'].' </span>';
					echo 	'<span class="requestItem">'.$req['Company'].' </span>';
					if($req['rEmail'] == 'R'){
						echo 	'<span class="requestItem"><input type="submit" formaction="actionEmailReq.php?action=accept" value="Accept Email"/><input type="submit" formaction="actionEmailReq.php?action=decline" value="Decline Email"/></span>';
					}else if($req['rEmail'] == NULL){
						echo '<span class="requestItem">Not Rquested</span>';
					}else {
						echo '<span class="requestItem">Accepted</span>';
					}
					
					if($req['rMobile'] == 'R'){
						echo 	'<span class="requestItem"><input type="submit" formaction="actionMobileReq.php?action=accept" value="Accept Mobile"/><input type="submit" formaction="actionMobileReq.php?action=decline" value="Decline Mobile"/></span>';
					}else if($req['rMobile'] == NULL){
						echo '<span class="requestItem">Not Rquested</span>';
					}else {
						echo '<span class="requestItem">Accepted</span>';
					}
					echo '</div>';
				}
				
				
			/*
			*COMMUNITY PART
			*/
			}else if($_SESSION['Type'] == 'Community'){
				$result = mysqli_query($connect, "SELECT CommunityID FROM Community WHERE Username = '".$_SESSION['Username']."'");
				$value = $result->fetch_row();
				$cID = $value[0];
				$info = mysqli_query($connect, "SELECT Requests.*,
				Requests.Email AS rEmail,
				Requests.Mobile AS rMobile,
				Student.FirstName AS sFirstName,
				Student.Surname AS sSurname,
				Student.Email AS sEmail,
				Student.Mobile AS sMobile,
				Student.Username AS sUsername,
				Community.*
				FROM Requests INNER JOIN Student ON Requests.StudentID = Student.StudentID INNER JOIN Community ON Requests.CommunityID = Community.CommunityID WHERE Requests.CommunityID = '$cID'");
				
				echo '<table class="requestsContainer">';
				echo '<tr><th>First Name</th><th>Surname</th><th>Email</th><th>Mobile</th><th></th></tr>';
				while($req = $info->fetch_assoc()){
					
					echo '<tr>';
					echo 	'<td class="request">'.$req['sFirstName'].'</td>';
					echo 	'<td class="request">'.$req['sSurname'].'</td>';
					echo 	'<td class="request">';
					if($req['rEmail'] == 'R'){echo 'Requested';}else if($req['rEmail'] == NULL){echo 'Not Requested';}else{echo $req['rEmail'];}
					echo	'</td>';
					echo 	'<td class="request">';
					if($req['rMobile'] == 'R'){echo 'Requested';}else if($req['rMobile'] == NULL){echo 'Not Requested';}else{echo $req['rMobile'];}
					echo	'</td>';
					echo 	'<td><a href="portfolio.php?student='.$req['sUsername'].'">Portfolio</a></td>';
					echo '</tr>';
					
				}
				echo '</div>';
			}

		?>
	</div>
	
</div>