<?php

class User {
    var $username;
    var $password;
    var $campaign;
}

class Campaign {
    #### FUN BITS
    
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
