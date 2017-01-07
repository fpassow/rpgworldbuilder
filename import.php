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
if (!isset($_GET['importto'])) {
    $message = 'Missing importto parameter.';
    require('status401.php');
    return;
}
if (!isset($_GET['importfrom'])) {
    require('import_view.php');
    return;
}
$to = $model->getCampaignByID($_GET['importto']);
$from = $model->getCampaignByID($_GET['importfrom']);

if ($to) {
    if ($to->username != $_SESSION['username']) {
        $message = 'Destingation campaign belongs to a different user.';
        require('status403.php');
        return;
    }
} else {
    $message = 'Campagin id '.$_GET['importto'].' not found.';
    require('status400.php');
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
foreach ($to->simpleFields as $name) 
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
           $to->$name[] = $val;
       }
    }
}






$username = $_SESSION['username'];
$user = $model->getUser($username);
$user->updateCampaign($to);
$model->storeUser($user);
require('campaign_view.php');
