<?php
include 'functions.php';
session_start();
if (!isLogged()) {
	header("Location: index.php");
	die();
}
$file = basename($_GET['file']);
$folderName = $_SESSION['username'] . '-uploads';
$fileLoc = "files/$folderName/".$file;
$fullpath = realpath($fileLoc);

if(!$fullpath){ // file does not exist
    die('file not found');
} else {
$mm_type = "application/octet-stream";

header("Cache-Control: public, must-revalidate");
header("Pragma: hack");
header("Content-Type: $mm_type");
header("Content-Length: " .(string)(filesize($fullpath)) );
header('Content-Disposition: attachment; filename = "'. $file . '"');
header("Content-Transfer-Encoding: binary\n");

ob_end_clean();                
readfile($fullpath);

exit;
}
?>