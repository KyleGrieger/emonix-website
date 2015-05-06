<?php
header('Content-Type: application/csv');
header("Content-Disposition: attachment; filename=" . "nvparams_" . $_GET['devid'] . ".hex");
header('Pragma: no-cache');

echo "S1131C0000000000", $_GET['devid'], "000000000000000068";

?>
