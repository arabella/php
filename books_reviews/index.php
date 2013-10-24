<?php

session_start();

require 'config.php';
require 'functions.php';
$pageTitle = 'Home';
include 'inc/header.php';


if (isset($_GET['sort']) && ($_GET['sort'] == 'asc')) {
	$order = 'asc';
} else $order = 'desc';

$connection =  mysqli_connect('localhost', 'root', 'qwerty', 'books_reviews') 
				or die('Cannot connect to database.');
mysqli_set_charset($connection, 'utf8');

$q = mysqli_query($connection, "select * FROM books as b INNER JOIN 
    							books_authors as ba ON b.book_id=ba.book_id 
    							INNER JOIN authors as a
    							ON a.author_id=ba.author_id
    							order by b.book_title $order");

$result = [];

	while ($row = mysqli_fetch_assoc($q)) {
		$result[$row['book_id']]['book_title'] = $row['book_title'];
		$result[$row['book_id']]['authors'][$row['author_id']] = $row['author_name'];
	}

	echo '<table>
			<thead>
			<tr>
			<th>Books<a href="index.php?sort=asc"><img src="css/img/arrow-up.png"></a>
			<a href="index.php?sort=desc"><img src="css/img/arrow-down.png"></a> </th>
			<th>Authors</th>
			<th>Comments</th>
			</tr>
			</thead><tbody>';

	foreach ($result as $k => $v) {
		$cmnts = getComments($k);
		echo '<tr><td><a href="book.php?book_id=' . $k .'">' . $v['book_title'] .'</a></td><td>';

		$ar = [];
		foreach ($v['authors'] as $kk => $vv) {
			$ar[] =  '<a href="author.php?author_id=' . $kk .'">' . $vv .'</a>';
		}
		echo implode(' | ', $ar) . '</td><td> ' . count($cmnts) . '</td></tr>';
	}
	echo '</tbody></table>';


?>
<?php
include 'inc/footer.php';
