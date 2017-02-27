<?php
require('init.php');

$old_user = $user;

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
            $user = $new_user;
            
            #If the previous user had been a guest,
            # the new user gets all their campaigns.
            if ($old_user->guest and sizeof($old_user->campaigns) {
                $new_campaigns = $user->campaigns;
                foreach ($old_user->campaigns as $camp) {
                    $camp->username = $username;
                    $new_campaigns[] = $camp;
                }
                $user->campaigns = $new_campaigns;
                $model->storeUser($user);
            }
            
            header('Location: mycampaigns.php', true, 303);
            exit;
        }
    }
    $message = 'Invalid username and/or password';
    require('login_view.php');
}
