<?php 
ob_start();
session_start();

	$pageTitle = 'Upload Files';
	require 'inc/header.php';
	include 'functions.php';

	if (!isLogged()) {
	header("Location: index.php");
	die();
}

if ($_POST) {
	if (count($_FILES) > 0) {

		$folderName = $_SESSION['username'] . '-uploads';
		$path = realpath("files/$folderName/");
		$userFiles = scandir($path);
		$fileName = $_FILES['fileUpload']['name'];
		$extension = strtolower(end(explode('.',$fileName)));
		$unique = true;
		if ($extension == 'php' || $extension == 'pl' || $extension == 'py' 
			|| $extension == 'jsp' || $extension == 'asp' || $extension == 'htm' 
			|| $extension == 'shtml' || $extension == 'ch' || $extension == 'cgi') {	
		echo '<div class = "error">No executing scripts allowed. </br> Forbidden file types .php .pl .py .jsp .asp .htm .shtml .sh .cgi</div>' ;
		header("refresh: 2; url = admin.php");
		} 

		else {
			if (count($userFiles) > 0) {
			foreach ($userFiles as $name) {
				if ($fileName == $name) {
		 			echo '<div class = "error">A file with that name already exists</div>';
		 			$unique = false;
				}				
		}
					if (move_uploaded_file($_FILES['fileUpload']['tmp_name'], $path
					. DIRECTORY_SEPARATOR . $_FILES['fileUpload']['name'])) {
					if ($unique) {
						echo '<div class = "ok">File uploaded successfully</div>';
						header("refresh:2; url='admin.php");
					}									    
					}	
					else echo '<div class = "error">Error while uploading the file</div>';				
			}
		}
		}
	}
?>
<h1>User File Upload System</h1>
<div class = "main">
	<form id = "upload" method = "post" action = "upload.php" enctype = "multipart/form-data">
		<label for = "fileUpload" name = "fileUpload">Choose File</label>
		<input type = "file" name = "fileUpload"/>
		<input type = "submit" name = "uploadFiles" value = "Upload File"/>
	</form>
</div>


<?php
	include 'inc/footer.php';
?>