<?php
require('init.php');

#If the old user was a guest, the new one gets their campaigns
$old_user = $user;

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
            
            #If the previous user had been a guest,
            # the new user gets all their campaigns.
            if ($old_user->guest and sizeof($old_user->campaigns) {
                $new_campaigns = $user->campaigns;
                foreach ($old_user->campaigns as $camp) {
                    $camp->username = $username;
                    $new_campaigns[] = $camp;
                }
                $user->campaigns = $new_campaigns;
            }
            
            $model->storeUser($user);
            header('Location: mycampaigns.php', true, 303);
            exit;
        }
    } else { #Invalid name or pw.
        $message = 'Username must contain only letters and numbers. And password fields must match.';
        require('newuser_view.php');
    }
}
