<?php
	include('conn.php');
	include('head.php');
	include('navigation.php');
?>

<div class="page">
	<div class="topHeader">
		<img class="topHeaderLogo" src=""><h1>ATC Vision College</h1>
	</div>
	
	<div class="content">
	<?php
		if($_SESSION['message'] != ''){
		echo '<span id="messageBox">'.$_SESSION['message'].'</span>';
			$_SESSION['message'] = '';
		}
		echo '<h2>'.$_SESSION['FirstName'].' ';
		if($_SESSION['MiddleName'] != NULL){echo $_SESSION['MiddleName'].'';}
		echo $_SESSION['Surname'].'</h2>';
		echo '<h3>'.$_SESSION['Course'].'</h3>';


		if($_SESSION['Type'] == 'Student')
		{	
			$student = mysqli_query($connect, "SELECT `Mobile`, `Email`, `About` FROM Student WHERE Username = '".$_SESSION['Username']."'");
			
			while($stud = $student->fetch_assoc()){
				echo '<form id="editStudent">';
				echo '<div class="editInfo"><h3>Mobile:</h3><input type="text" name="mobile" value="'.$stud['Mobile'].'"/>';
				echo '<h3>Email:</h3><input type="text" name="email" value="'.$stud['Email'].'"/>';
				echo '<h3>Update Password:</h3><input type="password" name="uPassword"/>';
				echo '<h3>Current Password:</h3><input type="password" name="cPassword"/></div>';
			
			
			echo '<div class="aboutMe"><h3>About Me:</h3><textarea id="aboutMe" name="about" for="editStudent">'.$stud['About'].'</textarea></div>';
			echo '</form>';
			}
			
			$skills = mysqli_query($connect, "SELECT * FROM Skills WHERE Username = '".$_SESSION['Username']."'");
			
			if(mysqli_num_rows($skills) > 0){
				while($skill = $skills->fetch_assoc()){
					
					
					echo '<form id="editSkills" action="actionSkills.php" method="post">';
					echo '<h3>Select Skills You Are Confident In:</h3>';
					echo '<input type="checkBox" name="skill1" value="t"';
					if($skill['Javascript'] == 't'){echo 'checked';}
					echo '><label for="skill1">Javascript</label>';
					
					echo '<input type="checkBox" name="skill2" value="t"';
					if($skill['CSS3'] == 't'){echo 'checked';}
					echo '><label for="skill1">CSS3</label>';
					
					echo '<input type="checkBox" name="skill3" value="t"';
					if($skill['EssQueEl'] == 't'){echo 'checked';}
					echo '><label for="skill1">SQL</label>';
					
					echo '<input type="checkBox" name="skill4" value="t"';
					if($skill['WebDesign'] == 't'){echo 'checked';}
					echo '><label for="skill1">Web Design</label>';
					
					echo '<input type="checkBox" name="skill5" value="t"';
					if($skill['HTML5'] == 't'){echo 'checked';}
					echo '><label for="skill1">HTML5</label>';
					
					echo '<input type="checkBox" name="skill6" value="t"';
					if($skill['PHP5'] == 't'){echo 'checked';}
					echo '><label for="skill1">PHP5</label>';
					
					echo '<input type="checkBox" name="skill7" value="t"';
					if($skill['Photoshop'] == 't'){echo 'checked';}
					echo '><label for="skill1">Photoshop</label>';
					
					echo '<input type="checkBox" name="skill8" value="t"';
					if($skill['ContentOptimisation'] == 't'){echo 'checked';}
					echo '><label for="skill1">Content Optimisation</label>';
					echo '<input type="submit" value="Submit"/>';
					echo '</form>';
				}
			}else {
				echo '<form id="editSkills">';
				echo '<h3>Select Skills You Are Confident In:</h3>';
				echo '<input type="checkBox" name="skill1" value="t"><label for="skill1">Javascript</label>';
				echo '<input type="checkBox" name="skill2" value="t"><label for="skill2">CSS3</label>';
				echo '<input type="checkBox" name="skill3" value="t"><label for="skill3">SQL</label>';
				echo '<input type="checkBox" name="skill4" value="t"><label for="skill4">Web Design</label>';
				echo '<input type="checkBox" name="skill5" value="t"><label for="skill5">HTML5</label>';
				echo '<input type="checkBox" name="skill6" value="t"><label for="skill6">PHP5</label>';
				echo '<input type="checkBox" name="skill7" value="t"><label for="skill7">Photoshop</label>';
				echo '<input type="checkBox" name="skill8" value="t"><label for="skill8">Content Optimisation</label>';
				echo '</form>';
			}
			
			$workExperience = mysqli_query($connect, "SELECT * FROM WorkExperience WHERE Username = '".$_SESSION['Username']."'");
			
			echo '<form class="editWork" method="post" action="actionAddWork.php">';
			echo '<h3>Company:</h3><input type="text" name="company">';
			echo '<h3>Postion:</h3><input type="text" name="position">';
			echo '<h3>Length of Employment:</h3><input type="number" name="length">';
			echo '<h3>Description:</h3><textarea for="editWork" name="description">Description of job.</textarea>';
			echo '<input type="submit" value="Add"/>';
			echo '</form>';
			
			while($work = $workExperience->fetch_assoc()){
				echo '<form class="editWork" method="post" action="actionUpdateWork.php">';
				echo '<input type="hidden" name="workid" value="'.$work['workID'].'"/>';
				echo '<h3>Company:</h3><input type="text" name="company" value="'.$work['Company'].'">';
				echo '<h3>Postion:</h3><input type="text" name="position" value="'.$work['Position'].'">';
				echo '<h3>Length of Employment:</h3><input type="number" name="length" value="'.$work['Length'].'">';
				echo '<h3>Description:</h3><textarea for="editWork" name="description">'.$work['Description'].'</textarea>';
				echo '<div class="twoButtons"><input style="display:inline-block;" type="submit" value="Update"/>';
				echo '<input style="display:inline-block;" type="submit" value="Delete" formaction="actionDeleteWork.php"/></div>';
				echo '</form>';
			}

		}else if($_SESSION['Type'] == 'Tutor'){
			echo '<form id="editTutor" action="actionUpdateTutor.php">';
				echo '<h3>Update Password:</h3><input type="password" name="uPassword"/>';
				echo '<h3>Current Password:</h3><input type="password" name="cPassword"/></div>';
				echo '<input type="submit" value="Change Password"/>';
			echo '</form>';
		}
	?>
	
	</div><!-- content -->
	
</div><!-- page -->