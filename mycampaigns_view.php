<?php
$pagetitle = " my campaigns";
require('top.php');
?>

<h1>My Campaigns</h1>
<div class="special_nav">
<a href="change_password.php">Change password</a>
</div>

<?php
    if ($user->campaigns) {
        foreach ($user->campaigns as $camp) {
            echo '<h2><a href="campaign.php?id='.$camp->id.'">'.
                  htmlspecialchars($camp->title)."(".$user->username.")</a></h2>\r\n";
            echo '<div>'.htmlspecialchars($camp->seed_text).'</div>';            echo '<div class="camp_controls"> <a href="clone.php?id='.$camp->id.'">(clone)</a></div>';
            echo "\r\n\r\n";
        }
    } else {
        echo "This user has no campaigns.";
    }
?>

</body>
</html>