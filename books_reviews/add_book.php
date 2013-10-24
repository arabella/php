<?php
session_start();
require 'config.php';
require 'functions.php';
$pageTitle = 'Add Book';
include 'inc/header.php';


if (isset($_POST['add-book'])) {
	$title = htmlspecialchars(trim($_POST['new-book']));
	if (!empty($_POST['authors-list'])) {
		$authors = $_POST['authors-list'];
	}

	$error = false;
	if (empty($authors)) {
		echo '<div class="error">No Author Selected</div>';
		$error = true;
	} 
	else {
		foreach ($authors as $v) {
		$valid = isAuthorIdValid($v, $config);
		if (!$valid) {
			echo '<div class="error">No such author</div>';
			$error = true;
		}
	}
	}
	if ((mb_strlen($title) < 3) || (mb_strlen($title) > 150)) {
		echo '<div class="error">Title should be between 3 and 150 characters long</div>';
		$error = true;
	}
	

	if (!$error) {
		try {
			$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
	 					$config['DB_USER'], $config['DB_PASSWORD']);
		 	$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		 	$stmt = $connection->prepare('insert into books(book_title) values(:title)');
		 	$stmt->bindParam(':title', $title, PDO::PARAM_STR);
		 	$stmt->execute();

		 	$bookId = $connection->lastInsertId(); 
		 	$stmt = $connection->prepare('insert into books_authors(book_id, author_id) values(:book_id, :author_id)');
		 	$stmt->bindParam(':book_id', $bookId, PDO::PARAM_STR);

		 	foreach ($authors as $v) {
		 		$stmt->bindParam(':author_id', $v, PDO::PARAM_INT);
		 		$stmt->execute();
		 	}

		 	echo '<div class="ok">Book ' . $title . ' added.</div>';
			
		} catch (PDOException $e) {
			echo 'ERROR: ' . $e->getMessage();
		}		
	}
}
?>


<h2>Add New Book</h2>
<form method = "post" action = "add_book.php">
	<div id = "add-author">
	<ul>
		<li><label for = "new-book">Add Book Title</label></li>
		<li><input type = "text" name = "new-book"/></li>
	</ul>
	</div>

<div id = "add-author">
<ul>
		<li><label for = "authors-list[]">Add Book Author</label></li>
			<select name = "authors-list[]" multiple >

			<?php
			$result = getAuthors($config); 
			foreach ($result as $v) {
				echo '<option value ='. $v['author_id'] .'>' . $v['author_name'] . '</option>';
			}
			?>

			</select><br>
		<li><input type = "submit" name = "add-book" value = "Add Book"/></li>
	</ul>
	</form>

</div>
</div>
<?php
include 'inc/footer.php';
?>
