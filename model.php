<?php

# Data is stored as serialized User objects (which contain Campaign objects).
# Assume it will migrate to MongoDB (or ?) before it has to handle much real load.
#   So compatibility with the eventual persistence layer is more important than efficiency today.
class Model {
    
    # Returns array of strings
    function getUserNames() {
        $userFiles = scandir('users');
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
        if (file_exists('users\user_'.$username.'.txt')) {
            return unserialize(file_get_contents('users\user_'.$username.'.txt')); 
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
        $f = fopen('users\\user_'.$user->username.'.txt', 'w');
        fwrite($f, serialize($user));
        fclose($f);
    }
    
    function isLoggedIn() {
        return isset($_SESSION['isloggedin']) and $_SESSION['isloggedin'];
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
    #### FUN BITS
    
    function __construct($username) {
        $this->id = uniqid();
        $this->username = $username;
    }
    
    var $id;
    var $username;
    
    var $simpleFields = ['title','seed_text','pcs_are','players_intro','pc_creation_notes'];
      
    var $title = '';
    var $seed_text = '';
    var $pcs_are = '';
    var $players_intro = '';
    var $pc_creation_notes = '';
    
    var $arrayFields = ['driver','place','person_group_thing','class','toy','treasure',
                       'adventure','first_adventure'];
    
    var $driver = [];
    var $place = [];
    var $person_group_thing = [];
    var $class = [];
    var $toy = [];
    var $treasure = [];
    var $adventure = [];
    var $first_adventure = [];
    
    function deleteItem($name, $index) {
        array_splice($this->$name, $index, 1);
    }
  
    function updateFromArray($arr) {
        foreach ($this->simpleFields as $fieldName) {
            if (isset($arr[$fieldName]) and (null !== $arr[$fieldName]) and strlen(trim($arr[$fieldName]))) {
                $this->$fieldName = $arr[$fieldName];
            }
        }
               
        if (isset($arr['driver']) and (null !== $arr['driver']) and strlen(trim($arr['driver']))) {
            $this->driver[] = $arr['driver'];
        }
        if (isset($arr['place']) and (null !== $arr['place']) and strlen(trim($arr['place']))) {
            $this->place[sizeof($this->place)] = $arr['place'];
        }
        if (isset($arr['person_group_thing']) and (null !== $arr['person_group_thing']) and strlen(trim($arr['person_group_thing']))) {
            $this->person_group_thing[sizeof($this->person_group_thing)] = $arr['person_group_thing'];
        }
        if (isset($arr['class']) and (null !== $arr['class']) and strlen(trim($arr['class']))) {
            $this->class[sizeof($this->class)] = $arr['class'];
        }
        if (isset($arr['toy']) and (null !== $arr['toy']) and strlen(trim($arr['toy']))) {
            $this->toy[sizeof($this->toy)] = $arr['toy'];
        }
        if (isset($arr['treasure']) and (null !== $arr['treasure']) and strlen(trim($arr['treasure']))) {
            $this->treasure[sizeof($this->treasure)] = $arr['treasure'];
        }
        if (isset($arr['adventure']) and (null !== $arr['adventure']) and strlen(trim($arr['adventure']))) {
            $this->adventure[sizeof($this->adventure)] = $arr['adventure'];
        }
        if (isset($arr['first_adventure']) and (null !== $arr['first_adventure']) and strlen(trim($arr['first_adventure']))) {
            $this->first_adventure[sizeof($this->first_adventure)] = $arr['first_adventure'];
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

