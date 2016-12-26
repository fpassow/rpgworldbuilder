<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['username']) and isset($_POST['password']) and isset($_POST['password2'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        if (ctype_alnum($username) and ctype_alnum($password) and ($password == $password2)) {
         
            $user = new User;
            $user->username = $username;
            $user->password = $password;
            $user->campaign = new Campaign;
            
            $f = fopen('users\user_'.$username.'.txt', 'w');
            fwrite($f, serialize($user));
            fclose($f);
            $_SESSION['username'] = $username;
            $_SESSION['isloggedin'] = true;
       
            require('campaign.php');
            return;
        }
    }
    $message = 'Usernames and passwords may contain only letters and numbers. And password fields must match.';
    require('createaccount_view.php');
} else {
    #GET
    require('createaccount_view.php');
}
