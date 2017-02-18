<?php
$pagetitle = "login";
require('top.php');

if (isset($message)) {
    echo '<div class="message">'.$message.'</div>';
}
?>

<form action="login.php" method="POST">

<h2>Change password for <?= $username ?></h2>

<h2>Old password</h2>
<input type="password" name="password">

<h2>Newew password</h2>
<input type="password" name="password1">

<h2>Confirm new password</h2>
<input type="password" name="password2">


<br><br><input type="submit">
</form>

</div> <!-- End #main -->

</body>
</html>