<?php
$pagetitle = $campaign->title;
require('top.php');
?>

<h2><?= $campaign->title ?></h2>
<div>By <?= $campaign->username ?></div>

<p><?= $campaign->seed_text ?></p>

<h2>Campaign Drivers</h2>
<?php
    foreach ($campaign->driver as $d) {
        echo '<div class="array_item">'.$d.'</div>'."\r\n";
    }
?>

<h2>Places</h2>
<?php
    foreach ($campaign->place as $p) {
        echo '<div class="array_item">'.$p.'</div>'."\r\n";
    }
?>

<h2>PCs are....</h2>
<p><?= $campaign->pcs_are ?></p>

<h2>People, Groups, and Things</h2>
<?php
    foreach ($campaign->person_group_thing as $x) {
        echo '<div class="array_item">'.$x.'</div>'."\r\n";
    }
?>

<h2>Adventures</h2>
<?php
    foreach ($campaign->adventure as $x) {
        echo '<div class="array_item">'.$x.'</div>'."\r\n";
    }
?>

<h2>Classes</h2>
<?php
    foreach ($campaign->character_class as $x) {
        echo '<div class="array_item">'.$x.'</div>'."\r\n";
    }
?>

<h2>Toys</h2>
<?php
    foreach ($campaign->toy as $x) {
        echo '<div class="array_item">'.$x.'</div>'."\r\n";
    }
?>

<h2>Treasure</h2>
<?php
    foreach ($campaign->treasure as $x) {
        echo '<div class="array_item">'.$x.'</div>'."\r\n";
    }
?>

<h2>Players' Intro</h2>
<p><?= $campaign->players_intro ?></p>

<h2>PC Creation Notes</h2>
<p><?= $campaign->pc_creation_notes ?></p>

<h2>First Adventures</h2>
<?php
    foreach ($campaign->first_adventure as $x) {
        echo '<div class="array_item">'.$x.'</div>'."\r\n";
    }
?>

</div> <!-- End #main -->

</body>
</html>