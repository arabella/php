<?php
session_start();
$pageTitle = "Logout";
session_destroy();

$_SESSION = array();
header("Location:index.php");
exit;