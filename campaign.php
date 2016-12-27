<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');

#
# IF LOGGED IN AND I OWN THIS CAMPAIGN AND THIS IS A POST, 
#       UPDATE AND REDISPLAY THE EDIT PAGE

# IF LOGGED IN AND I OWN THIS CAMPAIGN AND THIS IS A GET,
#       DISPLAY THE EDIT PAGE
#
# IF NOT LOGGED IN OR THIS IS NOT MY PAGE (REGARDLESS OF METHOD),
#       DISPLAY STATIC VIEW
#

if (!$_SESSION['isloggedin']) {
    require('login.php');
    return;
} else {
    $username = $_SESSION['username'];
}

$user = unserialize(file_get_contents('users\user_'.$username.'.txt')); 

# On POST, add data to campaign oject
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user->campaign->updateFromArray($_POST);
    # Serialize and save
    $f = fopen('users\\user_'.$user->username.'.txt', 'w');
    fwrite($f, serialize($user));
    fclose($f);
}

# Show the view
require('campaign_view.php');
