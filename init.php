<?php 
# Set userful variables and functions
#
# After this runs, you will have...
#
#  $model       See class definition below for details
#  $method     'GET', 'POST', etc.
#  $isloggedin  A boolean
#  #user        User object for the current user, if logged in
#  req(GET|POST|SESSION|SERVER)(name)  Functions that return the given param, or exit the page if it's missing.
#  try(GET|POST|SESSION|SERVER)(name)  Functions that return the given param, or empty string if it's missing.

require_once('model.php');
$model = new Model;

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$isloggedin = isset($_SESSION['isloggedin']) 
              and $_SESSION['isloggedin']
              and isset($_SESSION['username'])
              and $_SESSION['username'];
              
if ($isloggedin) {
    $user = $_SESSION['username']; <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
}
$method = $_SERVER['REQUEST_METHOD'];
 
function reqGET($name) {
    if (isset($_GET[$name] and $_GET[$name]])) {
        return trim($_GET[$name]);
    } else {
        $message = 'Missing '.$name.' parameter.';
        require('status401.php');
        return;
    }
}
function reqPOST($name) {
    if (isset($_POST[$name] and $_POST[$name]])) {
        return trim($_POST[$name]);
    } else {
        $message = 'Missing '.$name.' parameter.';
        require('status401.php');
        return;
    }
}
function reqSERVER($name) {
    if (isset($_SERVER[$name] and $_SERVER[$name]])) {
        return trim($_SERVER[$name]);
    } else {
        $message = 'Missing '.$name.' parameter.';
        require('status401.php');
        return;
    }
}
function reqSESSION($name) {
    if (isset($_SESSION[$name] and $_SESSION[$name]])) {
        return trim($_SESSION[$name]);
    } else {
        $message = 'Missing '.$name.' parameter.';
        require('status401.php');
        return;
    }
}
function tryGET($name) {
    if (isset($_GET[$name] and $_GET[$name]])) {
        return trim($_GET[$name]);
    } else {
        return '';
    }
}
function tryPOST($name) {
    if (isset($_POST[$name] and $_POST[$name]])) {
        return trim($_POST[$name]);
    } else {
        return '';
    }
}
function trySERVER($name) {
    if (isset($_SERVER[$name] and $_SERVER[$name]])) {
        return trim($_SERVER[$name]);
    } else {
        return '';
    }
}
function trySESSION($name) {
    if (isset($_SESSION[$name] and $_SESSION[$name]])) {
        return trim($_SESSION[$name]);
    } else {
        return '';
    }
}



