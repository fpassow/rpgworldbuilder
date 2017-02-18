<?php
require_once('init.php');

if ($method != 'GET') {
    echo "Expected GET.";
    return;
}
if (!$isloggedin) {
    $message = 'Must be logged in.';
    require('status401.php');
    return;
}
$campaignid = reqGET('campaignid');
$campaign = $model->getCampaignByID($campaignid);
if ($campaign) {
    if ($campaign->username != $username) {
        $message = 'Campaign belongs to a different user.';
        require('status403.php');
        return;
    }
} else {
    $message = 'Campagin id '.$campaignid.' not found.';
    require('status404.php');
    return;
}
$fieldname = reqGET('fieldname');
$index = reqGET('index');
$campaign->deleteItem($fieldname, intval($index'));
$user->updateCampaign($campaign);
$model->storeUser($user);
header('Location: campaign.php?id='.$campaign->id, true, 303);
