<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Campaign Tool</title>
<link rel="stylesheet" type="text/css" href="campaign.css">
</head>
<body>

<div id="main">

<?php
    require('list_lib.php');
    $lists = new Lists;
    
    var_dump($lists->getDefList('drivers')); return;
    
    
    $simpleLists = ['adventures', 'toys', 'treasure', 'whos'];
    $defLists = ['drivers'];
    
    foreach ($simpleLists as $name) {
        echo '<h2>'.$name.'</h2><ul>'."\r\n";
        foreach ($lists->getList($name) as $x) {
            echo '<li>'.$x.'</li>'."\r\n";
        }
        echo '</ul>'."\r\n";
    }
        
    foreach ($defLists as $name) {
        echo '<h2>'.$name.'</h2><dl>'."\r\n";
        foreach ($lists->getDefList($name) as $x) {
            echo '<dt>'.$x[0].'</dt><dd>'.$x[1].'</dd>'."\r\n";
        }
        echo '</dl>'."\r\n";
    }  
        
        
    
    
    