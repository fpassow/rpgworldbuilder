<?php
$pagetitle = $campaign->title;
require('top.php');

if (!isset($is_new_campaign) or !$is_new_campaign) {
    echo '<div>';
    echo '<a href="import.php?importto='.$campaign->id.'">Import another campaign</a> ';
    echo ' &nbsp; &nbsp; <a href="delete.php?deleteid='.$campaign->id.'">Delete this campaign</a> ';
    echo '</div>';
}
?>
<script src="campaign_view.js"></script>

<form action="updatecampaign.php" method="POST">
<input type="hidden" name="id" value="<?= $campaign->id ?>">
<input type="hidden" name="focus_here" id="focus_here" value="<?= $focus_here ?>">

<?php
foreach ($model->def->fields as $field) {
    $fieldname = $field->name;
    echo '<h2>'.$field->label."</h2>\r\n";
    echo '<div class="instructions">'.$field->instructions."</div>\r\n";
    displayDefListAsTable($field, 4, '_blank');
    if ($field->isarrayfield) {
        displayArrayField($campaign, $fieldname);
    } else {
        if ($field->longtext) {
            echo '<textarea name="'.$fieldname.'" id="'.$fieldname.'" rows="5" cols="80">'.$campaign->$fieldname.'</textarea>'."\r\n";
        } else {
            echo '<input name="'.$fieldname.'" id="'.$fieldname.'" value="'.$campaign->$fieldname.'"></input>'."\r\n";
        }
    }
}


####################################
/*

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
<textarea name="pcs_are" id="pcs_are" rows="5" cols="80"><?= $campaign->pcs_are ?></textarea>

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
?>

<h2>Classes (fun to be...)</h2>
<?php
    displayArrayField($campaign, 'character_class');
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
<textarea name="players_intro" id="players_intro" rows="5" cols="80"><?= $campaign->players_intro ?></textarea>

<h2>PC Creation Notes (how to start talking about creating fun characters)</h2>
<textarea name="pc_creation_notes" id="pc_creation_notes" rows="5" cols="80"><?= $campaign->pc_creation_notes ?></textarea>

<h2>First five adventures, in order</h2>
<?php
    displayArrayField($campaign, 'first_adventure');
?>

*/
####################################################################
?>

<br><br><input type="submit" value="SAVE">

</form>

</div> <!-- End #main -->

</body>
</html>