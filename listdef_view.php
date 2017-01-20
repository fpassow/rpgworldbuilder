<?php
require('top.php');
?>

<div class="optionsbox">
<?php
    displayDefListAsTable('drivers', $lists, 3, '_self');
?>
</div>

<h2><?= $term ?></h2>
<p><?= $def ?>
