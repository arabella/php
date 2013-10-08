<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <title><?= $pageTitle ?></title>
</head>

<body>

  <div id="wrap"> 

  <div id="main"> 

  	<header class="fixed">
  	
	  <div class="center">

				
				<?php
				if (isset($_SESSION['username'])) {
				echo '<nav><ul>';
				echo '<li><a href = "logout.php">Logout</a> ';
				echo '</nav></ul>';
			}
			?>
				<h1 class = "center">Message Board</h1>					
			<div class="clear"></div>				
        </div> <!-- END center-->
	</header>
	<div id = "content">
	<?php
	if (isset($_SESSION['messages'])) {
        echo $_SESSION['messages'];
        unset($_SESSION['messages']);
        }
?>

