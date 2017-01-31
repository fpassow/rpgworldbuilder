<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>temp</title>
<link rel="stylesheet" type="text/css" href="campaign.css">
<script src="js/jquery-3.1.1.min.js"></script>
</head>
<body>

<div id="main">

<form name="bob" id="id_bob" method="POST" action="dump.php">
<input name="fred">
<input name="dave">
<button type="button" id="bobthebutton">Click Me!</button>
<input name="sam" type="submit">
</form>

<script>
/*document.getElementById("bobthebutton").onclick = function() {
    document.getElementById("id_bob").submit();
};*/

$(document).ready(function() {
 
     $("input, textarea").change(function(event) {
        $("form")[0].submit();
    });
 
});

</script>

</div>

</body>
</html>