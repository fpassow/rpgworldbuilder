<?php
require('init.php');

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
$campaign->title = 'Clone of '.$campaign->title;
$user->campaigns[] = $campaign;
$model->storeUser($user);  
require('campaign_view.php');
header('Location: campaign.php?id='.$campaign->id, true, 303);