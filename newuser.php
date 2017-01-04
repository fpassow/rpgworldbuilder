<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');
$model = new Model;

if ($_SERVER['REQUEST_METHOD'] != 'POST') { #GET, etc.
    $message = '';
    require('newuser_view.php');
} else{ #POST
    if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['password2'])) {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $password2 = trim($_POST['password2']);
        if (strlen($username) and ctype_alnum($username) 
            and strlen($password) and ctype_alnum($password)
            and $password == $password2) {
                
            if ($model->getUser($username)) {
                $message = "User already exists.";
                require('newuser_view.php');
                return;
            } else {
                $user = new User;
                $user->username = $username;
                $user->password = $password;
                $model->storeUser($user);
                $_SESSION['isloggedin'] = true;
                $_SESSION['username'] = $username;
                require('mycampaigns.php');
                return;
            }
        } else { #Invalid name or pw.
            $message = 'Username and password must contain only letters and numbers. And password fields must match.';
            require('newuser_view.php');
        }
    } #Missing params
}

