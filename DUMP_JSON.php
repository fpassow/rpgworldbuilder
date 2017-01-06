<?php

    require('model.php');
    $model = new Model;
    
    function printArrayElements($arr) {
        $prelim = "[\r\n";
        foreach ($arr as $a) {
            echo $prelim.'"'.$a.'"';
            $prelim = ",\r\n";
        }
        echo "]\r\n";
    }
    
    $users = $model->getUsers();
    foreach ($users as $user) {
        if ($user->campaigns) {
            foreach ($user->campaigns as $camp) {
                echo "{\r\n";
                $names = $camp->simpleFields;
                while (sizeof($names) > 1) {
                    $name = array_shift($names);
                    echo '  "'.$name.'": "'.$camp->$name.'",'."\r\n";
                }
                if (sizeof($names)) {
                    $name = array_shift($names);
                    #Like above, but without the final comma.
                    echo '  "'.$name.'": "'.$camp->$name.'"'."\r\n";
                }
                
                $names = $camp->arrayFields;
                while (sizeof($names) > 1) {
                    $name = array_shift($names);
                    echo '  "'.$name.'": ';
                    printArrayElements($camp->$name); 
                    echo ",\r\n";
                }
                if (sizeof($names)) {
                    $name = array_shift($names);
                    #Like above, but without the final comma.
                    echo '  "'.$name.'": ';
                    printArrayElements($camp->$name);
                }
            }
            echo "}\r\n";
        }
    }
?>
