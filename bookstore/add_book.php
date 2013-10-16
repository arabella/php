<?php
$pageTitle = 'Add Book';
require 'inc/header.php';
require 'config.php';
require 'functions.php';
connect($connection);

if (isset($_POST['add-book'])) {
	$title = htmlspecialchars(trim($_POST['new-book']));

	if (mb_strlen($title) < 3) {
        echo '<div class = "error">Title too short</div>';
    }

    else {

    	 if (empty($_POST['authors-list'])) {

    	 	echo '<div class = "error">Please select at least one author.</div>';
    	 	echo '<a href="add_book.php">Back to form</a>';
    	exit();      	
	} else {
    	$authors = $_POST['authors-list'];
    	foreach ($authors as $val) {
		$authors_list[] = (int) $val;
    	 }

		}

$qInsertBook = "insert into books (book_title) values('" . mysqli_real_escape_string($connection, $title) . "')";
mysqli_query($connection, $qInsertBook);
$bookId = mysqli_insert_id($connection);

$qInsertBA = "insert into books_authors (book_id, author_id) values";
$count = 1;

foreach ($authors_list as $v) {
	if ($count == count($authors_list)) 
	{
		$qInsertBA .= "(". $bookId.", ". mysqli_real_escape_string($connection, $v) .")";
	}
	else
	{
		$qInsertBA .= "(". $bookId.", ". mysqli_real_escape_string($connection, $v) ."),";
	}
	$count++;
}
mysqli_query($connection, $qInsertBA);
echo '<div class = "ok">Book "' . $title . '" added</div>';
}
}
?>


<form method = "POST" action = "">
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

			$query = "select * from authors";
			$result = query($query, $connection); 

			foreach ($result as $row) {
		echo '<option value =  '. $row -> author_id.'>' . $row -> author_name . '</option>';
}
			?>
			</select><br>
		<li><input type = "submit" name = "add-book" value = "Add Book"/></li>
	</ul>
	</form>

</div>
</div>
<?php
require 'inc/footer.php';
?>