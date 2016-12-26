<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Campaign Tool</title>
<link rel="stylesheet" type="text/css" href="campaign.css">
</head>
<body>

<div id="main">
<div id="nav">
    <?php
        if (!$_SESSION['isloggedin']) {
            echo '<a href="logout.php">logout</a>';
        } else {
            echo '<a href="login.php">login</a> <a href="createaccount.php">create account</a>';
        }
    ?>
</div>

<h1>Worlds</h1>

<?php

    foreach ($users as $user) {
        echo '<h2><a href="campaign.php?campaignid='.$user->campaign->id.'">'.
           $user->campaign->title."(".$user->username.")</a></h2>\r\n";
        echo '<p>'.$user->campaign->seed_text."</p>\r\n\r\n";
    }
?>

</body>
</html>