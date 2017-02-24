<?php
require('init.php');

if ($method === 'POST') {
    echo "Expected GET.";
    exit;
}

$id = reqGET('id');
$campaign = $model->getCampaignByID($id);
if ($campaign) {
    if ($campaign->username == $username) {
        $focus_here = tryGET('focus_here');
        require('campaign_view.php');
    } else {
        require('campaign_static_view.php'); 
    }
} else {
    $message = 'Campagin id '.$id.' not found.';
    require('status404.php');
    exit;
}
