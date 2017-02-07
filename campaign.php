<?php

if (session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');
$model = new Model;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Expected GET.";
    return;
}

if (!isset($_GET['id'])) {
    $message = 'Missing id parameter.';
    require('status401.php');
    return;
}
$id = $_GET['id'];
$campaign = $model->getCampaignByID($id);
if ($campaign) {
if (isset($_SESSION['isloggedin']) and $_SESSION['isloggedin'] and $campaign->username == $_SESSION['username']) {
        if (array_key_exists('focus_here', $_GET)) {
            $focus_here = $_GET['focus_here'];
        } else {
            $focus_here = '';
        }
        require('campaign_view.php');
        return;
    } else {
        require('campaign_static_view.php');
        return;  
    }
} else {
    $message = 'Campagin id '.$id.' not found.';
    require('status404.php');
    return;
}
