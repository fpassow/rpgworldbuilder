<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Campaign Tool</title>
<link rel="stylesheet" type="text/css" href="campaign.css">
</head>
<body>

<div id="main">

<div id="topnav">
    <a href="home.php">Home</a>
    <?php
    
        require('view_lib.php');
        $lists = new Lists;
        
        if (isset($_SESSION['isloggedin']) and $_SESSION['isloggedin']) {
            echo '<a href="mycampaigns.php">My Campaigns</a> ';
            echo '<a href="newcampaign.php">New Campaign</a> ';
            echo ' <div id="toprightnav"><a href="logout.php">Logout</a> ';
            echo 'Logged in as <b>'.$_SESSION['username'].'</b>';
        } else {
            echo '<div id="toprightnav"> <a href="login.php">Login</a> <a href="newuser.php">New User</a> ';
        }
    ?>
    </div>
</div>
