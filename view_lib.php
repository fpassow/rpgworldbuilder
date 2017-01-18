<?php

#Display current values plus a form field for editing something on a campaign
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

#Display current values plus a form field for editing something on a campaign
function displayOrderedArrayField($campaign, $name) {
    echo "<ol>\r\n";
    $i = 0;
    foreach ($campaign->$name as $x) {
        echo '<li>'.$x;
        echo '(<a href="deletearrayitem.php?campaignid='.$campaign->id
                  .'&fieldname='.$name.'&index='. $i++;
        echo '">delete</a>)</li>'."\r\n";
    }
    echo '<li><input name="'.$name.'"></li>'."\r\n";
    echo "</ol>\r\n";
    echo '<input type="submit">'."\r\n";
}

#Display a static list of ideas for the user to look at while creating a campaign
function displayList($name, $lists) {
    echo '<div>';
    foreach ($lists->getList($name) as $x) {
        echo '<span class="listyclass">'.$x.'</span> ';
    }
    echo "</div>\r\n";
}

#Display a static list of ideas for the user to look at while creating a campaign
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
#Display a static list of ideas for the user to look at while creating a campaign
# plus links to more information about each.
function displayDefListAsTable($name, $lists, $columns, $target) {
    echo '<table><tr><td>';
    $this_list = $lists->getDefList($name);
    $per_col = intval(sizeof($this_list) / $columns);
    $index = 0;
    $count = 0;
    foreach ($this_list as $x) {
        echo '<a target="'.$target.'" href="listdef.php?name='.$name.'&index='.$index.'">'.$x[0].'<a><br>';
        if ($count++ == $per_col) {
            echo "\r\n</td><td>";
            $count = 0;
        }
        $index++;
    }
    echo "</td></tr></table>\r\n";  
}