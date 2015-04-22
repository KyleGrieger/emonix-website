<?php

// SQL Server Settings
$dbserver = "127.0.0.1";
$dbusername = "root";
$dbpassword = "699.tmp" ;
$dbname = "emonix";

// Unbundle POSTed User Data from stringified JSON object
$user_nest_dataBundle = $_POST['user_nest_dataBundle'];
$user_nest_dataBundle = json_decode($user_nest_dataBundle, true); // true returns an associative array
$email = $user_nest_dataBundle['email'];
$user_nest_authCode = $user_nest_dataBundle['user_nest_authCode'];

// Send code to NEST and get NEST Access Token
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.home.nest.com/oauth2/access_token");
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, "client_id=5b67590a-8ce8-43f2-bad1-f35e8c6ba3cb&code=$user_nest_authCode&client_secret=Rsgk45M0DyAVLmcbjNOT67krn&grant_type=authorization_code");
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
curl_setopt($ch, CURLOPT_POSTREDIR, 3);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$nestinfo = curl_exec($ch);
curl_close($ch);

$nestinfo = json_decode($nestinfo, true); // true returns an associative array
if ( !array_key_exists('access_token',$nestinfo) || !array_key_exists('expires_in',$nestinfo) ) {
	die("We're so sorry! NEST turned us down. Could you please create a new authorization code and send it to us? Pretty Please?");
}
$nest_access_token = $nestinfo['access_token'];
$nest_access_token_expiry = (string)( intval($nestinfo['expires_in']) + intval(microtime(true)) ); //  add current *NIX epoch to calculate actual expiry time

// MySQL Stuff
$dbc = new mysqli($dbserver,$dbusername,$dbpassword, $dbname) or die ("Error creating DB connection" . $dbc->errno . ": ". $dbc->error ."<BR>") ;

$sql = "INSERT INTO users (email,nest_access_token,nest_access_token_expiry) VALUES ('$email','$nest_access_token','$nest_access_token_expiry')";

// Check for Duplicate Entries
$result = $dbc->query($sql);

if (!$result) {
	die("You have already registered your NEST device with us. You're ahead of the curve; way to go!");
}

$dbc->close() ;
echo "Woohoo! Congratulations! This is your first step to saving the Earth, and you save money by doing it!";

?>
