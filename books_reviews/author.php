<?php
session_start();
require 'config.php';
require 'functions.php';
$pageTitle = 'Author Info';
include 'inc/header.php';

if (isset($_GET['author_id'])) {
	$id = (int)(trim($_GET['author_id']));

	$valid = isAuthorIdValid($id, $config);
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
										where 1 and bba.author_id = :id');	
	 		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
			$stmt->setFetchMode(PDO::FETCH_ASSOC);
	 		$stmt->execute();
	 		//$rows = $stmt->fetchAll();	
	 		$result = [];
	 		while ($row = $stmt->fetch()) {
	 		$result[$row['book_id']]['book_title'] = $row['book_title'];
	 		$result[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
	 		}

	 		echo '<table><thead><tr><th>Books</th><th>Authors</th></tr></thead><tbody>';
			foreach ($result as $k => $v) {
				echo '<tr><td><a href="book.php?book_id=' . $k .'">' . $v['book_title'] .'</a></td><td>';

				$ar = [];
				foreach ($v['authors'] as $kk => $vv) {
					$ar[] =  '<a href="author.php?author_id=' . $kk .'">' . $vv .'</a>';
				}
				echo implode(' | ', $ar) . '</td></tr>';
			}
			echo '</tbody></table>';
		} 

		catch (PDOException $e) {
		 	echo 'ERROR: ' . $e->getMessage();
		}
	}
	else 
	{
		$_SESSION['messages'] = $messages['InvalidAuthorId'];
		header("location:index.php");
		exit;
	}
}

include 'inc/header.php';
