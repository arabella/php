<?php
session_start();
require 'config.php';
require 'functions.php';
$pageTitle = 'Login';
include 'inc/header.php';

if (isset($_POST['login'])) {
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

try {
	$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
		$config['DB_USER'], $config['DB_PASSWORD']);

	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$stmt = $connection->prepare('select username, password from users 
		where username = :username and password = :password');

	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	$stmt->bindParam(':password', $password, PDO::PARAM_STR);

	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	$stmt->execute();

	$rows = $stmt->fetchAll();

	if (count($rows)) {
		$_SESSION['messages'] = $messages['LoginSuccess'];
		$_SESSION['username'] = $username;
		header("location:index.php");
		exit();
	}
	else $_SESSION['messages'] = $messages['LoginFail'];
	header("location:login.php");
	exit();
	
} catch (PDOException $e) {
	echo 'ERROR: '.$e -> getMessage();
}
} 
?>



