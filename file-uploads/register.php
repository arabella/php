<?php 
session_start();

	$pageTitle = 'Register';
	require 'inc/header.php';
	include 'functions.php';

?>
<h1>User File Upload System</h1>
<?php

if (isset($_POST['regForm'])) {
	$newUsername = $_POST['username'];
	$newPassword = $_POST['password'];

	$error = false;
if(!preg_match('/^[A-Za-z][A-Za-z0-9]{3,19}$/', $newUsername)){
	echo '<div class = "error">Username must be at least 4 characters and can contain only letters and numbers.</div>';
	      $error = true;  
}

$errors = checkPassword($newPassword);
if (count($errors) > 0) {
        for ($i=0; $i < count($errors); $i++) { 
        	echo '<div class = "error">' . $errors[$i] . '</div>';
        }
    $error = true;  
}

if (checkExistingUser($newUsername)) {
	echo '<div class = "error">User already exists.</div>';
	      $error = true; 
}

if (!$error) {
	$newUser = $newUsername .'|'. $newPassword . "\n";
	$fileName = 'users.txt';
	if (file_put_contents('users.txt', $newUser, FILE_APPEND)) {
			echo '<div class="ok">Succesfully registered</div>';
			$_SESSION['username'] = $newUsername;
				header("refresh:2;url=admin.php");
		}
	$folderName = $newUsername . '-uploads';
	if (mkdir("files/$folderName" , 0777))
		echo '<div class="ok">Folder ' . $folderName . ' created</div>';
	else
			echo '<div class = "error">Failed to create folder</div>';
	}
}

?>
<div class = "main">
<form action="register.php" method = "post" >
	<ul>
	<li>
	<label for = "username">Username</label>
	<input type = "text" name = "username" id = "username" placeholder = "username" required = "required"/>
</li><li>
	<label for = "password">Password</label>
	<input type = "password" name = "password" id ="password" placeholder = "password" required = "required"/>
</li><li>
	<input type = "submit" name = "regForm" value = "Register"/>
</li>
	</ul>
</form>
</div>



<?php
	include 'inc/footer.php';
?>