<?php


function logg($str) {
    $f = fopen('../../rpgworldbuilder/log/log.txt', 'a');
    fwrite($f, date('Y-m-d H:i:s').' '.$str."\r\n");
    fclose($f);
}

$x = json_decode(file_get_contents('php://input'));
logg($x->foo);
logg($x->bar);
logg("--------------------");
