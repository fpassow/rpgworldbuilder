<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');

$model = new Model;

if (!isset($_SESSION['isloggedin']) or !$_SESSION['isloggedin']) {
        $message = 'Must be logged in.';
        require('status401.php');
        return;
}
# Create blank object
$user = $model->getUser($_SESSION['username']);
$campaign = new Campaign($user->username);
$user->campaigns[] = $campaign;
$model->storeUser($user);  

$is_new_campaign = true;
require('campaign_view.php');
