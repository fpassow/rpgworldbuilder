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
            echo ' &nbsp; &nbsp; <a href="mycampaigns.php">My Campaigns</a>';
            echo ' &nbsp; &nbsp; <a href="newcampaign.php">New Campaign</a> ';
            echo ' &nbsp; &nbsp; <div id="toprightnav"><a href="logout.php">Logout</a>';
            echo ' &nbsp; &nbsp; Logged in as <b>'.$_SESSION['username'].'</b>';
        } else {
            echo '<div id="toprightnav"> &nbsp; &nbsp; <a href="login.php">Login</a> &nbsp; <a href="newuser.php">New User</a> ';
        }
    ?>
    </div>
</div>
