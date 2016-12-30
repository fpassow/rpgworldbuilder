<?php

# Data is stored as serialized User objects (which contain Campaign objects).
# Assume it will migrate to MongoDB (or ?) before it has to handle much real load.
#   So compatibility with the eventual persistence layer is more important than efficiency today.
class Model {
    
    # Returns array of strings
    function getUserNames() {
        $userFiles = scandir('users');
        array_splice($userFiles, 0, 2);# Remove "." and ".."
        $userNames = [];
        foreach ($userFiles as $f) {
            $userNames[] = rtrim(ltrim($f, 'user_'), '.txt');
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
        $users = getUsers();
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
    
}

class User {
    var $username;
    var $password;
    var $campaigns = [];
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
  
    function updateFromArray($arr) {
        foreach ($this->simpleFields as $fieldName) {
            if (isset($arr[$fieldName]) and (null !== $arr[$fieldName]) and strlen(trim($arr[$fieldName]))) {
                $this->$fieldName = $arr[$fieldName];
            }
        }
               
        if (isset($arr['driver']) and (null !== $arr['driver']) and strlen(trim($arr['driver']))) {
            $this->driver[sizeof($this->driver)] = $arr['driver'];
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
