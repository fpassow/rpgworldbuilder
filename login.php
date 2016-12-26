<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        if (ctype_alnum($username) and ctype_alnum($password)) {
            $userFile = 'users\user_'.$username.'.txt';
            if (file_exists($userFile)) {
                $user = unserialize(file_get_contents($userFile));
                if ($user->password == $password) {
                    session_start();
                    $_SESSION['username'] = $username;
                    $_SESSION['isloggedin'] = true;
                    require('campaign.php');
                    return;
                }
            }
        }
    }
    $message = 'Invalid username and/or password';
    require('login_view.php');
} else {
    #GET
    $message = '';
    require('login_view.php');
}
