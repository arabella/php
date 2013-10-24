<?php
$config = array(
'DB_USER' => 'root',
'DB_PASSWORD' => 'qwerty',
	);

$messages = array(
	'LoginSuccess' => '<div class = "ok">Successful login</div>',
	'Invalid_UN_length' => '<div class = "error">Username must be 
	between 3 and 30 characters.</div>',
	'Invalid_UN_Char' => '<div class = "error">Username must be 
	only latin letters and numbers.</div>',
	'ShortPass' => '<div class = "error">Password must be 
	at least 5 characters long.</div>',
	'NoNumberPass' => '<div class = "error">Password must include at least one number.</div>',
	'NoLetterPass' => '<div class = "error">Password must include at least one letter.</div>',
	'LoginFail' => '<div class = "error">Wrong username or password.</div>',
	'ExistingUser' => '<div class = "error">Username already taken.</div>',
	'RegSuccess' => '<div class = "ok">Registration successful.</div>',
	'AN_Length' => '<div class = "error">Author name must be between 3 and 150 characters long.</div>',
	'AuthorAddSuccess' => '<div class = "ok">Author added.</div>',
	'ExistingAuthor' => '<div class = "error">Author already exists.</div>',
	'InvalidAuthorId' => '<div class = "error">There is no such author.</div>',
	'InvalidBookId' => '<div class = "error">There is no such book.</div>',
	'InvalidUserId' => '<div class = "error">There is no such user.</div>',
);
?>