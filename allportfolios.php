<?php
	include('conn.php');
	include('head.php');
	include('checkLoggedIn.php');
	include('navigation.php');

	$studentInfo = mysqli_query($connect, "SELECT * FROM Student INNER JOIN Users ON Student.Username = Users.Username");
?>

<div class="page">
	<div class="topHeader">
		<img class="topHeaderLogo" src=""><h1>ATC Vision College</h1>
	</div>

	<div class="content">
		<?php
		while($stud = $studentInfo->fetch_assoc()){
			echo '<div class="studentList">';
			echo 	'<h3>'.$stud['FirstName'].' '.$stud['Surname'].'</h3>';
			echo 	'<img src="'.$stud['ProfilePicture'].'"/>';
			echo	'<a href="portfolio.php?student='.$stud['Username'].'">View Portfolio</a>';
			echo '</div>';
		}
		?>
	</div><!--content-->
	
</div><!--page-->