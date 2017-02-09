<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');
$model = new Model;

if ($_SERVER['REQUEST_METHOD'] != 'GET') {
    echo "Expected GET.";
    return;
}

if (!$_SESSION['isloggedin']) {
    $message = 'Must be logged in.';
    require('status401.php');
    return;
}
if (!isset($_GET['campaignid'])) {
    $message = 'Missing campaignid parameter.';
    require('status401.php');
    return;
}
$campaignid = $_GET['campaignid'];
$campaign = $model->getCampaignByID($campaignid);
if ($campaign) {
    if ($campaign->username != $_SESSION['username']) {
        $message = 'Campaign belongs to a different user.';
        require('status403.php');
        return;
    }
} else {
    $message = 'Campagin id '.$campaignid.' not found.';
    require('status404.php');
    return;
}
if (isset($_GET['fieldname']) and isset($_GET['index']) and $_GET['fieldname'] and $_GET['index']) {
    $username = $_SESSION['username'];
    echo $campaign->id. ', '.$_GET['fieldname'].', '.$_GET['index'].'<<<<';
    $campaign->deleteItem($_GET['fieldname'], intval($_GET['index']));
    $user = $model->getUser($username);
    $user->updateCampaign($campaign);
    $model->storeUser($user);
}

header('Location: campaign.php?id='.$campaign->id, true, 303);
