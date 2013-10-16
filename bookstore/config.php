<?php

$config = array(
'DB_HOST' => 'localhost',
'DB_USER' => 'root',
'DB_PASSWORD' => 'qwerty',
'DB_NAME' => 'books'
	);

$connection = mysqli_connect($config['DB_HOST'], 
	$config['DB_USER'], 
	$config['DB_PASSWORD'], 
	$config['DB_NAME'])
	or die('Cannot connect to database');
?>