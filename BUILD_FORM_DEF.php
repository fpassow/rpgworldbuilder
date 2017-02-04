<?php


# HINT = {
#     name:
#     text:
#     instructions: <-- optional
# }
#     
>?
{
    "name": "Campaign",
    "label": "Campaign",
    "instructions": "Use this form to expand an idea or inspiration into a playable RPG campaign.",
    "fields": [
        {
            "name": "title",
            "label": "Title",
            "instructions": "",
            "longtext": false,
            "isarrayfield": false,
            "hints": []            
        },
        {
            "name": "seed_text",
            "label": "Seed Text",
            "instructions": "Anything...",
            "longtext": true,
            "isarrayfield": false,
            "hints": []            
        },
        {
            "name": "mood",
            "label": "Mood",
            "instructions": "Grim, exciting, zany, lyrical, tactical, dream-like, happy, sad, desparate, exuberent, etc. How will the players feel?",
            "longtext": false,
            "isarrayfield": false,
            "hints": []            
        },
        {
            "name": "visual_style",
            "label": "Visual Style",
            "instructions": "How do you see it in your mind? Does it look like a favorite movie, comic, artist, etc.?",
            "longtext": false,
            "isarrayfield": false,
            "hints": []            
        }, 
        {
            "name": "scene",
            "label": "Scenes",
            "instructions": "Some scenes or events thay might happen in this world. They can be past or future, large or small. They don't even have to involve PCs."
            "longtext": false,
            "isarrayfield": true,
            "hints": []            
        },
        {
            "name": "driver",
            "label": "Drivers",
            "instructions": "These are pattens for writing playable adventures. Pick some and describe their parts and how they work in this case."
            "longtext": false,
            "isarrayfield": true,
            "hints": [************************************]            
        },
        {
            "name": "place",
            "label": "Places",
            "instructions": "Describe some places where the action happens. Anything from a cockpit to a continent."
            "longtext": false,
            "isarrayfield": true,
            "hints": []            
        },
        {
            "name": "group"
            "label": "Groups",
            "instructions": "",
            "longtext": false,
            "isarrayfield": true,
            "hints": [*********************************************]            
        },
        {
            "name": "person"
            "label": "People",
            "instructions": "",
            "longtext": false,
            "isarrayfield": false,
            "hints": []            
        },
        {
            "name": "pcs_are",
            "label": "The PCs are...",
            "instructions": "Write a few lines about who PCs are in all this.",
            "longtext": true,
            "isarrayfield": false,
            "hints": []            
        },
        {
            "name": "adventure",
            "label": "Adventures",
            "instructions": "How can you run some of these classic adventure types?"
            "longtext": false,
            "isarrayfield": true|false
            "hints": [******************************************]            
        },
        {
            "name": "character_class",
            "label": "Character Classes",
            "instructions": "Types of people, who they are, and what they do. (This is about the world. It's fine if they are not actually part of the rules.",
            "longtext": false,
            "isarrayfield": true,
            "hints": []            
        },
        {
            "name": "toy",
            "label": "Toys",
            "instructions": "Fun to use...",
            "longtext": false,
            "isarrayfield": true,
            "hints": [************************************]            
        },
        {
            "name": "treasure",
            "label": "Treasures",
            "instructions": "Rewards from successful adventures.",
            "longtext": false,
            "isarrayfield": true,
            "hints": [******************************************]            
        },
        {
            "name": "players_intro",
            "label": "Players' Introduction",
            "instructions": "Tell the players about the world",
            "longtext": true,
            "isarrayfield": false,
            "hints": []            
        },
        {
            "name": "pc_creation_notes",
            "label": "PC Creations Notes",
            "instructions": "Tell the players who they are, and who they can be.",
            "longtext": true,
            "isarrayfield": false,
            "hints": []            
        },
        {
            "name": "first_adventure",
            "label": "First Adventures",
            "instructions": "Sketch some adventures to draw the player into the world.",
            "longtext": true,
            "isarrayfield": true,
            "hints": []            
        }       
    ]
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

