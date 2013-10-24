<?php
session_start();
require 'config.php';
require 'functions.php';
$pageTitle = 'Book Info';
include 'inc/header.php';

if (isset($_GET['book_id'])) {
	$id = (int)(trim($_GET['book_id']));

	$valid = isBookIdValid($id, $config);
	//var_dump($valid);
	if ($valid) {
		try {
			$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
	 		$config['DB_USER'], $config['DB_PASSWORD']);
	 		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 		$stmt = $connection->prepare('select b.book_id, a.author_id, b.book_title, a.author_name
							 			from authors as a
							 			left join books_authors ba 
							 			on ba.author_id = a.author_id
							 			left join books b 
							 			on b.book_id = ba.book_id
							 			left join books_authors bba 
							 			on bba.book_id = b.book_id
										where 1 and bba.book_id = :id');	
	 		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
	 		$stmt->execute();
	 		//$rows = $stmt->fetchAll();	
	 		$result = [];
	 		while ($row = $stmt->fetch()) {
	 		$result[$row['book_id']]['book_title'] = $row['book_title'];
	 		$result[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
	 		}

	 		$cmnts = getComments($id, $config);
	 		
			foreach ($result as $k => $v) {
				echo '<div class = "bookinfo"><h3>Reviews for ';
				echo '<a href="book.php?book_id=' . $k .'">' . strtoupper($v['book_title']) .'</a> by ';

				$ar = [];
				foreach ($v['authors'] as $kk => $vv) {
					$ar[] =  '<a href="author.php?author_id=' . $kk .'"><i>' . $vv .'</i></a>';
				}
				echo implode(' | ', $ar) . '</h3></div>';
			}

			if (count($cmnts) != 0) {
				foreach ($cmnts as $c) {
					$uid = $c['user_id'];
					$user = getUName($uid, $config);
					echo '<p>' . $c['c_text'] . '</p>';
					echo '<p class = "info">published on ' .$c['c_date'] .' by 
					<a href="user_info.php?uid=' . $uid . '"> ' .$user .'</a></p>';					
					echo '<hr>';
				} 				
			} else echo '<p>No comments yet. Be the first to add a comment.</p>';
			

			if (isLogged()) {
				echo '<h3>Add Comment</h3>
					<form method = "post" action = "book.php?book_id=' .$id. '">
						<ul>
						<li>
					<textarea name = "body" placeholder = "Enter your comment ..." rows="4" cols="50" 
					required = "required"></textarea><br>
					</li><li>
					<input type ="submit" name = "add-cmnt" value = "Submit Comment"/></li>
					</ul>
					</form>';

					if (isset($_POST['add-cmnt'])) {
						$cmntText = htmlspecialchars(trim($_POST['body']));

						$cmntDate = date('Y-m-d H:i:s');
						$bookId = $id;

						$user = $_SESSION['username'];
						$userId = getUserId($user, $config);

						try {
							$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
						 	$config['DB_USER'], $config['DB_PASSWORD']);
						 	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

						 	$stmt = $connection->prepare('insert into comments(c_date, c_text, user_id, book_id)
						 								values(:date, :text, :uid, :bid)');
						 	$stmt->bindParam(':date', $cmntDate, PDO::PARAM_STR);
						 	$stmt->bindParam(':text', $cmntText, PDO::PARAM_STR);
						 	$stmt->bindParam(':uid', $userId, PDO::PARAM_STR);
						 	$stmt->bindParam(':bid', $bookId, PDO::PARAM_INT);
						 	$stmt->setFetchMode(PDO::FETCH_ASSOC);
						 	$stmt->execute();
						 	header("refresh:1");
						} 

						catch (PDOException $e) {
							echo 'ERROR: ' . $e->getMessage();
						}

					} 
			} else echo '<p><a href="login.php">Login</a> to post a comment.</p>';
		} 

		catch (PDOException $e) {
		 	echo 'ERROR: ' . $e->getMessage();
		}
	}
	else 
	{
		$_SESSION['messages'] = $messages['InvalidBookId'];
		header("location:index.php");
		exit;
	}
}

include 'inc/footer.php';
