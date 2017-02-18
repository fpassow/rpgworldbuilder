<?php
require_once('init.php');

if ($method === 'POST') {
    $posted_password = reqPOST('password');
    $old_password = reqPOST('password');
    $new_password1 = reqPost'new_password1');
    $new_password2 = reqPOST('new_password2');
    if (!$isloggedin) {
        $message = 'Not logged in.';
        require('change_password_view.php);
        return;
    }
    if ($new_password1 != new_password2) {
        $message = 'Password fields did not match.';
        require('change_password_view.php);
        return;
    }
    if (strlen($username) and ctype_alnum($username)) {
        $user = $model->getUser($username);
        if ($user) {
            if ($user->password == $old_password) {
                $_SESSION['username'] = $username;
                $_SESSION['isloggedin'] = true;
                require('mycampaigns.php');
                return;
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
