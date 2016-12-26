<?php

if(session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');

#if (!$_SESSION['isloggedin']) {
    
$userFiles = scandir('users');

# Remove "." and ".."
array_splice($userFiles, 0, 2);

foreach ($userFiles as $f) {
    $users[] = unserialize(file_get_contents('users\\'.$f)); 
}

require('home_view.php');

