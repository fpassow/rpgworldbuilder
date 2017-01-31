$(document).ready(function() {
 
     //Get the id of the last field changed, 
     //and set it on an input going to the server.
     $("input, textarea").change(function(event) {
        $("#focus_here").val(event.target.id);
        $("form")[0].submit();
    });
    
    var nextFocus = {
        title: 'seed_text',
        seed_text: 'driver',
        driver: 'driver',
        place: 'place',
        pcs_are: 'person_group_thing',
        person_group_thing: 'person_group_thing',
        adventure: 'adventure',
        character_class: 'character_class',
        toy: 'toy',
        treasure: 'treasure',
        players_intro: 'pc_creation_notes',
        pc_creation_notes: 'first_adventure',
        first_adventure: 'first_adventure'
    };
        
    //Take the id to focus on coming from the server, and focus there.
    $('#' + nextFocus[ $('#focus_here').val()] ).focus();
 
});