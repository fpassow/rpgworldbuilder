<html><body><pre>
<?php


echo "METHOD: ".$_SERVER['REQUEST_METHOD']."\r\n\r\n";

echo "GET\r\n";
var_dump($_GET);

echo "\r\n\r\nPOST\r\n";
var_dump($_POST);

echo "\r\n\r\nSERVER\r\n";
var_dump($_SERVER);

?>
</pre></body></html>
