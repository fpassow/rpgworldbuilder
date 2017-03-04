<?php

$pagetitle = $campaign->title;
require('top.php');

echo '<div class="special_nav">';
echo '<a href="import.php?importto='.$campaign->id.'">Import another campaign</a> ';
echo '<a href="delete.php?deleteid='.$campaign->id.'">Delete this campaign</a> ';
echo '</div>';
?>
<script src="campaign_view.js"></script>

<form action="updatecampaign.php" method="POST">
<input type="hidden" name="id" value="<?= $campaign->id ?>">
<input type="hidden" name="focus_here" id="focus_here" value="<?= htmlspecialchars($focus_here) ?>">
<input type="submit" value="SAVE" class="submit_button">

<div id="campaign_fields"></div>

<br><br><input type="submit" value="SAVE"  class="submit_button">

</form>

</div> <!-- End #main -->

</body>
</html>