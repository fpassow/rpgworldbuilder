<?php

# Data is stored as serialized User objects (which contain Campaign objects).
# Assume it will migrate to MongoDB (or ?) before it has to handle much real load.
#   So compatibility with the eventual persistence layer is more important than efficiency today.
class Model {
    
    function __construct() {
        $this->settings = parse_ini_file('SETTINGS.txt');
        $this->data_dir = $this->settings['data_dir'].'/';
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
#     label
#     description:
# }
#    
        $this->def = json_decode(file_get_contents('campaign_form_def.json'));
    }
    
    function getDef() {
        return $this->def;
    }
    
    # Returns array of strings
    function getUserNames() {
        $userFiles = scandir($this->data_dir.'users');
        $userNames = [];
        foreach ($userFiles as $f) {
            if (substr($f, 0, 5) === 'user_') {
                $userNames[] = rtrim(ltrim($f, 'user_'), '.txt');
            }
        }
        return $userNames;
    }
    
    # Returns a User object (with all its Campaign objects)
    function getUser($username) {
        if (file_exists($this->data_dir.'users/user_'.$username.'.txt')) {
            return unserialize(file_get_contents($this->data_dir.'users\user_'.$username.'.txt')); 
        } else {
            return null;
        }
    }
    
    #Returns all user objects
    function getUsers() {
        $userNames = $this->getUserNames();
        $users = [];
        foreach ($userNames as $n) {
            $u = $this->getUser($n);
            if ($n) {
                $users[] = $u;
            }
        }
        return $users;
    }
    
    function getCampaignByID($id) {
        $id = trim($id);
        $users = $this->getUsers();
        foreach ($users as $user) {
            foreach ($user->campaigns as $campaign) {
                if ($campaign->id == $id) {
                    return $campaign;
                }
            }
        }
        return null;
    }
    
    # Takes a User object and stores it on disk
    function storeUser($user) {
        $f = fopen($this->data_dir.'users\\user_'.$user->username.'.txt', 'w');
        fwrite($f, serialize($user));
        fclose($f);
    }
}

class User {
    var $username;
    var $password;
    var $campaigns = [];
    
    # Replace existing version of campaign with a new one
    function updateCampaign($campaign) {
        for ($i = 0; $i < sizeof($this->campaigns); $i++) {
            if ($campaign->id == $this->campaigns[$i]->id) {
                $this->campaigns[$i] = $campaign;
                return;
            }
        }
        #If we get here, we didn't find it.
        $message = "Attempting to update non-existent Campaign. ID = ".$campaign->id;
        require('status400.php');
    }
    
    function deleteCampaign($deleteid) {
        for ($i = 0; $i < sizeof($this->campaigns); $i++) {
            if ($this->campaigns[$i]->id == $deleteid) {
                array_splice($this->campaigns, $i, 1);
                return;
            }
        }
    }
    
}

class Campaign {
    
    function __construct($username) {
        $this->id = uniqid();
        $this->username = $username;
    }
    
    var $id;
    var $username;
         
    var $title = '';
    var $seed_text = '';
    var $pcs_are = '';
    var $players_intro = '';
    var $pc_creation_notes = '';
    var $mood = "";
    var $visual_style = "";
        
    var $scene = [];
    var $driver = [];
    var $place = [];
    var $group= [];
    var $person = [];
    var $character_class = [];
    var $toy = [];
    var $treasure = [];
    var $adventure = [];
    var $first_adventure = [];
    
    function deleteItem($name, $index) {
        $arr = $this->$name;
        array_splice($arr, $index, 1);
        $this->$name = $arr;
    }
  
    function updateFromArray($arr, $fields) {
        foreach ($fields as $field) {
            $fieldName = $field->name;
            if ($field->isarrayfield) {
                if (isset($arr[$fieldName]) and (null !== $arr[$fieldName]) and strlen(trim($arr[$fieldName]))) {
                    $x = $this->$fieldName;
                    $x[] = $arr[$fieldName];
                    $this->$fieldName = $x;
                } 
            } else {
                if (isset($arr[$fieldName]) and (null !== $arr[$fieldName]) and strlen(trim($arr[$fieldName]))) {
                    $this->$fieldName = $arr[$fieldName];
                }
            }
        }
    }
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

