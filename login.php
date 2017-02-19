<?php
require_once('init.php');
if ($method != 'POST') {
    #GET
    $message = '';
    require('login_view.php');
} else {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if (strlen($username) and ctype_alnum($username)) {
        $user = $model->getUser($username);
        if ($user and user->password === $password) {
                $_SESSION['username'] = $username;
                $_SESSION['isloggedin'] = true;
                $isloggedin = true;
                require('mycampaigns.php');
                exit;
            }
        }
    }
    $message = 'Invalid username and/or password';
    require('login_view.php');
}
