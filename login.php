<?php
	include('head.php');
?>

<div class="landingBanner">
	<div class="logoContainer floatLeft">
		<img src="images/logo.png" alt="Vision College Logo" title="ATC Vision College">
	</div><!--
	
 --><div class="titleContainer">
		<h1 class="landingTitle">STUDENT PORTAL</h1>
	</div>
</div>

<div class="pageContainer">
	<div class="loginContainer floatLeft">
		<div class="bgLight">
			<h1 class="landingHeader">Login</h1>
		</div>
		<!-- Login Form-->
		<div class="bgDark">
			<form id="login" action="actionLogin.php" method="post">
				<input type="text" name="lUsername" placeholder="Username">
				<input type="password" name="lPassword" placeholder="Password">
				<button class="submitButton" type="submit">LOGIN</button>
			</form>
		</div>
	</div><!--

	--><div class="registerContainer floatRight">
		<div class="bgLight">
			<h1 class="landingHeader">Register</h1>
		</div>
	<!-- Register Form -->
		<div class="bgDark">
			<form id="register" action="actionRegister.php" method="post">
				<input type="text" name="fName" placeholder="First Name">
				<input type="text" name="lName" placeholder="Surname">
				<input type="text" name="company" placeholder="Company">
				<input type="text" name="username" placeholder="Username">
				<input type="password" name="password" placeholder="Password">
				<input type="password" name="confirmPassword" placeholder="Confirm Password">
				<input type="email" name="email" placeholder="Email">
				<button class="submitButton" type="submit">REGISTER</button>
			</form>
		</div>
	</div>
</div>
<?php
	include('foot.php');
?>