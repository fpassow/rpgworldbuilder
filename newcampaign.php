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

$is_new_campaign = true;
header('Location: campaign.php?id='.$campaign->id, true, 303);
