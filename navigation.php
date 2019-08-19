<?php
?>

<div class="navContainer">
	<div class="navProfile">
		<!-- Picture and link to edit profile -->
		<?php
		echo '<img src="'.$_SESSION['ProfilePicture'].'" alt="Profile Photo" title="'.$_SESSION['FirstName'].' '.$_SESSION['Surname'].'">
		<a href="editprofile.php" class="editProfile">EDIT PROFILE</a>';
		?>
	</div>
	<div class="navLinks">
		<?php
		if($_SESSION['Type'] == 'Student'){//STUDENT
		echo'<!-- Links -->
			  <a href="index.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">HOME</span></a>
			  <a href="assignment.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">ASSIGNMENTS</span></a>';
		echo '<a href="portfolio.php?student='.$_SESSION['Username'].'" class="navButton"><i class="iconCourses"></i><span class="navButtonText">MY PORTFOLIO</span></a>';
		echo '<a href="inbox.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">INBOX</span></a>
			  <a href="requests.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">REQUESTS</span></a>';
		}else if($_SESSION['Type'] == 'Tutor'){//TUTOR
		echo'<!-- Links -->
			  <a href="index.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">HOME</span></a>
			  <a href="assignment.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">ASSIGNMENTS</span></a>';
		echo '<a href="portfolio.php?student='.$_SESSION['Username'].'" class="navButton"><i class="iconCourses"></i><span class="navButtonText">MY PORTFOLIO</span></a>';
		echo '<a href="inbox.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">INBOX</span></a>
			  <a href="requests.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">REQUESTS</span></a>';
		}else{
		echo '<a href="index.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">HOME</span></a>';
		echo '<a href="inbox.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">INBOX</span></a>
			  <a href="requests.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">REQUESTS</span></a>';
		echo '<a href="allportfolios.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">PORTFOLIOS</span></a>';
		}
		?>
	</div>
	<div class="navOtherLinks">
		<!-- Other Links (log out etc) -->
		<a href="projects.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">PROJECTS</span></a>
		<a href="students.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">STUDENTS</span></a>
		<a href="logout.php" class="navButton"><i class="iconCourses"></i><span class="navButtonText">LOG OUT</span></a>
	</div>
</div>
