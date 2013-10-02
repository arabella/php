<?php

function validate_user_creds($username, $password) {
	$fileName = 'users.txt';
	if (file_exists($fileName)) {
		$data = file($fileName);
		
		foreach ($data as $user) {
			$userCreds = explode('|', $user);
			if ($userCreds[0] == $username && $userCreds[1] == $password) {
				return true;
			}
		}
	}
	
}

function checkExistingUser($username){

	$fileName = 'users.txt';
	if (file_exists($fileName)) {
		$data = file($fileName);
		
		foreach ($data as $user) {
			$userCreds = explode('|', $user);
			if (strtolower($userCreds[0]) === strtolower($username)) {
				return true;
			}
		}
	}
}


function isLogged() {
	return isset($_SESSION['username']);
}


function checkPassword($password) {
    $errors = array();

    if (strlen($password) < 4) {
        $errors[] = "Password too short!";
    }

    if (!preg_match("#[0-9]+#", $password)) {
        $errors[] = "Password must include at least one number!";
    }

    if (!preg_match("#[a-zA-Z]+#", $password)) {
        $errors[] = "Password must include at least one letter!";
    } 


    return $errors;
}


# Snippet from PHP Share: http://www.phpshare.org

    function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}

// function get_mime_type($file)
// {

//         // our list of mime types
//         $mime_types = array(
//                 "pdf"=>"application/pdf"
//                 ,"exe"=>"application/octet-stream"
//                 ,"zip"=>"application/zip"
//                 ,"docx"=>"application/msword"
//                 ,"doc"=>"application/msword"
//                 ,"xls"=>"application/vnd.ms-excel"
//                 ,"ppt"=>"application/vnd.ms-powerpoint"
//                 ,"gif"=>"image/gif"
//                 ,"png"=>"image/png"
//                 ,"jpeg"=>"image/jpg"
//                 ,"jpg"=>"image/jpg"
//                 ,"mp3"=>"audio/mpeg"
//                 ,"wav"=>"audio/x-wav"
//                 ,"mpeg"=>"video/mpeg"
//                 ,"mpg"=>"video/mpeg"
//                 ,"mpe"=>"video/mpeg"
//                 ,"mov"=>"video/quicktime"
//                 ,"avi"=>"video/x-msvideo"
//                 ,"3gp"=>"video/3gpp"
//                 ,"css"=>"text/css"
//                 ,"jsc"=>"application/javascript"
//                 ,"js"=>"application/javascript"
//                 ,"php"=>"text/html"
//                 ,"htm"=>"text/html"
//                 ,"html"=>"text/html"
//         );

//         $extension = strtolower(end(explode('.',$file)));

//         return $mime_types[$extension];
// }
?>
