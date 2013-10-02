<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title><?= $pageTitle ?></title>
  <nav>
		<ul>
			<li><a href="index.php">Home</a></li>
			<?php
			if (isset($_SESSION['username'])) {
			echo '<li><a href = "logout.php">Logout</a> ';
		}
		?>
		</ul>
	</nav>
</head>
<body>
