<?php

require('model.php');

$model = new Model;
$u = $model->getUser('me');
var_dump($u);

?>