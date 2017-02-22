<?php
require('init.php');
require('view_lib.php'); # for nextFocus(...)

if ($method != 'POST') {
    echo "Expected POST.";
    exit;
}

if (!$isloggedin) {
    $message = 'Must be logged in.';
    require('status401.php');
    exit;
}

$id = reqPOST('id');
$campaign = $model->getCampaignByID($id);
if ($campaign) {
    if ($campaign->username != $username) {
        $message = 'Campaign belongs to a different user.';
        require('status403.php');
        exit;
    }
} else {
    $message = 'Campagin id '.$id.' not found.';
    require('status404.php');
    exit;
}

$campaign->updateFromArray($_POST, $model->getDef()->fields);
$user = $model->getUser($username);
$user->updateCampaign($campaign);
$model->storeUser($user);
if (array_key_exists('focus_here', $_POST) and strlen(trim($_POST['focus_here']))) {
    $focus_here = nextFocus($focus_here, $model->getDef());
    header('Location: campaign.php?id='.$campaign->id.'&focus_here='.$_POST['focus_here'], true, 303);
} else {
    header('Location: campaign.php?id='.$campaign->id, true, 303);
}
