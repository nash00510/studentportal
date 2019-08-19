<?php
	include('conn.php');
	include('head.php');
	include('navigation.php');
	
	$student = $_GET['student'];

	$selectStudentInfo = "SELECT * FROM Student INNER JOIN Skills ON Student.Username = Skills.Username INNER JOIN Courses ON Student.CourseCode = Courses.CourseCode INNER JOIN Users ON Student.Username = Users.Username WHERE Student.Username = '".$student."'";

	$result = mysqli_query($connect, "SELECT StudentID FROM Student WHERE Username = '$student'");
	$value = $result->fetch_row();
	$sID = $value[0];
	
	if($_SESSION['Type'] == 'Community'){
		$result = mysqli_query($connect, "SELECT CommunityID FROM Community WHERE Username = '".$_SESSION['Username']."'");
		$value = $result->fetch_row();
		$cID = $value[0];
	}
?>

<div class="page">
	<div class="topHeader">
		<img class="topHeaderLogo" src=""><h1>ATC Vision College</h1>
	</div>
	<?php
	$results = mysqli_query($connect, $selectStudentInfo);
	if(mysqli_num_rows($results) < 1){echo 'NO STUDENT FOUND';}
	while($row = $results->fetch_assoc()){
echo '<div class="portBanner" style="background: url('.$row['Banner'].');background-size: cover;background-position: bottom;">
		<img src="'.$row['ProfilePicture'].'" class="portBannerImg">
	</div>
	
	<div class="content">
		
		<div class="portStudentInfo">
			<div class="studentInfo">
			<h2 class="portName">'.$row['FirstName'].' '; if(isset($row['MiddleName'])){echo $row['MiddleName'].' ';}
	echo  $row['Surname'].'</h2>
			<h3 class="portHeading">'.$row['CourseName'].' (Level '.$row['Level'].')</h3>';
			if(isset($row['Completed'])){echo '<p>Completed: '.$row['Completed'].'</p>';}
		echo '</div>
			<form class="portRequest" method="post">
				<input type="hidden" name="student" value="'.$row['Username'].'"/>
				<!-- if username = username of bio, disable buttons -->';
			$email = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM Requests WHERE StudentID = '$sID' AND CommunityID = '$cID' AND Email = 'R'"));
			$mobile = mysqli_num_rows(mysqli_query($connect, "SELECT * FROM Requests WHERE StudentID = '$sID' AND CommunityID = '$cID' AND Mobile = 'R'"));
		
			$emailSet = mysqli_fetch_row(mysqli_query($connect, "SELECT Email FROM Student WHERE StudentID = '$sID'"));
			$mobileSet = mysqli_fetch_row(mysqli_query($connect, "SELECT Mobile FROM Student WHERE StudentID = '$sID'"));
		
			if($_SESSION['Type'] == 'Community'){
				if($email < 1 && $emailSet[0] != NULL){
					echo '<input type="submit" formaction="actionRequest.php?req=email" name="rEmail" value="Request Email"/>';
				}
				if($mobile < 1 && $mobileSet[0] != NULL){
					echo '<input type="submit" formaction="actionRequest.php?req=mobile" name="rMobile" value="Request Mobile"/>';
				}
			}
		echo '</form>
		</div>
		
		<div class="portAbout">
			<h3 class="portHeading">About Me</h3>
			<span class="aboutMe">'.$row['About'].'</span>
		</div>
		
		<div class="portSkills">
			<h3 class="portHeading">Skills</h3>
			<div class="portSkillsWrapper">
				<div class="skillHolder"><div class="circle '.$row['Javascript'].'"></div><span>Javascript</span></div><!--
				--><div class="skillHolder"><div class="circle '.$row['CSS3'].'"></div><span>CSS3</span></div><!--
				--><div class="skillHolder"><div class="circle '.$row['EssQueEl'].'"></div><span>SQL</span></div><!--
				--><div class="skillHolder"><div class="circle '.$row['WebDesign'].'"></div><span>Web Design</span></div><!--
				--><div class="skillHolder"><div class="circle '.$row['HTML5'].'"></div><span>HTML5</span></div><!--
				--><div class="skillHolder"><div class="circle '.$row['PHP5'].'"></div><span>PHP5</span></div><!--
				--><div class="skillHolder"><div class="circle '.$row['Photoshop'].'"></div><span>Photoshop</span></div><!--
				--><div class="skillHolder"><div class="circle '.$row['ContentOptimisation'].'"></div><span>Content Optimisation</span></div>
			</div>
		</div>
		
		<div class="portProjects">
			<a href="#"><div class="projectThumb"></div></a><!--
			--><a href="#"><div class="projectThumb"></div></a><!--
			--><a href="#"><div class="projectThumb"></div></a><!--
			--><a href="#"><div class="projectThumb"></div></a>
		</div>';
		
  echo '<div class="portWork">
		<div class="acceptingWork">Accepting Work</div><h3 class="portHeading">Work Experience</h3>';
		$results2 = mysqli_query($connect, "SELECT * FROM WorkExperience WHERE Username = '".$student."'");
		while($row2 = $results2->fetch_assoc()){
			
			$years = floor($row2['Length']/12);
			$months = $row2['Length'] - ($years*12);
			
	  echo '<div class="portExperience">
				<h4>'.$row2['Company'].'</h4><span>'.$row2['Position'].' '.$years.'yr '.$months.'mo</span><br/>
				<span>'.$row2['Description'].'</span>
			</div>';
		}
		echo '</div>';
	}
		?>
	</div><!-- end content -->
	
</div><!-- end page -->