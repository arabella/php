<?php
$pageTitle = 'Search Results';
require 'inc/header.php';
require 'functions.php';
require 'config.php';

if (isset($_POST['search'])) {
	$searching  = $_POST['searching'];
	$find = $_POST['find'];
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

 connect($connection);

 $find = strtoupper($find); 
 $find = htmlspecialchars(trim($find)); 
 $find = mysqli_real_escape_string($connection, $find);
 $data = array();

if ($field == 'author_name') {
	$q = "select books.book_id, books.book_title, authors.author_name
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

$q = "select b.book_title, b.book_id, a.author_name from  books as b, authors as a
join books_authors as ba
where a.author_id = ba.author_id
and b.book_id = ba.book_id
and upper($field) LIKE'%$find%'";
}

 $data = mysqli_query($connection, $q);

$result = array();
 while ($row = mysqli_fetch_assoc($data)) {
	$result[$row['book_id']]['book_title'] = $row['book_title'];
	$result[$row['book_id']]['authors'][] = $row['author_name'];
}

echo '<table>
<thead>
<tr>
<th>Books</th>
<th>Authors</th>
</tr>
</thead><tbody>';


foreach ($result as $v) {
	echo '<tr><td>' . $v['book_title'] . '</td><td>';
	$count = 1;
	foreach ($v['authors'] as $vv) {
		if ($count == count($v['authors'])) {
			echo  '<a href="books.php?author='.urlencode($vv).'">'.$vv .'</a>  ';
		}
		else {
			echo  '<a href="books.php?author='.urlencode($vv).'">'.$vv .'</a> | ';
		}
		$count++;
	}
	echo '</td></tr>';
}
echo '</tbody></table>';
  $anymatches=mysqli_num_rows($data); 
 if ($anymatches == 0) 
 { 
 echo "Sorry, but we can not find an entry to match your query<br><br>"; 
 } 
}


?>