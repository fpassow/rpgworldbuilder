<?php
require('init.php');

if ($method != 'POST') {
    $message = '';
    require('newuser_view.php');
} else { #POST
    $username = reqPOST('username');
    $password = reqPOST('password');
    $password2 = reqPOST('password2');

    if (strlen($username) and ctype_alnum($username) 
        and strlen($password) and $password == $password2) {
                
        if ($model->getUser($username)) {
            $message = "User already exists.";
            require('newuser_view.php');
            exit;
        } else {
            $user = new User;
            $user->username = $username;
            $user->password = $password;
            $model->storeUser($user);
            $_SESSION['isloggedin'] = true;
            $_SESSION['username'] = $username;
            header('Location: mycampaigns.php', true, 303);
            exit;
        }
    } else { #Invalid name or pw.
        $message = 'Username must contain only letters and numbers. And password fields must match.';
        require('newuser_view.php');
    }
}
