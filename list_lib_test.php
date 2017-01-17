<?php

require('list_lib.php');
$lists = new Lists;

$deflist = $lists->getDefList('drivers');

var_dump($deflist);
