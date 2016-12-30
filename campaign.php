<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');

$model = new Model;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['id'])) {
        $campaign = $model->getCampaignByID($id);
        if (!$campaign) {
            $message = 'No campagin with id = "'.$id.'".';
            require('status404.php');
            return;
        }
        if ($_SESSION['isloggedin'] and $_SESSION['username'] == $campaign->username) {
            require('campaign_view.php');
            return;
        } else {
            require('campaign_static_view.php');
            return;
        }
    } elseif($_SESSION['isloggedin']) {
        $campaign = new Campaign($_SESSION['username']);
        $campaign->title = 'Untitled';
        $user = $model->getUser($_SESSION['username']);
        $user->campaigns[] = $campaign;
        $model->storeUser($user);
        require('campaign_view.php');
        return;
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!$_SESSION['isloggedin']) {
        $message = 'Must be logged in.';
        require('status401.php');
        return;
    }
    if (isset($_POST['id'])) {
        $campaign = $model->getCampaignByID($id);
        if ($campaign) {
            if ($campaign->usename != $_SESSION['username']) {
                $message = 'Campaign belongs to a different user.';
                require('status403.php');
                return;
            }
        } else {
            $message = 'Campagin id "'.$id.'" not found.';
            require('status404.php');
            return;
        }
    }
    $campaign->updateFromArray($_POST);
    $user = $model->getUser($username);
    $user->campaigns[] = $campaign;
    $model->storeUser($user);
    require('campaign_view.php');
}
