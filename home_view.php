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

<h1>Campaigns</h1>

<?php
    $users = $model->getUsers();
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