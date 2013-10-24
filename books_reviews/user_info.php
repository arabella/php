<?php
session_start();
require 'config.php';
require 'functions.php';
$pageTitle = 'User Info';
include 'inc/header.php';

if (isset($_GET['uid'])) {
	$id = (int)(trim($_GET['uid']));

	$valid = isUserIdValid($id, $config);
	if ($valid) {
		$username = getUName($id, $config);
		echo "<h2>Comments posted by $username </h2>";

		try {
			$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
						 	$config['DB_USER'], $config['DB_PASSWORD']);
			$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			$stmt = $connection->prepare('select c_date, c_text, user_id, book_id from comments 
									where comments.user_id = :id order by c_date desc');
			$stmt->bindParam(':id', $id, PDO::PARAM_INT);			
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
	 		$stmt->execute();
	 		$cmnts = $stmt->fetchAll();

	 		if (count($cmnts) != 0) {
				foreach ($cmnts as $c) {
					$bTitle = getBTitle($c['book_id'],$config);
					echo '<p>' .$c['c_text'] . '</p>';
					echo '<p class = "info">on <a href="book.php?book_id=' . $c['book_id'] . '">' . $bTitle .'</a> | ';
					echo 'published on ' . $c['c_date'] . '</p>';
					
					
					echo '<hr>'; 
					} 				
				}

				else echo 'No comments yet. Be the first to add a comment.';
			} 

		catch (PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
			}
	}
	else 
	{
		$_SESSION['messages'] = $messages['InvalidUserId'];
		header("location:index.php");
		exit;
	}
}
include 'inc/footer.php';