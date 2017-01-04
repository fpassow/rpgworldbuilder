<?php

# Expects $campaign, and a logged in session.

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

<form action="updatecampaign.php" method="POST">
<input type="hidden" name="id" value="<?= $campaign->id ?>">

<h2>Title</h2>
<input name="title" value="<?= $campaign->title ?>">

<h2>Seed Text</h2>
<textarea name="seed_text" rows="5" cols="80"><?= $campaign->seed_text ?></textarea>

<h2>Campaign Drivers</h2>
<p>List-y thing goes here.</p>
<?php
    foreach ($campaign->driver as $d) {
        echo '<div class="array_item">'.$d.'</div>'."\r\n";
    }
?>
<textarea name="driver" rows="5" cols="80"></textarea>

<h2>Places</h2>
<?php
    foreach ($campaign->place as $p) {
        echo '<div class="array_item">'.$p.'</div>'."\r\n";
    }
?>
<textarea name="place" rows="5" cols="80"></textarea>

<h2>PCs are....</h2>
<textarea name="pcs_are" rows="5" cols="80"><?= $campaign->pcs_are ?></textarea>

<h2>People, Groups, and Things</h2>
<?php
    foreach ($campaign->person_group_thing as $x) {
        echo '<div class="array_item">'.$x.'</div>'."\r\n";
    }
?>
<textarea name="person_group_thing" rows="5" cols="80"></textarea>

<h2>Adventures</h2>
<?php
    foreach ($campaign->adventure as $x) {
        echo '<div class="array_item">'.$x.'</div>'."\r\n";
    }
?>
<textarea name="adventure" rows="5" cols="80"></textarea>

<h2>Classes</h2>
<?php
    foreach ($campaign->class as $x) {
        echo '<div class="array_item">'.$x.'</div>'."\r\n";
    }
?>
<textarea name="class" rows="5" cols="80"></textarea>

<h2>Toys</h2>
<?php
    foreach ($campaign->toy as $x) {
        echo '<div class="array_item">'.$x.'</div>'."\r\n";
    }
?>
<textarea name="toy" rows="5" cols="80"></textarea>

<h2>Treasure</h2>
<?php
    foreach ($campaign->treasure as $x) {
        echo '<div class="array_item">'.$x.'</div>'."\r\n";
    }
?>
<textarea name="treasure" rows="5" cols="80"></textarea>

<h2>Players' Intro</h2>
<textarea name="players_intro" rows="5" cols="80"><?= $campaign->players_intro ?></textarea>

<h2>PC Creation Notes</h2>
<textarea name="pc_creation_notes" rows="5" cols="80"><?= $campaign->pc_creation_notes ?></textarea>

<h2>First Adventures</h2>
<?php
    foreach ($campaign->first_adventure as $x) {
        echo '<div class="array_item">'.$x.'</div>'."\r\n";
    }
?>
<textarea name="first_adventure" rows="5" cols="80"></textarea>


<br><br><input type="submit">
</form>

</div> <!-- End #main -->

</body>
</html>