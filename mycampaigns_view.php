<?php
require('top.php');
?>

<h1>My Campaigns</h1>

<?php
    if ($user->campaigns) {
        foreach ($user->campaigns as $camp) {
            echo '<h2><a href="campaign.php?id='.$camp->id.'">'.
                  $camp->title."(".$user->username.")</a></h2>\r\n";
            echo '<div>'.$camp->seed_text.'</div>';
            if ($model->isloggedIn()) {
                echo '<div class="camp_controls"> <a href="clone.php?id='.$camp->id.'">(clone)</a></div>';
            }
            echo "\r\n\r\n";
        }
    } else {
        echo "This user has no campaigns.";
    }
?>

</body>
</html>