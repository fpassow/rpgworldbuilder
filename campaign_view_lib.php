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

function displayList($name, $lists) {
    echo '<div>';
    foreach ($lists->getList($name) as $x) {
        echo '<span class="listyclass">'.$x.'</span> ';
    }
    echo "</div>\r\n";
}

function displayListAsTable($name, $lists, $columns) {
    echo '<table><tr><td>';
    $this_list = $lists->getList($name);
    $per_col = intval(sizeof($this_list) / $columns);
    $count = 0;
    foreach ($this_list as $x) {
        echo $x.'<br>';
        if ($count++ == $per_col) {
            echo "\r\n</td><td>";
            $count = 0;
        }
    }
    
    echo "</td></tr></table>\r\n";  

}