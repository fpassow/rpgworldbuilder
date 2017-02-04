<?php

# JSON format:
#
# FORM_DEF = {
#     name:
#     label:
#     description:
#     fields: [FIELD, FIELD...]
# }
# 
# FIELD = {
#     name:
#     label:
#     description:
#     isarrayfield: true|false
#     hints: [HINT, HINT,...]
# }
# 
# HINT = {
#     name:
#     text:
#     description: <-- optional
# }
#     

class Campaign {
  
 
    var $simpleFields = ['title','seed_text','pcs_are','players_intro','pc_creation_notes'];
      
    var $title = '';
    var $seed_text = '';
    var $pcs_are = '';
    var $players_intro = '';
    var $pc_creation_notes = '';
    
    var $arrayFields = ['driver','place','person_group_thing','character_class','toy','treasure',
                       'adventure','first_adventure'];
    
    var $driver = [];
    var $place = [];
    var $person_group_thing = [];
    var $character_class = [];
    var $toy = [];
    var $treasure = [];
    var $adventure = [];
    var $first_adventure = [];
}


#Source of lists of options and ideas
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
                #Remove utf-8 byte order mark, if present.
                if (substr($x, 0, 3) === chr(239).chr(187).chr(191)) {
                    $x = substr($x, 3);
                }
                $x = trim($x);
                if (strlen($x)) {
                    if (0 === strpos($x, '#')) {
                        if (isset($pair[0])) {
                            $list[] = $pair;
                        }
                        $pair = [];
                        $pair[0] = trim(substr($x, 1));
                    } else {
                        if (isset($pair[0]) and isset($pair[1])) {
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

