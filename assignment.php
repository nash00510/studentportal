<?php
	include('head.php');
	include('checkLoggedIn.php');
	include('conn.php');
	
	
	$assignment = $_GET['id'];
	include('navigation.php');
?>

<div class="page">
	<div class="topHeader">
		<img class="topHeaderLogo" src=""><h1>ATC Vision College</h1>
	</div>

	<div class="content">	
	<?php
		if(isset($assignment)){
		echo '<div class="assignment">';
			if($_SESSION['Type'] == 'Tutor'){
				echo 'tutor stuff';	
				
				$submissions = mysqli_query($connect, "SELECT * FROM Submissions INNER JOIN Student ON Submissions.Username = Student.Username WHERE AssignmentCode = '$assignment' ORDER BY DateSubmitted ASC");
				
				$count = 0;
				while($sub = $submissions->fetch_assoc()){
					echo '<div class="tutorSub">';
					echo '<h3 onclick="showStudentSub('.$count.')">'.$sub['FirstName'].' '.$sub['Surname'].' - '.$sub['DateSubmitted'].'</h3>';
					echo '<div class="subDetails">';
					echo '<form class="tutorSubForm" method="post" action="actionMark.php" enctype="multipart/form-data"><input type="hidden" name="student" value="'.$sub['Username'].'"/><input type="hidden" name="assignment" value="'.$assignment.'"/>';
					echo '<label for="grade">Grade:</label><input type="number" min="0" max="100" name="grade" value="'.$sub['Grade'].'">';
					if($sub['MarkedRubric'] == NULL){
						echo '<input type="file" name="rubric"/>';
					}else {
						echo '<a href="'.$sub['MarkedRubric'].'" download>Marked Rubric</a>';	
					}
					
					echo '<a href="'.$sub['FilePath'].'" download>Assignment</a>';
					echo '<input type="submit"/>';
					echo '</form>';
					echo '</div>';
					echo '</div>';
					$count++;
				}
				
			}else{
$results = mysqli_query($connect, "SELECT * FROM `Assignments` WHERE `AssignmentCode` = '$assignment'");
		$results2 = mysqli_query($connect, "SELECT DISTINCT LearningOutcomes.ModuleID, Modules.ModuleName FROM `LearningOutcomes` INNER JOIN Modules ON LearningOutcomes.ModuleID = Modules.ModuleID WHERE LearningOutcomes.AssignmentCode = '$assignment'");

		

		while($row = $results->fetch_assoc()){
			echo '<h1>'.$row['AssignmentName'].'</h1>';
			echo '<div class="assignmentInfo">';
				echo '<p class="info"><strong class="infoHeading">Course Code: </strong>'.$row['CourseCode'].'</p>';
				echo '<p class="info"><strong class="infoHeading">Due Date: </strong>'.$row['DueDate'].'</p>';
				echo '<p class="info"><strong class="infoHeading">Level: </strong>'.$row['Level'].'</p>';
				echo '<p class="info"><strong class="infoHeading">Credits: </strong>'.$row['Credits'].'</p>';
				echo '<p class="info"><strong class="infoHeading">Passing Grade: </strong>'.$row['PassingGrade'].'%</p>';
			echo '</div>';
			
			echo '<div class="moduleInfo">';
			echo '<strong class="infoHeading">Learning Outcomes:</strong><br>';
			
			while($row2 = $results2->fetch_assoc()){
				$count = 1;
				echo '<strong class="moduleHeading">'.$row2['ModuleID'].' - '.$row2['ModuleName'].'</strong>';
				$results3 = mysqli_query($connect, "SELECT Description FROM `LearningOutcomes` WHERE AssignmentCode = '$assignment' AND `ModuleID` = '".$row2['ModuleID']."'");
				while($row3 = $results3->fetch_assoc()){
					echo '<p class="info">'.$count.' - '.$row3['Description'].'</p>';
					$count++;
				}
			}
			
			echo '<strong class="moduleHeading">Purpose:</strong><br>';
			$results4 = mysqli_query($connect, "SELECT Purpose FROM `Assignments` WHERE AssignmentCode = '$assignment'");
			
			while($row4 = $results4->fetch_assoc()){
				echo '<p class="info">'.$row4['Purpose'].'</p>';	
			}
			echo '</div>';
			echo '</div>'; //assignment info ends
			
			$results6 = mysqli_query($connect, "SELECT * FROM `Submissions` WHERE Username = '".$_SESSION['Username']."' AND AssignmentCode = '$assignment'");
			echo '<div class="quickLinks">';
			echo '<h3 class="quickLinksTitle">Quick Links</h3>';
			while($row6 = $results6->fetch_assoc()){
				
						if($row6['MarkedRubric'] == NULL){
							
						}else{
							echo '<h4 class="quickLinksHeadings">Results</h4>';
							echo '<a href="'.$row6['MarkedRubric'].'" class="quickLink" download>Marked Rubric</a>';
						}
						
			}
			$results = mysqli_query($connect, "SELECT * FROM `Assignments` WHERE `AssignmentCode` = '$assignment'");
			while($row = $results->fetch_assoc()){
				echo '<h4 class="quickLinksHeadings">Downloads</h4>';
						echo '<a href="'.$row['AssignmentOutline'].'" class="quickLink" download>Assignment Outline</a>';
						echo '<a href="'.$row['MarkingSchedule'].'" class="quickLink" download>Marking Schedule</a>';
			}
			echo '</div>';
			echo '</div>'; //content
			$results6 = mysqli_query($connect, "SELECT * FROM `Submissions` WHERE Username = '".$_SESSION['Username']."' AND AssignmentCode = '$assignment'");
			$num = mysqli_num_rows($results6);
			if($num < 1){
				echo '<a href="submitAssignment.php?id='.$assignment.'" class="submissionSubmit">Submit Assignment</a>';
			}
			
			}
			}
		
				
			
			
			}else {
				if($_SESSION['Type'] == 'Student'){
					$allAssignments = mysqli_query($connect, "SELECT * FROM `Assignments` WHERE CourseCode = '".$_SESSION['Course']."'");
				}else if($_SESSION['Type'] == 'Tutor'){
					$allAssignments = mysqli_query($connect, "SELECT * FROM Assignments WHERE CourseCode IN (SELECT CourseCode FROM `Courses` WHERE TutorID = ".$_SESSION['ID'].")");
				}
				while($row5 = $allAssignments->fetch_assoc()){
					echo '<div class="assignmentList">';
						echo '<h2>'.$row5['AssignmentName'].'</h2>';
						if($_SESSION['Type'] == 'Student'){
							echo '<a href="assignment.php?id='.$row5['AssignmentCode'].'"><span class="assignmentListLinks">Outline</span></a>';
							echo '<a href=""><span class="assignmentListLinks">Grade</span></a>';
						}else if($_SESSION['Type'] == 'Tutor'){
							echo '<a href="assignment.php?id='.$row5['AssignmentCode'].'"><span class="assignmentListLinks">View Submissions</span></a>';
						}
					
					if($_SESSION['Type'] == 'Student'){
						$submissions = mysqli_query($connect, "SELECT * FROM Submissions WHERE Username = '".$_SESSION['Username']."' AND AssignmentCode = '".$row5['AssignmentCode']."'");
					
						if(mysqli_num_rows($submissions) > 0){
							while($row7 = $submissions->fetch_assoc()){
								if($row7['Grade'] != NULL){
									echo '<span>'.$row7['Grade'].'%</span>';
								}else {
									echo '<span>Not Marked</span>';
								}
							}
						}else {
							echo '<span>Not Submitted</span>';	
						}
					}
						
					echo '</div>';
				}
				echo '</div>'; //content
			}


		
		
	?>
</div>

