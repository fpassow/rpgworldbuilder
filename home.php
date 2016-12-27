<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');

#if (!$_SESSION['isloggedin']) {
    
$model = new Model;
$users = $model->getUsers();

require('home_view.php');

