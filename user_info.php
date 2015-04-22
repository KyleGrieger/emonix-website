<?php
$link = mysql_connect('localhost','root','699.tmp');
if(!$link) {
   die('Could not connect:'.mysql_error());
}
echo 'Connected Succesfully';
mysql_close($link);
?>
