<?php
$pagetitle = "home";
require('top.php');
?>

<h1>Campaigns</h1>

<?php
    $users = $model->getUsers();
    foreach ($users as $user) {
        if ($user->campaigns) {
            foreach ($user->campaigns as $camp) {
                echo '<h2><a href="campaign.php?id='.$camp->id.'">'.
                      $camp->title."(".$user->username.")</a></h2>\r\n";
                echo '<div>'.$camp->seed_text.'</div>';
                if ($isloggedin) {
                    echo '<div class="camp_controls"> <a href="clone.php?id='.$camp->id.'">(clone)</a></div>';
                }
                echo "\r\n\r\n";
            }
        }
    }
?>

</body>
</html>