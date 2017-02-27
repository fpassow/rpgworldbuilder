<?php

$pagetitle = $campaign->title;
require('top.php');

echo '<div class="special_nav">';
echo '<a href="import.php?importto='.$campaign->id.'">Import another campaign</a> ';
echo ' &nbsp; &nbsp; <a href="delete.php?deleteid='.$campaign->id.'">Delete this campaign</a> ';
echo '</div>';
?>
<script src="campaign_view.js"></script>

<form action="updatecampaign.php" method="POST">
<input type="hidden" name="id" value="<?= $campaign->id ?>">
<input type="hidden" name="focus_here" id="focus_here" value="<?= htmlspecialchars(nextFocus($focus_here, $model->getDef())) ?>">
<input type="submit" value="SAVE" class="submit_button">

<?php
foreach ($model->def->fields as $field) {
    $fieldname = $field->name;
    echo '<h2>'.$field->label."</h2>\r\n";
    echo '<div class="instructions">'.$field->instructions."</div>\r\n";
    displayDefListAsTable($field, 4, 'def');
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

?>

<br><br><input type="submit" value="SAVE"  class="submit_button">

</form>

</div> <!-- End #main -->

</body>
</html>