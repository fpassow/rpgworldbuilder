<?php 
# Set up the model and other request processing tools

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
    $username = $_SESSION['username'];
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



