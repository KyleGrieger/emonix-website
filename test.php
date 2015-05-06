<?php

$nest_access_token='c.BH29q7kQCdm4ufp3Q5Jcn7tqv98Yc5qGtlyCXdSScyGSTDkF1j0ZG4BosCNRe5WQp7zz3Sy0A05CRPCu3sSKi2gFDXCkC8kwQhAZkujPJ9yPjCKq9SHiCmWpUNJLL5BDXf1UbQ4SBDFmNrPb';


// Get Nest user's zipcode, etc
$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, "https://developer-api.nest.com/?auth=$nest_access_token"); 
curl_setopt($ch, CURLOPT_HEADER, 0); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Accept: application/json'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 2);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$data = curl_exec($ch); 
curl_close($ch); 

$nestinfo = json_decode($data, true); // true returns an associative array
//if ( !array_key_exists('postal_code',$nestinfo) || !array_key_exists('thermostats',$nestinfo) ) {
//	die("We're so sorry! NEST turned us down. Could you please create a new authorization code and send it to us? Pretty Please?");

$structure_id =  array_keys($nestinfo['structures'])[0];
$thermostat_id = array_keys($nestinfo['devices']['thermostats'])[0];
$timezone = $nestinfo['structures'][$structure_id]['time_zone'];
$postalcode = $nestinfo['structures'][$structure_id]['postal_code'];
echo "Postal code = $postalcode\n";
echo "Thermostat ID = $thermostat_id\n";
echo "Timezone = $timezone\n";
//echo $data;

?>
