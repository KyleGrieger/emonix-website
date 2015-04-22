<?php

#echo "Gas used = " . $_GET['gasused'] . " Gas price = " . $_GET['gasprice'];
$startdate = strtotime($_GET['startdate']) / 86400;
$enddate = strtotime($_GET['enddate']) / 86400 ;
$days = round($enddate-$startdate)+1;

echo ($_GET['gasused'] * $_GET['gasprice']) + $days * $_GET['distrocharge'];
?>
