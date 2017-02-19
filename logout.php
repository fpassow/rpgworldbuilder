<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}
session_destroy();

require_once('init.php');

require('home.php');
