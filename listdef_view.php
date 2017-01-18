<?php

# Expects $campaign, and a logged in session.
require_once('view_lib.php');
?>
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
    require('topnav.php');
?>

<div class="optionsbox">
<?php
    displayDefListAsTable('drivers', $lists, 3, '_self');
?>
</div>

<h2><?= $term ?></h2>
<p><?= $def ?>
