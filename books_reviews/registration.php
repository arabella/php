<?php
session_start();
include 'functions.php';
$pageTitle = 'Register';
include 'inc/header.php';
?>

<div id = "acc" >
<h2>Register New Account</h2>
<form method = "post" action = "register.php">
	<ul>
		<li>
			<label for = "username" name = "username">Username:</label>
			<input type = "text" name = "username" required placeholder = "username"/>
		</li>
		<li>
			<label for = "password" name = "password">Password: </label>
			<input type = "password" name = "password" required placeholder = "password" />
		</li>
		<li>
			<input type = "submit" name = "registration" value = "Register" />
		</li>
		or
		<li><a href="login.php">Log in</a></li>
	</ul>
</form>
</div>

<?php
include 'inc/footer.php';