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
if (!isset($_GET['deleteid'])) {
    $message = 'Missing deleteid parameter.';
    require('status401.php');
    return;
}
$deleteid = $_GET['deleteid'];
$deletethis = $model->getCampaignById($deleteid);

if ($deletethis) {
    if ($deletethis->username != $_SESSION['username']) {
        $message = 'Destingation campaign belongs to a different user.';
        require('status403.php');
        return;
    }
} else {
    $message = 'Campagin id '.$deleteid.' not found.';
    require('status400.php');
    return;
}

$username = $_SESSION['username'];
$user = $model->getUser($username);
$user->deleteCampaign($deleteid);
$model->storeUser($user);
header('Location: mycampaigns.php', true, 303);
