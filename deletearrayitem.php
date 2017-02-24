<?php
require('init.php');

if ($method != 'GET') {
    echo "Expected GET.";
    exit;
}
$campaignid = reqGET('campaignid');
$campaign = $model->getCampaignByID($campaignid);
if ($campaign) {
    if ($campaign->username != $username) {
        $message = 'Campaign belongs to a different user.';
        require('status403.php');
        exit;
    }
} else {
    $message = 'Campagin id '.$campaignid.' not found.';
    require('status404.php');
    exit;
}
$fieldname = reqGET('fieldname');
$index = reqGET('index');
$campaign->deleteItem($fieldname, intval($index));
$user->updateCampaign($campaign);
$model->storeUser($user);
header('Location: campaign.php?id='.$campaign->id, true, 303);
