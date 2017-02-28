<!DOCTYPE html>
<html>
<head>
<?php 
require_once('view_lib.php');
?>
<meta charset="UTF-8">
<title>rpgworldbuilder: <?= $pagetitle ?></title>
<link rel="stylesheet" type="text/css" href="campaign.css">
<script src="js/jquery-3.1.1.min.js"></script>
</head>
<body>

<div id="main">

<div id="topnav">
    <div id="workingnav">
        <a href="home.php">Home</a>
        <a href="campaignlist.php">Campaigns</a>
        <a href="mycampaigns.php">My Campaigns</a>
        <a href="newcampaign.php">New Campaign</a>
    </div>
    <div id="accountnav">
        <?php if (!$user->isguest) {  ?>
            Logged in as <a href="mycampaigns.php"><b><?= $username ?></b></a>
            <a href="logout.php">Logout</a>
            <a href="login.php">Change user</a>
        <?php } else { ?>
            <a href="login.php">Log in</a>
        <?php } ?>
        <a href="newuser.php">New User</a> 
    </div>
</div>
