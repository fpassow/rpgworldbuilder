<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        if (strlen($username) and ctype_alnum($username) and ctype_alnum($password)) {
            $user = $model.getUser($username);
            if ($user) {
                if ($user->password == $password) {
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
