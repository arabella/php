<?php
session_start();
include 'functions.php';
include 'config.php';
if (isLogged()) {
	header("Location: messages.php");
}

$pageTitle = "User Login";
require 'inc/header.php';


?>

<h1></h1>

<form action="login.php" method = "post" >
	<ul>
	<li>
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
 <a href="registration.php">Register</a>
</div>

<?php

require 'inc/footer.php'; ?>