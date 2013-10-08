<?php
session_start();
include 'functions.php';
include 'config.php';
if (isLogged()) {
	header("Location: index.php");
}
$pageTitle = "Register";
require 'inc/header.php';

mb_internal_encoding('UTF-8');
if (isset($_POST['register'])) {
	$newUsername = trim(strtolower(($_POST['username'])));
	$newPassword = trim($_POST['password']);

	$error = false;

	if (mb_strlen($newUsername) < 5) {
		$_SESSION['messages'] = $messages['userNameShort'];
		header("Location:index.php");
		exit();
	      $error = true; 
	}

	if (!preg_match('/^[a-zA-Z\p{Cyrillic}\D\s\-][\S]+$/u', $newUsername)) {
		$_SESSION['messages'] = $messages['userNameValid'];
		header("Location: index.php");
		exit();
	      $error = true; 
	}

	$errors = checkPassword($newPassword);

if (count($errors) > 0) {
        for ($i=0; $i < count($errors); $i++) { 
        	echo '<div class = "error">' . $errors[$i] . '</div>';
        	header("Location: index.php");
        }
    $error = true;  
}

$connection = connect('localhost', 'root', 'qwerty', 'msg_board');
$query = "SELECT username
FROM  `users` 
WHERE username = '". mysqli_real_escape_string($connection, $newUsername ) ."'";

$results = mysqli_query($connection, $query);

if (mysqli_num_rows($results)) {
	$_SESSION['messages'] = $messages['userExist'];
		header("Location: index.php");
		exit();
	$error = true;
}

if (!$error) {
	$query = "INSERT INTO users (`user_id`, `username`, `password`, `role`) VALUES (NULL, '". mysql_real_escape_string( $newUsername ) ."', '". mysql_real_escape_string( $newPassword ) ."', 0)";
	mysqli_query($connection, $query);
	$row = $results -> fetch_assoc();
	$_SESSION['username'] = $newUsername;
	$_SESSION['role'] = $row['role'];
	$_SESSION['messages'] = $messages['regSuccess'];
	header("Location: index.php");
	exit;
}
}
require 'inc/footer.php';
