<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');
    
$model = new Model;

require('home_view.php');
