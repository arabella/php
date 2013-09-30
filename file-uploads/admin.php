<?php
ob_start();
session_start();
$pageTitle = "Admin Page";
include 'inc/header.php';
include 'functions.php';

if (!isLogged()) {
	header("Location: index.php");
	die();
}
 
$folderName = $_SESSION['username'] . '-uploads';
// if (isset($_POST['browseFiles'])) {
// 	header("Location:" . "files/$folderName");
// } 
if (isset($_POST['uploadFiles'])) {
	header("Location:upload.php");
}
if (isset($_POST['logout'])) {
	header("Location:logout.php");
}

$folderName = $_SESSION['username'] . '-uploads';

$path = realpath("files/$folderName");
$files = scandir($path);
echo '<h1> User File Upload System </h1>';
echo '<div class = "main">';
echo '<h2>Hello  ' . $_SESSION['username'] . '!</h2>';
if (count($files) > 2) {
	echo '<table>';
    echo '<thead>';
	echo '<tr>';
	echo '<th>File Name</th>';
	echo '<th>Type</th>';
	echo '<th>Size</th>';
	echo '</tr>';
	echo '</thead>';
	echo '<tbody>';

	if ($handle = opendir($path)) {
    		while (false !== ($entry = readdir($handle))) {
		        if ($entry != "." && $entry != "..") {
		        	$size = filesize($path. '/' .$entry);
		        	$extension = strtolower(end(explode('.',$entry)));

		            echo "<tr><td><a href='download.php?file=".$entry."'>".$entry."</a></td>" . 
		            '<td>' . $extension . '</td><td>' . formatSizeUnits($size) .'</td></tr></div>';

		        }
    		} 
    		closedir($handle);   
 		}
} else echo '<h2>You have no files. Why not upload now?</h2>';
?>



<form method = "post" action = "">
	<menu><ul>
		<!-- li>
			<input type = "submit" name = "browseFiles" value = "Browse Your Files"/>
		</li> -->
		<li>
			<input type = "submit" name = "uploadFiles" value = "Upload New Files"/>
		</li>
		<!-- <li>
			<input type = "submit" name = "logout" value = "Logout"/>
		</li> -->
	</ul></menu>
	
</form>
</div>

<?php
include 'inc/footer.php';
?>