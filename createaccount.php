<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');
$model = new Model;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['password2'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $password2 = trim($_POST['password2']);
        if (strlen($username) and ctype_alnum($username) 
            and strlen($password) and ctype_alnum($password)
            and $password == $password2) {
                
            $user = new User;
            $user->username = $username;
            $user->password = $password;
            $model->storeUser($user);
            $_SESSION['isloggedin'] = true;
            $_SESSION['username'] = $username;
            require('home.php');
            return;
            }
    }    
    $message = 'Username and password may contain only letters and numbers. And password fields must match.';
    require('login_view.php');
}
#GET
$message = '';
require('createaccount_view.php');
