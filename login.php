<?php
require('init.php');
if ($method != 'POST') {
    #GET
    $message = '';
    require('login_view.php');
} else {
    $new_username = trim($_POST['username']);
    $password = trim($_POST['password']);
    if (strlen($new_username) and ctype_alnum($new_username)) {
        $new_user = $model->getUser($new_username);
        if ($new_user and $new_user->password === $password) {
            $_SESSION['username'] = $new_username;
            $isguest = false;
            $username = $new_username;
            $user = new_user;
            header('Location: mycampaigns.php', true, 303);
            exit;
        }
    }
    $message = 'Invalid username and/or password';
    require('login_view.php');
}
