<?php
session_start();
include 'functions.php';
include 'config.php';
if (isLogged()) {
	header("Location: messages.php");
}
$pageTitle = 'User Login';
	require 'inc/header.php';
	

if (isset($_POST['loginForm'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];


	$connection = connect('localhost', 'root', 'qwerty', 'msg_board');
	$username = mysqli_real_escape_string($connection, $username);
	$password = mysqli_real_escape_string($connection, $password);
	$query = "SELECT username, password, role from users 
	WHERE username = '$username' AND password = '$password'";


	$results = mysqli_query($connection, $query);

if (mysqli_num_rows($results)) {
	$row = $results -> fetch_assoc();
	$_SESSION['username'] = $username;
	$_SESSION['role'] = $row['role'];
	$_SESSION['messages'] = $messages['loginSuccess'];
    header("Location: messages.php");
    exit();
}
else $_SESSION['messages'] = $messages['loginValid'];
    header("Location: index.php");
    exit();
}

	require 'inc/footer.php';