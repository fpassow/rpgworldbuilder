<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Campaign Tool</title>
<link rel="stylesheet" type="text/css" href="campaign.css">
</head>
<body>

<div id="main">

<h1>Create Account</h1>

<p><?= $message ?>

<form action="createaccount.php" method="POST">

<h2>User Name</h2>
<input name="username">

<h2>Password</h2>
<input name="password">

<h2>Password again</h2>
<input name="password2">

<br><br><input type="submit">
</form>

</div> <!-- End #main -->

</body>
</html>