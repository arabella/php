<?php
session_start();
require 'config.php';
require 'functions.php';
$pageTitle = 'Add Author';
include 'inc/header.php';
mb_internal_encoding('UTF-8');
echo $config['DB_USER'];
echo $config['DB_PASSWORD'];
if (isset($_POST['add-author'])) {
	$authorName = htmlspecialchars(trim(strtolower($_POST['author-name'])));

	if (mb_strlen($authorName) < 3 || mb_strlen($authorName) > 150) {
		$_SESSION['messages'] = $messages['AN_Length'];
	}

	$author = isExistingAuthor($authorName);
	// var_dump($author);


	if (!$author) {
		try {
	 		$connection = new PDO('mysql:host=localhost;dbname=books_reviews;charset=utf8', 
	 		$config['DB_USER'], $config['DB_PASSWORD']);
	 		$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	 		$stmt = $connection->prepare('insert into authors(author_name) 
	 			values(:authorname)');

	 		$stmt->bindParam(':authorname', $authorName, PDO::PARAM_STR);
	 		
	 		$stmt->execute();
	 		$_SESSION['messages'] = $messages['AuthorAddSuccess'];
			header("location:add_author.php");
			exit();
	 	} 

		 	catch (PDOException $e) {
		 		echo 'ERROR: ' . $e->getMessage();
		 	}
	 	} 
	 	else
	 	{
	 		$_SESSION['messages'] = $messages['ExistingAuthor'];
	 		header("location:add_author.php");
	 		exit();
	 	}
}

?>

<form method = "post" action = "add_author.php">
	<div id = "add-author">
		<ul>
		<li>
			<label for = "author-name">Add Author: </label>
		</li>
		<li>
			<input type = "text" name = "author-name" required />
		</li>
		<li>
			<input type = "submit" name = "add-author" value = "Add Author" />
		</li>
		</ul>		
	</div>	
</form>

<table>
<thead>
<tr>
<th>Authors</th>
</tr>
</thead><tbody>
<?php
$authors_list = getAuthors();
if (!empty($authors_list)) {
	foreach ($authors_list as $v) {
	 	echo '<tr><td><a href = "author.php?author_id=' . 
	 	$v['author_id'] . '"> ' . $v['author_name'] .'</a></td></tr>';
	}
}
else echo '<div class = "error">No authors to display. Go on and add some.</div>';
	
?>
</tbody></table>
<?php
include 'inc/footer.php';