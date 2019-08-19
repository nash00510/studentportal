<?php
	include('conn.php');
	include('head.php');
	include('checkLoggedIn.php');
	include('navigation.php');

	$assignment = $_GET['id'];
?>

<div class="page">
	<div class="topHeader">
		<img class="topHeaderLogo" src=""><h1>ATC Vision College</h1>
	</div>
	
	<div class="content">
		<form id="assignmentSubmission" action="actionSubmission.php" method="post" enctype="multipart/form-data">
			<?php
			if(isset($_SESSION['uploadMessage'])){
			echo '<span>'.$_SESSION['uploadMessage'].'</span>';
			unset($_SESSION['uploadMessage']);
			}
			echo '<input name="assignment" type="hidden" value="'.$assignment.'"/>';
			?>
			<div class="assignmentSubmissionInput"><input type="file" title="Upload Assignment" name="file" id="file"></div>
			<div class="assignmentSubmissionNotes"><textarea name="submissionNotes" for="assignmentSubmission">Additional Information</textarea></div>
			<input type="submit" value="Submit">
		</form>
	</div>
	
</div>