<?php

$name = 'drivers';
$f = fopen('lists/'.$name.'.txt', 'r');
while ($x = fgets($f)) {
    echo 'Line: '.trim($x);
}
fclose($f);

