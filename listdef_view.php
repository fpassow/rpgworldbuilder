<?php
$pagetitle = "drivers: $term";
require('top.php');
?>

<div class="optionsbox">
<?php
    displayDefListAsTable('drivers', $lists, 3, '_self');
?>
</div>

<h2><?= $term ?></h2>
<h2>How it works:</h2>
<p><?= $def ?>
