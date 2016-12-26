<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');
if (!$_SESSION['isloggedin']) {
    require('login.php');
    return;
} else {
    $username = $_SESSION['username'];
}

$user = unserialize(file_get_contents('users\user_'.$username.'.txt')); 
$campaign = $user->campaign;

# On POST, add data to campaign oject
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $campaign->updateFromArray($_POST);

    # Serialize and save
    $f = fopen('campaign_obj.txt', 'w+');
    fwrite($f, serialize($campaign));
    fclose($f);
}

# Show the view
require('campaign_view.php');
