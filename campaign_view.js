$(document).ready(function() {
 
     //Get the id of the last field changed, 
     //and set it on an input going to the server.
     $("input, textarea").change(function(event) {
        $("#focus_here").val(event.target.id);
        $("form")[0].submit();
    });
        
    //Take the id to focus on coming from the server, and focus there.
    $('#' + $('#focus_here').val() ).focus();
 
});