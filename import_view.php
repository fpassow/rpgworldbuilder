<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Campaign Tool</title>
<link rel="stylesheet" type="text/css" href="campaign.css">
</head>
<body>

<div id="main">

<h1>Choose campaign to import:</h1>

<?php
    $users = $model->getUsers();
    foreach ($users as $user) {
        if ($user->campaigns) {
            foreach ($user->campaigns as $camp) {
                echo '<h2><a href="import.php?importto='.$_GET['importto'].'&importfrom='.$camp->id.'">'.
                      $camp->title."(".$user->username.")</a></h2>\r\n";
                echo '<div>'.$camp->seed_text.'</div>';
                echo "\r\n\r\n";
            }
        }
    }
?>

</body>
</html>