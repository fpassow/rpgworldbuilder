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
    <a href="login.php">login</a>
    <a href="createaccount.php">create account</a>
</div>

<h1>Worlds</h1>

<?php

    foreach ($users as $user) {
        echo '<h2>'.$user->campaign->title."</h2>\r\n";
        echo '<p>'.$user->campaign->seed_text."</p>\r\n\r\n";
    }
?>

</body>
</html>