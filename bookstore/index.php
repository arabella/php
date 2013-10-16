
<?php
$pageTitle = 'Bookstore | Home';
require 'inc/header.php';
require 'config.php';
require 'functions.php';

connect($connection);
if (isset($_GET['sort']) && ($_GET['sort'] == 'asc')) {
	$order = 'asc';
} else $order = 'desc';

$query = mysqli_query($connection, 
	"select b.book_title, b.book_id, a.author_name from  books as b, authors as a
join books_authors as ba
where a.author_id = ba.author_id
and b.book_id = ba.book_id
order by b.book_title $order");

$result = array();

while ($row = mysqli_fetch_assoc($query)) {
	$result[$row['book_id']]['book_title'] = $row['book_title'];
	$result[$row['book_id']]['authors'][] = $row['author_name'];
}

echo '<form method = "get"><table>
<thead>
<tr>
<th>Books<a href="index.php?sort=asc"><img src="css/img/arrow-up.png"></a>
<a href="index.php?sort=desc"><img src="css/img/arrow-down.png"></a> </th>
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

?>


</table></form>
</div>



<?php
require 'inc/footer.php';
?>