<?php

ini_set('display_errors',1);

// SQL Server Settings
$dbserver = "127.0.0.1";
$dbusername = "root";
$dbpassword = "699.tmp" ;
$dbname = "emonix";

// Unbundle POSTed User Data from stringified JSON object
$user_email = $_POST['user_email'];

// MySQL Stuff
$dbc = new mysqli($dbserver,$dbusername,$dbpassword, $dbname) or die ("Error creating DB connection" . $dbc->errno . ": ". $dbc->error ."<BR>") ;

// Check if email exists in table
$sql = "SELECT email FROM users WHERE email = '$user_email'";
$result = $dbc->query($sql);

if ( $result->num_rows == 0 ) {
	echo "false";
} else {
	echo "true";
}
$dbc->close() ;
?>
