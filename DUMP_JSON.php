<?php

    require('model.php');
    $model = new Model;
    
    $users = $model->getUsers();
    foreach ($users as $user) {
        if ($user->campaigns) {
            foreach ($user->campaigns as $camp) {
                echo "{\r\n";
                for ($i = 0; $i < sizeof($camp->simpleFields)-1; $i++) {
                    $fname = $camp->simpleFields[$i];
                    echo '  "'.$fname.'": "'.$camp->$fname.'",'."\r\n";
                }
                if (sizeof($camp->simpleFields)) {
                    #Like above, but without the final comma.
                    $i = sizeof($camp->simpleFields)-1;
                    $fname = $camp->simpleFields[$i];
                    echo '  "'.$fname.'": "'.$camp->$fname.'"'."\r\n";
                }
                foreach ($camp->arrayFields as $sf) {
                    
                }
                echo "}\r\n";
            }
        }
    }
?>
