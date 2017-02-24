<?php 
# Set userful variables and functions.
# Note that the user is always "logged in" and has a User object.
#    Instead of being logged in or not, a User is a regular user or a guest.
#
# After this runs, you will have...
#
#  $model       See class definition below for details
#  $method     'GET', 'POST', etc.
#  $isguest    A boolean
#  $username    
#  #user        User object for the current user
#  req(GET|POST|SESSION|SERVER)(name)  Functions that return the given param, or exit the page if it's missing.
#  try(GET|POST|SESSION|SERVER)(name)  Functions that return the given param, or empty string if it's missing.
session_start();
require('model.php');
$model = new Model;
$user = false;
if (isset($_SESSION['username'])) {
    $user = $model->getUser($username);
}
if (!$user) {
    $user = new User;
    $user->isguest = true;
    $user->username = 'guest'.uniqid();
    $user->password = uniqid();
}
$username = $user->username;
$isguest  = $user->isguest; 

$method = $_SERVER['REQUEST_METHOD'];
 
function reqGET($name) {
    if (isset($_GET[$name])) {
        return trim($_GET[$name]);
    } else {
        $message = 'Missing '.$name.' parameter.';
        require('status401.php');
        exit;
    }
}
function reqPOST($name) {
    if (isset($_POST[$name])) {
        return trim($_POST[$name]);
    } else {
        $message = 'Missing '.$name.' parameter.';
        require('status401.php');
        exit;
    }
}
function reqSERVER($name) {
    if (isset($_SERVER[$name])) {
        return trim($_SERVER[$name]);
    } else {
        $message = 'Missing '.$name.' parameter.';
        require('status401.php');
        exit;
    }
}
function reqSESSION($name) {
    if (isset($_SESSION[$name])) {
        return trim($_SESSION[$name]);
    } else {
        $message = 'Missing '.$name.' parameter.';
        require('status401.php');
        exit;
    }
}
function tryGET($name) {
    if (isset($_GET[$name])) {
        return trim($_GET[$name]);
    } else {
        return '';
    }
}
function tryPOST($name) {
    if (isset($_POST[$name])) {
        return trim($_POST[$name]);
    } else {
        return '';
    }
}
function trySERVER($name) {
    if (isset($_SERVER[$name])) {
        return trim($_SERVER[$name]);
    } else {
        return '';
    }
}
function trySESSION($name) {
    if (isset($_SESSION[$name])) {
        return trim($_SESSION[$name]);
    } else {
        return '';
    }
}
