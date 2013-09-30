<?php 

session_start();

	$pageTitle = 'User Login';
	require 'inc/header.php';
	include 'functions.php';

	if (isLogged()) {
	header("Location: admin.php");
}

?>

<h1>User File Upload System</h1>
<div class = "main">
<form action="login.php" method = "post" >
	<ul>
		<li>
	<input type="hidden" name="login" value="loggin" />
</li><li>
	<label for = "username">Username</label>
	<input type = "text" name = "username" id = "username" placeholder = "username" required = "required"/>
</li><li>
	<label for = "password">Password</label>
	<input type = "password" name = "password" id ="password" placeholder = "password" required = "required"/>
</li><li>
	<input type = "submit" name = "loginForm" value = "Login"/>
</li><li>or</li>
	</ul>
</form>
 <a href="/user-files-upload/register.php"><button type = "button">Register</button></a>
</div>
<?php
include 'inc/footer.php';
?>