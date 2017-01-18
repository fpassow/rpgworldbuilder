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
    require('view_lib.php');
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
<div class="optionsbox">
<?php
    displayDefListAsTable('drivers', $lists, 3, 'deftab');
?>
</div>
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

<h2>People, Groups, and Things in the World</h2>
<?php
   # It's a lot to read. And I think it dictracts more than it helps
   # displayListAsTable('whos', $lists, 4);
   
    displayArrayField($campaign, 'person_group_thing');
?>

<h2>Adventures (which kinds will work?)</h2>
<div class="optionsbox">
<?php
    displayListAsTable('adventures', $lists, 4);
?>
</div>
<?php
    displayArrayField($campaign, 'adventure');
?>f

<h2>Classes (fun to be...)</h2>
<?php
    displayArrayField($campaign, 'class');
?>

<h2>Toys (fun to use)</h2>
<div class="optionsbox">
<?php
    displayListAsTable('toys', $lists, 4);
?>
</div>
<?php
    displayArrayField($campaign, 'toy');
?>

<h2>Treasure (fun payoffs from adventures)</h2>
<div class="optionsbox">
<?php
    displayListAsTable('treasure', $lists, 4);
?>
</div>
<?php
    displayArrayField($campaign, 'treasure');
?>

<h2>Players' Intro (what you will tell them)</h2>
<textarea name="players_intro" rows="5" cols="80"><?= $campaign->players_intro ?></textarea>
<input type="submit">

<h2>PC Creation Notes (how to start talking about creating fun characters)</h2>
<textarea name="pc_creation_notes" rows="5" cols="80"><?= $campaign->pc_creation_notes ?></textarea>
<input type="submit">

<h2>First five adventures, in order</h2>
<?php
    displayOrderedArrayField($campaign, 'first_adventure');
?>

</form>

</div> <!-- End #main -->

</body>
</html>