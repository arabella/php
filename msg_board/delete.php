<?php
session_start();
require 'functions.php';
include 'config.php';

if (isset($_GET['deleteId'])) {
	$idToDel = $_GET['deleteId'];
}

$connection = connect('localhost', 'root', 'qwerty', 'msg_board');
$query = "DELETE FROM messages WHERE msg_id = '$idToDel'";

mysqli_query($connection, $query);

$_SESSION['messages'] = $messages['msgDel'];
	    header('Location: messages.php');
	    exit();
?>