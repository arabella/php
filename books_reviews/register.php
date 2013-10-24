<?php
session_start();
require 'config.php';
require 'functions.php';
$pageTitle = 'Register';
include 'inc/header.php';

if (isLogged()) {
	header("Location: index.php");
}

if (isset($_POST['registration'])) {
	$newUsername = htmlspecialchars(trim(strtolower($_POST['username'])));
	$newPassword = htmlspecialchars(trim($_POST['password']));

	$error = false;

	if (mb_strlen($newUsername) < 3 || mb_strlen($newUsername) > 30) {
		$_SESSION['messages'] = $messages['Invalid_UN_length'];
		$error = true;
		header("location:registration.php");
		exit();
	}

	if (!ctype_alnum(str_replace('_', '', $newUsername))) {
		$error = true;
		$_SESSION['messages'] = $messages['Invalid_UN_Char'];
		header("Location: registration.php");
		exit();
	}

	if (mb_strlen($newPassword) < 5) {
		$error = true;
        $_SESSION['messages'] = $messages['ShortPass'];
        header("Location: registration.php");
		exit();
    }

    if (!preg_match("#[0-9]+#", $newPassword)) {
    	$error = true;
        $_SESSION['messages'] = $messages['NoNumberPass'];
        header("Location: registration.php");
		exit();
    }

    if (!preg_match('/^[a-zA-Z\p{Cyrillic}\D\s\-][\S]+$/u', $newPassword)) {
    	$error = true;
        $_SESSION['messages'] = $messages['NoLetterPass'];
        header("Location: registration.php");
		exit();
    } 

	 if (!$error) {
	 	$user = isExistingUser($newUsername, $config);

	 	if (!$user) {
	 		try {
	 		$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
	 		$config['DB_USER'], $config['DB_PASSWORD']);
	 		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 		$stmt = $connection->prepare('insert into users(username, password) 
	 			values(:username, :password)');

	 		$stmt->bindParam(':username', $newUsername, PDO::PARAM_STR);
	 		$stmt->bindParam(':password', $newPassword, PDO::PARAM_STR);
	 		
	 		$stmt->execute();
	 		$_SESSION['messages'] = $messages['RegSuccess'];
			$_SESSION['username'] = $newUsername;
			header("location:index.php");
			exit();
	 	} 

		 	catch (PDOException $e) {
		 		echo 'ERROR: ' . $e->getMessage();
		 	}
	 	} 
	 	else
	 	{
	 		$_SESSION['messages'] = $messages['ExistingUser'];
	 		header("location:registration.php");
	 		exit();
	 	}
	 }
}
?>