<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');
$model = new Model;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) and isset($_POST['password'])) {
        $username = trim($_POST['username']);
        $old_password = trim($_POST['password']);
        $new_password1 = trim($_POST['new_password1']);
        $new_password2 = trim($_POST['new_password2']);
        if (strlen($username) and ctype_alnum($username)) {
            $user = $model->getUser($username);
            if ($user) {
                if ($user->password == $password) {
                    $_SESSION['username'] = $username;
                    $_SESSION['isloggedin'] = true;
                    require('mycampaigns.php');
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
    require('change_password_view.php');
}
