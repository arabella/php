<?php
require 'config.php';

function connect ($connection) {
	mysqli_set_charset($connection, 'utf8');
	return $connection;
}

function query ($query, $connection) {
	$result = mysqli_query($connection, $query);

	if ($result) {
		$rows = array();

		while ($row = mysqli_fetch_object($result)) {
			$rows[] = $row;
		}
		return $rows;
	}
	return false;
}

function sortIt() {
return (isset($_GET['sbup'])) ;
}

?>