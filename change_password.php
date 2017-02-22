<?php
require('init.php');

if ($method === 'POST') {
    $old_password = reqPOST('password');
    $new_password1 = reqPost'password1');
    $new_password2 = reqPOST('password2');
    if (!$isloggedin) {
        $message = 'Not logged in.';
        require('login_view.php');
        exit;
    }
    if ($new_password1 != new_password2) {
        $message = 'Password fields did not match.';
        require('change_password_view.php');
        exit;
    }
    if ($user->password != $old_password) {
        $message = 'Incorrect password for current user.';
        require('change_password_view.php');
        exit;
    }
    $user->password = $password1;
    $model->storeUser($user);
    header('Location: mycampaigns.php', true, 303);

} else {
    #GET
    $message = '';
    require('change_password_view.php');
}
