<?php
require('init.php');

#Display a page defining a term from a DefList in the Lists object
# Params: name = name of list  &  index = position in list

if ($method != 'GET') {
    echo "Expected GET.";
    exit;
}
$name = reqGET('name');
$index = reqGET('index');

$field = false;
foreach ($model->def->fields as $f) {
    if ($f->name == $name) {
        $field = $f;
        break;
    }
}   
if (!$field) {
    $message = 'Field "'.$name.' does not exist.';
    require('status404.php');
    exit; 
}
$index = intval($index);
if (!isset($field->hints[$index])) {
    $message = 'Index "'.$index.' does not exist in list '.$name.'.';
    require('status404.php');
    exit;  
}
$term = $field->hints[$index]->label;
$def = $field->hints[$index]->description;

require('listdef_view.php');
