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

<h1>My Campaigns</h1>

<?php
foreach ($user->campaigns as $camp) {
    echo '<div>'.$camp->title.'</div>';
}
?>

</div>
</body>
</html>
