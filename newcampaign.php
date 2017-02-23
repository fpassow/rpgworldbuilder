<?php
require('init.php');

if (!$isloggedin) {
        $message = 'Must be logged in.';
        require('status401.php');
        exit;
}
# Create blank object
$campaign = new Campaign($user->username);
$user->campaigns[] = $campaign;
$model->storeUser($user);  

header('Location: campaign.php?id='.$campaign->id, true, 303);
