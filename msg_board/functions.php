
<?php
function checkPassword($password) {
    $errors = array();

    if (strlen($password) < 5) {
        $errors[] = "Password too short!";
    }

    if (!preg_match("#[0-9]+#", $password)) {
        $errors[] = "Password must include at least one number!";
    }

    if (!preg_match('/^[a-zA-Z\p{Cyrillic}\D\s\-][\S]+$/u', $password)) {
        $errors[] = "Password must include at least one letter!";
    } 


    return $errors;
}


function isLogged() {
    return isset($_SESSION['username']);
}

function isAdmin() {
    return $_SESSION['role'] == 1; 
}



function connect($host = 'localhost', $username, $password, $db = '') {
    $connection =  mysqli_connect($host, $username, $password) or die('Cannot connect to database.');;
    if (!empty($db)) {
        mysqli_select_db($connection, $db);
    }
    mysqli_set_charset($connection, 'utf8');
    return $connection;
}

//$connection = connect('localhost', 'root', 'qwerty', 'msg_board');

function query($query, $connection) {
    $result  = mysqli_query($connection, $query);
    if ($result) {
        //var_dump($result);
        $rows = array();
        while ($row = mysqli_fetch_object($result)) {
            $rows[] = $row;
        }
       return $rows;
    }
   return false;
}

// $results = query('select * from users', connect('localhost', 'root', 'qwerty', 'msg_board'));


