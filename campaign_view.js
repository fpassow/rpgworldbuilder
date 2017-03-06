$(document).ready(function() {
  
    //Get Def json from server and build form
    $.getJSON( "campaign_form_def.json", {}, function(campaignDef) {
        $.getJSON( "campaign_data.php?id=" + $("#campaignid").val(), {}, function(campaignData) {
        for (var i = 0; i < campaignDef.fields.length; i++) {
                addField(campaignDef.fields[i], campaignData); 
            }
        });
    });
    

});

function addField(field, campaignData) {
    $("#campaign_fields")
        .append('<h2>' + field.label + '</h2>')
        .append('<div class="instructions">' + field.instructions + '</div>')
        .append(defListAsTable(field, 4, 'def'));
    if (field.isarrayfield) {
        $("#campaign_fields").append(displayArrayField(field, campaignData));
    } else {
        if (field.longtext) {
            $("#campaign_fields").append('<textarea name="' + field.name + '" id="' + field.name + '" rows="5" cols="80">' + escapeHtml(campaignData[field.name]) + '</textarea>' + "\r\n");
        } else {
            $("#campaign_fields").append('<input name="' + field.name + '" id="' + field.name + '" value="' + escapeHtml(campaignData[field.name]) + '"></input>' + "\r\n");
        }
    }
}


/* Returns the whole table as a string. */
function defListAsTable(field, columns, target) {
    var s = '';
    var per_col = Math.floor(field.hints.length / columns);
    var index = 0;
    var count = 0;
    var hint;
    if (field.hints && field.hints.length) {
        s += '<div class="deflist"><table><tr><td>';
        for (index = 0; index < field.hints.length; index++) {
            hint = field.hints[index];
            if (hint.description) {
                s += '<a target="' + target + '" href="listdef.php?name=' + field.name + '&index='+ index + '">' + hint.label +'<a><br>';
            } else {
                s += hint.label + '<br>';
            }
            if (count++ == per_col) {
                s += "\r\n</td><td>";
                count = 0;
            }
        }
        s += "</td></tr></table></div>\r\n"; 
    }
    return s;    
}

/* Returns a string */
function displayArrayField(field, campaign_data) {
    var s = "<ul>\r\n";
    var index = 0;
    var arr = campaign_data[field.name];
    for (index = 0; index < arr.length; index++) {
        s += '<li>' +escapeHtml(arr[index]);
        s += '(<a href="deletearrayitem.php?campaignid=' + campaign_data.id
                  + '&fieldname=' + field.name + '&index=' + index++;
        s += '">delete</a>)</li>' + "\r\n";
    }
    s += '<li><input name="' + field.name + '" id="' + field.name + '"></li>' + "\r\n";
    s += '<li><input type="submit" name="add_' + field.name + '" value="+" class="submit_button"></li>' + "\r\n";
    s += "</ul>\r\n";
    return s;
}

var entityMap = {
  '&': '&amp;',
  '<': '&lt;',
  '>': '&gt;',
  '"': '&quot;',
  "'": '&#39;',
  '/': '&#x2F;',
  '`': '&#x60;',
  '=': '&#x3D;'
};
function escapeHtml(string) {
  return String(string).replace(/[&<>"'`=\/]/g, function (s) {
    return entityMap[s];
  });
}