<?php
session_start();
	$pageTitle = 'User Login';
	require 'inc/header.php';
	include 'functions.php';

if (isLogged()) {
	header("Location: admin.php");
}

if (isset($_POST['loginForm'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	$fileName = 'users.txt';
	if (file_exists($fileName)) {
		$data = file($fileName);
		$validUser = false;
		foreach ($data as $user) {
			$userCreds = explode('|', $user);

			if (trim($userCreds[0]) == trim($username) && trim($userCreds[1]) == trim($password)) {
					$_SESSION['username'] = $username;
					$validUser = true;	
					echo '<div class = "ok">Login Successful</div>';
					header("refresh: 2; url = admin.php");
			} 
		 } 
		 if (!$validUser) {
		 echo '<div class = "error">Wrong username/password</div>';
		 header("refresh: 2; url = index.php");
		 }
		 
		 
	}
}
require 'inc/footer.php';
?>