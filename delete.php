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
if (!isset($_GET['deleteid'])) {
    $message = 'Missing deleteid parameter.';
    require('status401.php');
    return;
}
$deleteid = reqGet('deleteid');
$deletethis = $model->getCampaignById($deleteid);
if ($deletethis) {
    if ($deletethis->username === $username) {
        $user->deleteCampaign($deleteid);
        $model->storeUser($user);
        header('Location: mycampaigns.php', true, 303);
    } else {
        $message = 'Campaign belongs to a different user.';
        require('status403.php');
        return;
    }
} else {
    $message = 'Campagin id '.$deleteid.' not found.';
    require('status400.php');
    return;
}

