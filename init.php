<?php 
# Set userful variables and functions
#
# After this runs, you will have...
#
#  $model       See class definition below for details
#  $method     'GET', 'POST', etc.
#  $isloggedin  A boolean
#  $username    If logged in
#  #user        User object for the current user, if logged in
#  req(GET|POST|SESSION|SERVER)(name)  Functions that return the given param, or exit the page if it's missing.
#  try(GET|POST|SESSION|SERVER)(name)  Functions that return the given param, or empty string if it's missing.
session_start();
require('model.php');
$model = new Model;

$isloggedin = false;
if (isset($_SESSION['isloggedin']) and $_SESSION['isloggedin']) {
    if (isset($_SESSION['username']) and $_SESSION['username']) {
        $username = $_SESSION['username'];
        $isloggedin = true;
        $user = $model->getUser($username);
    }
}
if ($isloggedin and !$user) {
    $isloggedin = false;
    $message = "User not found.";
    require('status400.php');
}
              
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
