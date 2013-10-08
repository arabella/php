<?php
session_start();
include 'functions.php';
if (isLogged()) {
	header("Location: index.php");
}
$pageTitle = "Registration form";
require 'inc/header.php';
?>

<form method = "post" action = "register.php">
	<ul>
		<li>
			<input type = "text"  name = "username" placeholder = "username" required = "required" />
		</li>
		<li>
			<input type = "password"  name = "password" placeholder = "password" required = "required" />
		</li>
		<li>
			<input type = "submit" name = "register" value = "Register" />
		</li>		
	</ul>
	
</form>
</div>

<?php
require 'inc/footer.php';