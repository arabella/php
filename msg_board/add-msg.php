<?php
session_start();
include 'functions.php';
include 'config.php';
if (!isLogged()) {
	header("Location: index.php");
}
$pageTitle = "Add Message";
require 'inc/header.php';

if (isset($_POST['add-msg'])) {
	$title = htmlspecialchars(trim($_POST['title']));
	$body = htmlspecialchars(trim($_POST['body']));

	if (strlen($title) > 50) {
		$_SESSION['messages'] = $messages['titleLength'];
		header("Location: add-msg.php");
		exit();
	}

	if (strlen($body) > 250) {
		$_SESSION['messages'] = $messages['bodyLength'];
		header("Location: add-msg.php");
		exit();		
	}

	$connection = connect('localhost', 'root', 'qwerty', 'msg_board');
	$title = mysqli_real_escape_string($connection, $title);
	$body = mysqli_real_escape_string($connection, $body);
	$date = date('Y-m-d H:i:s');
	$author = $_SESSION['username'];
	$cat = '';
	if (trim($_POST['cat'] == '0')) {
	$_SESSION['messages'] = $messages['catMissing'];
		header("Location: add-msg.php");
		exit();
	} else $cat = trim($_POST['cat']); 

	$query = "INSERT INTO messages
	(msg_id, msg_date, msg_title, msg_text, author, msg_category) 
	VALUES (NULL, '$date', '$title', '$body', '$author', '$cat')";
	$result = mysqli_query($connection, $query);

	if ($result) {
		$_SESSION['messages'] = $messages['msgSuccess'];
	    header("Location: messages.php");
	    exit();
	} else $_SESSION['messages'] = $messages['msgFail'];
			header("Location: add-msg.php");
		exit();
}
?>

<form action = "" method = "post">
<ul>
	<li>
<label for = "title" name = "title">Message Title</label>
<input type = "text" name = "title"  required = "required"/><br>
</li><li>
<label for = "cat">Choose Category</label>
<select name = "cat">
	<option value = "0">Choose Category</option>
	<?php
			foreach ($categories as $key => $value) {
				echo '<option value = "'.$key.'">'
. $value . '</option>';			
		}
		?>
</select>
</li><li>
<label for = "body" name = "body">Message Text</label>
<textarea name = "body" placeholder = "Enter your message ..." rows="4" cols="50" required = "required"></textarea><br>
</li><li>
<input type ="submit" name = "add-msg" value = "Submit"/></li>
</ul>
</form>
</div>
<?php
require 'inc/footer.php';
?>