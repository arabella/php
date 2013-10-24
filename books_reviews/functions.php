<?php
require 'config.php';
function isLogged() {
    return isset($_SESSION['username']);
}

function isExistingUser($username,$config)
{
	try {
	 	$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
	 	$config['DB_USER'], $config['DB_PASSWORD']);
	 	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 	$stmt = $connection->prepare('select username from users 
	 		where username = :username');
	 	$stmt->bindParam(':username', $username, PDO::PARAM_STR);
	 	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	 	$stmt->execute();
	 	$rows = $stmt->fetchAll();

	 	if (count($rows) == 1) {
	 		return true;
	 		} else return false;

	} 

	catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

}

function isExistingAuthor($authorName,$config)
{
	try {
	 	$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
	 	$config['DB_USER'], $config['DB_PASSWORD']);
	 	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 	$stmt = $connection->prepare('select author_name from authors 
	 		where author_name = :authorname');
	 	$stmt->bindParam(':authorname', $authorName, PDO::PARAM_STR);
	 	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	 	$stmt->execute();
	 	$rows = $stmt->fetchAll();

	 	if (count($rows) != 0) {
	 			return true;
	 		} 
	 		else 
	 		{
	 			return false;
	 		}
	 	}
	 	catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

} 

function getAuthors($config) 
{
	try {
		$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
	 	$config['DB_USER'], $config['DB_PASSWORD']);
	 	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 	$stmt = $connection->prepare('select * from authors');
	 	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	 	$stmt->execute();
	 	$rows = $stmt->fetchAll();
	 	return $rows;
	}

	catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

}


function isAuthorIdValid($id, $config) {
	try {
		$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
	 	$config['DB_USER'], $config['DB_PASSWORD']);
	 	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 	$stmt = $connection->prepare('select author_id from authors where author_id = :id');
	 	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	 	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	 	$stmt->execute();
	 	$rows = $stmt->fetchAll();
	 	//return $rows;
	 	if (count($rows) != 0) {
	 			return true;
	 		} 
	 		else 
	 		{
	 			return false;
	 		}
	} 

	catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
}

function isBookIdValid($id, $config) {
	try {
		$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
	 	$config['DB_USER'], $config['DB_PASSWORD']);
	 	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 	$stmt = $connection->prepare('select book_id from books where book_id = :id');
	 	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	 	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	 	$stmt->execute();
	 	$rows = $stmt->fetchAll();
	 	//return $rows;
	 	if (count($rows) != 0) {
	 			return true;
	 		} 
	 		else 
	 		{
	 			return false;
	 		}
	} 

	catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
}

function getUserId($user, $config) {
	try {
		$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
	 	$config['DB_USER'], $config['DB_PASSWORD']);
	 	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 	$stmt = $connection->prepare('select * from users where username = :user');
	 	$stmt->bindParam(':user', $user, PDO::PARAM_STR);
	 	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	 	$stmt->execute();
	 	$rows = $stmt->fetchAll();
	 	//return $rows;
	 	$user = $rows[0];
	 	$userId = $user['user_id'];
	 	return $userId;
	} 

	catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

}

function getUName($uid, $config) {
	try {
		$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
	 	$config['DB_USER'], $config['DB_PASSWORD']);
	 	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 	$stmt = $connection->prepare('select * from users where user_id = :uid');
	 	$stmt->bindParam(':uid', $uid, PDO::PARAM_STR);
	 	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	 	$stmt->execute();
	 	$rows = $stmt->fetchAll();
	 	//return $rows;
	 	$user = $rows[0];
	 	$username = $user['username'];
	 	return $username;
	} 

	catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

}

function isUserIdValid($id, $config) {
	try {
		$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
	 	$config['DB_USER'], $config['DB_PASSWORD']);
	 	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 	$stmt = $connection->prepare('select user_id from users where user_id = :id');
	 	$stmt->bindParam(':id', $id, PDO::PARAM_INT);
	 	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	 	$stmt->execute();
	 	$rows = $stmt->fetchAll();
	 	if (count($rows) != 0) {
	 			return true;
	 		} 
	 		else 
	 		{
	 			return false;
	 		}
	} 

	catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}
}

function getBTitle($bid, $config) {
	try {
		$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
	 	$config['DB_USER'], $config['DB_PASSWORD']);
	 	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 	$stmt = $connection->prepare('select * from books where book_id = :bid');
	 	$stmt->bindParam(':bid', $bid, PDO::PARAM_STR);
	 	$stmt->setFetchMode(PDO::FETCH_ASSOC);
	 	$stmt->execute();
	 	$rows = $stmt->fetchAll();
	 	$book = $rows[0];
	 	$bTitle = $book['book_title'];
	 	return $bTitle;
	} 

	catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
	}

}

function getComments($bid, $config) {
	try {
		$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
						 	$config['DB_USER'], $config['DB_PASSWORD']);
		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		$stmt = $connection->prepare('select * from comments 
									where comments.book_id = :bid
									order by c_date desc');
		$stmt->bindParam(':bid', $bid, PDO::PARAM_INT);			
		$stmt->setFetchMode(PDO::FETCH_ASSOC);
	 	$stmt->execute();
	 	$cmnts = $stmt->fetchAll();
	 	return $cmnts;
		} 

	catch (PDOException $e) {
		echo 'ERROR: ' . $e->getMessage();
		}
}