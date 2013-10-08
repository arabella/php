<?php
session_start();
include 'functions.php';
include 'config.php';
if (!isLogged()) {
	header("Location: index.php");
}
$pageTitle = "Board";
require 'inc/header.php';
?>

<h2><?= 'Hello ' . $_SESSION['username'] . '!';?></h2>
<form method = "get" action = "">
<menu>
	<ul>

		<li>
				<input type = "submit" name = "asc" value = "oldest"/>
		</li>
		<li>
				<input type = "submit" name = "desc" value = "newest"/>
		</li>
		<li>
			<label for = "cat">Filter by Category</label>
			<select name="cat">
				<option value="0">Show All</option>
				<?php
				if (isset($_GET['cat'])) {
				$selected = trim($_GET['cat']);
				} else $selected = '';
				foreach ($categories as $key => $value) {
				  		echo '<option value = "'.$key.'" '.($selected == $key ? 'selected' : '').'>'. $value . '</option>';
				  	}
				?>
	</select>

	<input type="submit" value = "Filter"/>
		</li>
				<li>
			<a href = "add-msg.php"><button type = "button">Add New Message</button></a> 

		</li>
	</ul>
</menu>

<?php
$connection = connect('localhost', 'root', 'qwerty', 'msg_board');

if (isset($_GET['asc'])) {
	$query = "SELECT * FROM messages ORDER BY msg_date ASC";
}

else if (isset($_GET['desc'])) {
	$query = "SELECT * FROM messages ORDER BY msg_date DESC";
}

else $query = "SELECT * FROM messages";


$results = query($query, $connection);

if (empty($results)) {
	$_SESSION['messages'] = $messages['noMsg'];
	header("Location: messages.php");
	exit();
}


foreach ($results as $row) {

	if ((isset($_GET['cat'])) && ($_GET['cat'] != 0) && trim($_GET['cat']) != $row -> msg_category) {
	continue;
}

if (isAdmin()) {
	$del = '   <a href="delete.php?deleteId=' . $row -> msg_id . '"><img src="css/img/delete.png"></a>';
} else $del = '';

	echo '<p class = "title">' .$row -> msg_title . '</p>';
	echo '<p>' .$row -> msg_text . '</p>';
	echo '<p class = "info">published on ' .$row -> msg_date . ' | by ' .
	$row -> author . ' | in ' .$categories[$row -> msg_category] . $del . '</p><hr>';
}
?>

	
</form>
</div>


<?php
require 'inc/footer.php';
?>
