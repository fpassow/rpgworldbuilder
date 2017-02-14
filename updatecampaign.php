<?php
require_once('view_lib.php'); # for nextFocus(...)

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');

$model = new Model;

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    echo "Expected POST.";
    return;
}

if (!$_SESSION['isloggedin']) {
    $message = 'Must be logged in.';
    require('status401.php');
    return;
}
if (!isset($_POST['id'])) {
    $message = 'Missing id parameter.';
    require('status401.php');
    return;
}
$id = $_POST['id'];
$campaign = $model->getCampaignByID($id);
if ($campaign) {
    if ($campaign->username != $_SESSION['username']) {
        $message = 'Campaign belongs to a different user.';
        require('status403.php');
        return;
    }
} else {
    $message = 'Campagin id '.$id.' not found.';
    require('status404.php');
    return;
}

$username = $_SESSION['username'];
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

