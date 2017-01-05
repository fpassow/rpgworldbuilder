<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');

$model = new Model;

if (!$_SESSION['isloggedin']) {
        $message = 'Must be logged in.';
        require('status401.php');
        return;
}
if (!isset($_GET['id'])) {
    $message = 'Missing id parameter.';
    require('status401.php');
    return;
}
# Create blank object
$user = $model->getUser($_SESSION['username']);
$otherCampaign = $model->getCampaignByID($_GET['id']);
if (!$otherCampaign) {
    $message = 'No campaign with that ID.';
    require('status404.php');
    return;
} 
$campaign = clone $otherCampaign;
$campaign->username = $_SESSION['username'];
$campaign->id = uniqid();
$user = $model->getUser($_SESSION['username']);
$user->campaigns[] = $campaign;
$model->storeUser($user);  
require('campaign_view.php');
