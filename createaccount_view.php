<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Campaign Tool</title>
<link rel="stylesheet" type="text/css" href="campaign.css">
</head>
<body>

<div id="main">

<h1>Create a New Account</h1>

<form action="createaccount.php" method="POST">

<?php
    if (isset($message)) {
        echo '<div class="message">'.$message.'</div>'."\r\n";
    }
?>

<h2>New Username</h2>
<input name="username">

<h2>New Password</h2>
<input name="password">

<h2>New Password, Again</h2>
<input name="password2">

<br><br><input type="submit">
</form>

</div> <!-- End #main -->

</body>
</html>