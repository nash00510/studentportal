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
		$project = mysqli_query($connect, "SELECT * FROM Projects");
		while($proj = $project->fetch_assoc()){
		$contrib = mysqli_query($connect, "SELECT * FROM ProjectContributors INNER JOIN Student ON ProjectContributors.StudentID = Student.StudentID WHERE ProjectID = ".$proj['ProjectID']);
		echo '<div class="projectBox">
			<div class="projectImg">
				<img src="'.$proj['Thumbnail'].'"/>
			</div>
			
			<div class="projectTitle">
				<h3>'.$proj['ProjectTitle'].'</h3>';
				while($con = $contrib->fetch_assoc()){
				echo '<a href="portfolio.php?student='.$con['Username'].'">'.$con['FirstName'].' '.$con['Surname'].'</a>';
				}
			echo '</div>
			
			<div class="projectLinks">
				<a href="'.$proj['LiveURL'].'">Live Site</a>
			</div>
		</div>';
		}
		?>
		
	</div><!--content-->
	
</div><!--page-->