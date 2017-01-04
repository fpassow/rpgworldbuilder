<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

if (!$_SESSION['isloggedin']) {
    require('login.php');
    return;
}

require_once('model.php');
    
$model = new Model;
$user = $model->getUser($_SESSION['username']);

require('mycampaigns_view.php');

