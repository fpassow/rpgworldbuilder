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
$importto = reqGET('importto');
$importfrom = reqGET('importfrom');
$to = $model->getCampaignByID($importto);
$from = $model->getCampaignByID($importfrom);

if (!$to) {
    $message = 'Campagin id '.$_GET['importto'].' not found.';
    require('status400.php');
    return;
}
if ($to->username != $username) {
    $message = 'Destingation campaign belongs to a different user.';
    require('status403.php');
    return;
}
if (!$from) {
    $message = 'Campagin id '.$_GET['importfrom'].' not found.';
    require('status400.php');
    return;
}

#Simple fields: Assign "from" values to "to" fields.
#               Concatenate if "to" already has a value.
#               But never change the tile.
foreach ($to->simpleFields as $name) {
    if ($name != 'title') {
        if ($from->$name) {
            if ($to->$name) {
                $to->$name = $to->$name.' '.$from->$name;
            } else {
                $to->$name = $from->$name;
            }
        }
    }
}
    
#Array fields: Add elements from "from" array to "to" array, 
#   unless exact value is already present.
foreach ($to->arrayFields as $name) {
    foreach ($from->$name as $val) {
       if (!in_array($val, $to->$name)) {
           $temp = $to->$name;
           $temp[] = $val;
           $to->$name = $temp;
       }
    }
}




$campaign = $to;
$username = $_SESSION['username'];
$user = $model->getUser($username);
$user->updateCampaign($to);
$model->storeUser($user);
header('Location: campaign.php?id='.$campaign->id, true, 303);
