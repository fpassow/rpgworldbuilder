<?php

#Display current values plus a form field for editing something on a campaign
function displayArrayField($campaign, $name) {
    echo "<ul>\r\n";
    $i = 0;
    foreach ($campaign->$name as $x) {
        echo '<li>'.htmlspecialchars($x);
        echo '(<a href="deletearrayitem.php?campaignid='.$campaign->id
                  .'&fieldname='.$name.'&index='. $i++;
        echo '">delete</a>)</li>'."\r\n";
    }
    echo '<li><input name="'.$name.'" id="'.$name.'"></li>'."\r\n";
    echo '<li><input type="submit" name="add_'.$name.'" value="+" class="submit_button"></li>'."\r\n";
    echo "</ul>\r\n";
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
function displayDefListAsTable($field, $columns, $target) {
    if (isset($field->hints) and count($field->hints)) {
        echo '<div class="deflist"><table><tr><td>';
        $per_col = intval(count($field->hints) / $columns);
        $index = 0;
        $count = 0;
        $fieldName = $field->name;
        foreach ($field->hints as $hint) {
            if (isset($hint->description) and strlen($hint->description)) {
                echo '<a target="'.$target.'" href="listdef.php?name='.$fieldName.'&index='.$index.'">'.$hint->label.'<a><br>';
            } else {
                echo $hint->label.'<br>';
            }
            if ($count++ == $per_col) {
                echo "\r\n</td><td>";
                $count = 0;
            }
            $index++;
        }
        echo "</td></tr></table></div>\r\n"; 
    }        
}


function nextFocus($lastFocus, $def) {
    $fields = $def->fields;
    for ($i= 0; $i < sizeof($fields); $i++) {
        $field = $fields[$i];
        if ($field->name == $lastFocus) {
            if ($field->isarrayfield) {
                return $lastFocus;
            } else {
                if ($i+1 < sizeof($fields)) {
                    $field = $fields[$i + 1];
                    return $field->name;
                } else {
                    return $lastFocus;
                }
            }
        }
    }
    return $lastFocus;
}
