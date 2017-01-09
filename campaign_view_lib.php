<?php

function displayArrayField($campaign, $name) {
    echo "<ul>\r\n";
    $i = 0;
    foreach ($campaign->$name as $x) {
        echo '<li>'.$x;
        echo '(<a href="deletearrayitem.php?campaignid='.$campaign->id
                  .'&fieldname='.$name.'&index='. $i++;
        echo '">delete</a>)</li>'."\r\n";
    }
    echo "</ul>\r\n";
}

/*
function displayArrayField($campaign, $name) {
    $i = 0;
    foreach ($campaign->$name as $x) {
        echo '<div class="array_item">'.$x;
        echo '(<a href="deletearrayitem.php?campaignid='.$campaign->id
                  .'&fieldname='.$name.'&index='. $i++;
        echo '">delete</a>)</div>'."\r\n";
    }
} 
*/
