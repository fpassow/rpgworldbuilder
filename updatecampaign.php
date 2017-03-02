<?php
require('init.php');
require('view_lib.php'); # for nextFocus(...)

if ($method != 'POST') {
    echo "Expected POST.";
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

# Look for a param named add_<name>. 
# If found, it was an array field's submit button. 
#   Send the name back in focus_here.
foreach ($_POST as $key=>$val) {
    if (strpos($key, 'add_') === 0) {
        $focus_here = substr($key, 4);
        header('Location: campaign.php?id='.$campaign->id.'&focus_here='.$focus_here, true, 303);
        return;
    }
}
header('Location: campaign.php?id='.$campaign->id, true, 303);
