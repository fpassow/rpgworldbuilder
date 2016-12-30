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
        if (isset($_SESSION['isloggedin']) and $_SESSION['isloggedin']) {
            echo '<a href="campaign.php">[[[[Create a World]]]]</a> <a href="logout.php">logout</a>';
        } else {
            echo '<a href="login.php">login</a> <a href="createaccount.php">create account</a>';
        }
    ?>
</div>

<h1>Worlds</h1>

<?php

    foreach ($users as $user) {
        if ($user->campaigns) {
            foreach ($user->campaigns as $camp) {
                echo '<h2><a href="campaign.php?campaignid='.$camp->id.'">'.
                      $camp>title."(".$user->username.")</a></h2>\r\n";
                echo '<p>'.$camp->seed_text."</p>\r\n\r\n";
            }
        }
    }
?>

</body>
</html>