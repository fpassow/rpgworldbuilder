<?php
$pagetitle = "login";
require('top.php');

if (isset($message)) {
    echo '<div class="message">'.$message.'</div>';
}
?>

<form action="login.php" method="POST">

<h2>User Name</h2>
<input name="username">

<h2>Password</h2>
<input type="password" name="password">

<br><br><input type="submit">
</form>

</div> <!-- End #main -->

</body>
</html>