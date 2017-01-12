<?php

class Lists {
    
    function getList($name) {
        $list = [];
        if ($f = fopen('lists/'.$name.'.txt', 'r')) {
            while ($x = fgets($f)) {
                $x = trim($x);
                if (strlen($x)) {
                    $list[] = $x;
                }
            }
            fclose($f);
        }
        return $list;
    }
    
    # In the file, the item names are on lines prefixed by ">".
    # The definition is everything until the next ">" or EOF.
    function getDefList($name) {
        $list = [];
        $pair = [];
        if ($f = fopen('lists/'.$name.'.txt', 'r')) {
            while ($x = fgets($f)) {
                $x = trim($x);
                if (strlen($x)) {
                    if ($x[0] == '>') {
                        if ($pair) {
                            $list[] = $pair;
                        }
                        $pair = [];
                        $pair[0] = trim(substr($x, 1));
                    } else {
                        if (isset($pair[1])) {
                            $pair[1] = $pair[1].' '.$x;
                        } else {
                            $pair[1] = $x;
                        }
                    }
                }
            }
            fclose($f);
            if ($pair) {
                $list[] = $pair;
            }                
        }
        return $list;
    }
    
}
