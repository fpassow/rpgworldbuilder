<?php
$pagetitle = "drivers: $term";
require('top.php');
?>

<div class="optionsbox">
<?php
    displayDefListAsTable($field, 3, '_self');
?>
</div>

<h2><?= $term ?></h2>
<p><?= $def ?>
