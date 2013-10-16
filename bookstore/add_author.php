<?php
$pageTitle = 'Add Author';
require 'inc/header.php';
require 'config.php';
require 'functions.php';
connect($connection);
mb_internal_encoding('UTF-8');
$selectQuery   = "select author_name from authors";
$checkunique = mysqli_query($connection, $selectQuery);
$isUnique = true;
if (isset($_POST['add-author'])) {
    $newAuthor = htmlspecialchars(trim($_POST['author-name']));
    if (mb_strlen($newAuthor) < 3) {
        echo '<div class = "error">Name too short</div>';
    } else {
        while ($row1 = $checkunique->fetch_assoc()) {
            if (!($row1['author_name'] == $newAuthor)) {
                continue;
            } else {
                echo '<div class = "error">Author already exists</div>';
                $isUnique = false;
                break;
            }
        }
        if ($isUnique) {
        	$insertQuery = "insert into authors (author_name) values('" . mysqli_real_escape_string($connection, $newAuthor) . "')";
            mysqli_query($connection, $insertQuery);
        	echo '<div class = "ok">Author "' . $newAuthor . '" added</div>';
        }
    }
}
?>


<form method = "post" action = "">
	<div id = "add-author">
	<ul>
		<li><label for = "author-name">Add Author</label></li>
		<li><input type = "text" name = "author-name"/></li>
		<li><input type = "submit" name = "add-author" value = "Add Author"/></li>
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
$results = mysqli_query($connection, $selectQuery);
while ($row = $results->fetch_assoc()) {
    echo '<tr><td><a href="books.php?author='. $row['author_name'] .'">' . $row['author_name'] . '</a></td></tr>';
}
?>

</tbody></table>
</div>

<?php
require 'inc/footer.php';
?>
