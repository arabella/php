<?php
session_start();
require 'functions.php';
$pageTitle = 'Login';
include 'inc/header.php';

if (isLogged()) {
	header("Location: index.php");
}
?>

<div id = "acc"> 
<h2>Login</h2>
<form action = "log.php" method = "post" >
	<ul>
		<li>
			<label for = "username">Username</label>
			<input type = "text" name = "username" required placeholder = "username"/>
		</li>
		<li>
			<label for = "password" name = "password">Password</label>
			<input type = "password" name = "password" required placeholder = "password" />
		</li>
		<li>
			<input type = "submit" name = "login" value = "Login"/>
		</li>
		or
		<li><a href="registration.php">Register</a></li>
	</ul>
</form>
</div>

<?php
include 'inc/footer.php';