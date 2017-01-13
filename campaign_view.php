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
    require('campaign_view_lib.php');
    require('list_lib.php');
    $lists = new Lists;
?>

<div>
    <a href="import.php?importto=<?= $campaign->id ?>">Import another campaign</a>
    <a href="delete.php?deleteid=<?= $campaign->id ?>">Delete this campaign</a>
</div>

<form action="updatecampaign.php" method="POST">
<input type="hidden" name="id" value="<?= $campaign->id ?>">

<h2>Title</h2>
<input name="title" value="<?= $campaign->title ?>">

<h2>Seed Text</h2>
<textarea name="seed_text" rows="5" cols="80"><?= $campaign->seed_text ?></textarea>

<h2>Campaign Drivers</h2>
<p>List-y thing goes here.</p>
<?php
    displayArrayField($campaign, 'driver');
?>

<h2>Places</h2>
<?php
    displayArrayField($campaign, 'place');
?>

<h2>PCs are....</h2>
<textarea name="pcs_are" rows="5" cols="80"><?= $campaign->pcs_are ?></textarea>
<input type="submit">

<h2>People, Groups, and Things</h2>
<?php
    displayListAsTable('whos', $lists, 4);
    displayArrayField($campaign, 'person_group_thing');
?>

<h2>Adventures</h2>
<?php
    displayArrayField($campaign, 'adventure');
?>

<h2>Classes</h2>
<?php
    displayArrayField($campaign, 'class');
?>

<h2>Toys</h2>
<?php
    displayArrayField($campaign, 'toy');
?>

<h2>Treasure</h2>
<?php
    displayArrayField($campaign, 'treasure');
?>

<h2>Players' Intro</h2>
<textarea name="players_intro" rows="5" cols="80"><?= $campaign->players_intro ?></textarea>
<input type="submit">

<h2>PC Creation Notes</h2>
<textarea name="pc_creation_notes" rows="5" cols="80"><?= $campaign->pc_creation_notes ?></textarea>
<input type="submit">

<h2>First Adventures</h2>
<?php
    displayArrayField($campaign, 'first_adventure');
?>

</form>

</div> <!-- End #main -->

</body>
</html>