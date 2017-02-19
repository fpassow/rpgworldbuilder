<?php
require_once('init.php');

if (!$isloggedin) {
        $message = 'Must be logged in.';
        require('status401.php');
        exit;
}
$id = reqGET('id');

# Create blank object
$otherCampaign = $model->getCampaignByID($_GET['id']);
if (!$otherCampaign) {
    $message = 'No campaign with that ID.';
    require('status404.php');
    exit;
} 
$campaign = clone $otherCampaign;
$campaign->username = $username;
$campaign->id = uniqid();
$user->campaigns[] = $campaign;
$model->storeUser($user);  
require('campaign_view.php');
