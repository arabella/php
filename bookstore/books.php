<?php
$pageTitle = 'Books';
require 'inc/header.php';
require 'config.php';
require 'functions.php';

if (isset($_GET['author'])) {
$author = trim(urldecode($_GET['author']));
connect($connection);
$query = mysqli_query($connection, 
	'select books.book_id, books.book_title, authors.author_name
	from books inner join books_authors
	on books.book_id = books_authors.book_id
	inner join authors
	on books_authors.author_id = authors.author_id
	where books_authors.book_id in (
           select books_authors.book_id
           from books_authors inner join authors
           on books_authors.author_id = authors.author_id
           where authors.author_name = "'.$author.'")');

$result = array();

while ($row = mysqli_fetch_assoc($query)) {
	$result[$row['book_id']]['book_title'] = $row['book_title'];
	$result[$row['book_id']]['authors'][] = $row['author_name'];
}

if (empty($result)) {
	header("location:index.php");
}
else {
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
			echo  '<a href="books.php?author='.urlencode($vv).'">'.$vv .'</a> ';
		}
		else {
		echo  '<a href="books.php?author='.urlencode($vv).'">'.$vv .'</a> | ';
	}
	$count++;
	}
	echo '</td></tr>';
	}
	}
}
?>
</tbody></table>
</div>

<?php
require 'inc/footer.php';
?>