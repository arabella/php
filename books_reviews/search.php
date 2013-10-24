<?php
session_start();
require 'config.php';
require 'functions.php';
$pageTitle = 'Search Results';
require 'inc/header.php';



if (isset($_POST['search'])) {
	$searching  = $_POST['searching'];
	$find = $_POST['find'];
	$find = htmlspecialchars(trim($find));
	$field = $_POST['field'];
	if ($searching =="yes") 
	 { 
	 echo "<h2>Results for '" .$find. "'</h2>";
	 }
	if ($find == "") 
	 { 
	 echo "<p>You forgot to enter a search term<p>"; 
	 exit; 
 	 } 

 $connection =  mysqli_connect('localhost', 'root', 'qwerty', 'books_reviews') 
				or die('Cannot connect to database.');
 mysqli_set_charset($connection, 'utf8');


 $find = strtoupper($find); 
  
 $find = mysqli_real_escape_string($connection, $find);
 $data = array();

if ($field == 'author_name') {
	$q = "select books.book_id, books.book_title, authors.author_name, authors.author_id
	from books inner join books_authors
	on books.book_id = books_authors.book_id
	inner join authors
	on books_authors.author_id = authors.author_id
	where books_authors.book_id in (
           select books_authors.book_id
           from books_authors inner join authors
           on books_authors.author_id = authors.author_id
           and upper($field) LIKE'%$find%')";
} else {

$q = "select * FROM books as b INNER JOIN 
    							books_authors as ba ON b.book_id=ba.book_id 
    							INNER JOIN authors as a
    							ON a.author_id=ba.author_id
								and upper($field) LIKE'%$find%'";
}

$data = mysqli_query($connection, $q);

$result = [];

	while ($row = mysqli_fetch_assoc($data)) {
		$result[$row['book_id']]['book_title'] = $row['book_title'];
		$result[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
	}

	echo '<table>
			<thead>
			<tr>
			<th>Books</th>
			<th>Authors</th>
			</tr>
			</thead><tbody>';

	foreach ($result as $k => $v) {
		echo '<tr><td><a href="book.php?book_id=' . $k .'">' . $v['book_title'] .'</a></td><td>';

		$ar = [];
		foreach ($v['authors'] as $kk => $vv) {
			$ar[] =  '<a href="author.php?author_id=' . $kk .'">' . $vv .'</a>';
		}
		echo implode(' | ', $ar) . '</td></tr>';
	}
	echo '</tbody></table>';
$anymatches = mysqli_num_rows($data); 
 if ($anymatches == 0) 
 { 
 echo "Sorry, but we can not find an entry to match your query<br><br>"; 
 } 
}

require 'inc/footer.php';
?>