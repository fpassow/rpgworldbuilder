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
    echo '<li><input name="'.$name.'"></li>'."\r\n";
    echo "</ul>\r\n";
    echo '<input type="submit">'."\r\n";
}
