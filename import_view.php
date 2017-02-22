<?php
$pagetitle = "import";
require('top.php');
?>

<h1>Choose campaign to import:</h1>

<?php
    $users = $model->getUsers();
    foreach ($users as $user) {
        if ($user->campaigns) {
            foreach ($user->campaigns as $camp) {
                echo '<h2><a href="import.php?importto='.$importto.'&importfrom='.$camp->id.'">'.
                      htmlspecialchars($camp->title)."(".$user->username.")</a></h2>\r\n";
                echo '<div>'.htmlspecialchars($camp->seed_text).'</div>';
                echo "\r\n\r\n";
            }
        }
    }
?>

</body>
</html>