<?php

#Display a page defining a term from a DefList in the Lists object
# Params: name = name of list  &  index = position in list

if (session_status() == PHP_SESSION_NONE){
    session_start();
}

require_once('model.php');
$model = new Model;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    echo "Expected GET.";
    return;
}


if (!isset($_GET['name'])) {
    $message = 'Missing id parameter.';
    require('status401.php');
    return;
}
if (!isset($_GET['index'])) {
    $message = 'Missing id parameter.';
    require('status401.php');
    return;
}


#?name='.$name.'&index='.$index.'


$name = $_GET['name'];
$index = $_GET['index'];
$field = false;
if ($name) {
    foreach ($model->def->fields as $f) {
        if ($f->name == $name) {
            $field = $f;
            break;
        }
    }
}
        
if (!$field) {
    $message = 'Field "'.$name.' does not exist.';
    require('status404.php');
    return; 
}
$index = intval($index);
if (!isset($field->hints[$index])) {
    $message = 'Index "'.$index.' does not exist in list '.$name.'.';
    require('status404.php');
    return;  
}
$term = $field->hints[$index]->label;
$def = $field->hints[$index]->description;

require('listdef_view.php');

