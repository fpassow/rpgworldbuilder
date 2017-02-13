<?php
$pagetitle = $campaign->title;
require('top.php');

echo '<div>By '.$campaign->username."</div>\r\n";

$fields = $model->getDef()->fields;
foreach ($fields as $field) {
    echo '<h2>'.$field->label."</h2>\r\n";
    $name = $field->name;
    if ($field->isarrayfield) {
        foreach ($campaign->$name as $x) {
            echo '<div class="array_item">'.htmlspecialchars($x).'</div>'."\r\n";
        }
    } else {
        echo '<div>'.htmlspecialchars($campaign->$name)."</div>\r\n";
    }  
}
?>

</div> <!-- End #main -->

</body>
</html>