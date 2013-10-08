<?php
$categories = array(
1 =>'PHP', 
2 =>'C#', 
3 =>'JAVASCRIPT', 
4 =>'Chat');

$messages = array(
	'userExist' => '<div class = "error">User already exists in database!</div>',
	'userNameShort' => '<div class = "error">Username must be at least 5 characters long!</div>',
	'userNameValid' => '<div class = "error">Username can contain only letters and numbers!</div>',
	'loginSuccess' => '<div class = "ok">Successful login!</div>',
	'regSuccess' => '<div class = "ok">Successful registration!</div>',
	'loginValid' => '<div class = "error">Wrong username/password</div>',
	'titleLength' => '<div class = "error">Title must be less than 50 characters long!</div>',
	'bodyLength' => '<div class = "error">Message must be less than 250 characters long!</div>',
	'msgSuccess' => '<div class = "ok">Message posted successfully!</div>',
	'msgDel' => '<div class = "ok">Message deleted!</div>',
	'catMissing' => '<div class = "error">Please choose a category!</div>',
	'noMsg' => '<div class = "error">No messages to display!</div>',
	'msgFail' => '<div class = "error">Error while posting!</div>',
	);
?>
