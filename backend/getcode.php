<?php

session_start();
$code = $_GET['code'];

$client_id = "344011bf4a90408ca1e9f645061e8592 "; #found here https://developer.spotify.com/dashboard/applications
$client_secret = ""; # ^^

$b64_echoded = base64_encode($client_id.":".$client_secret);
echo($b64_echoded."<br>");
echo($code."<br>");
$headers = array(
    "Authorization: Basic ".$b64_echoded,
    "Content-Type: application/x-www-form-urlencoded."
);
$curl =  curl_init();
$data = array(
    'redirect_uri' => "http://localhost/artify/backend/getcode.php",
    'grant_type'   => 'authorization_code',
    'code'         => $code,
    'client_id'         => "344011bf4a90408ca1e9f645061e8592",
    'client_secret'         => "",
);
#$body = "grant_type=authorization_code&code=".$code."&redirect_uri=http://localhost/artify/backend/getcode.php&client_id=".$client_id."&client_secret=".$client_secret;

curl_setopt($curl, CURLOPT_URL, "https://accounts.spotify.com/api/token");
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));#CHANGE TO YOUR REDIRECT URL
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    "content-type: application/x-www-form-urlencoded"
]);
$server_output = curl_exec($curl);
curl_close($curl);
echo($server_output);
$obj = json_decode($server_output);
$access_token = $obj->{'access_token'};
$me_headers = array(
    "Authorization: Bearer ".$access_token
);

$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://api.spotify.com/v1/me");
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, $me_headers);

$me_data = curl_exec($curl);
#echo($me_data);
curl_close($curl);

$meobj = json_decode($me_data);
$name = $meobj->{'display_name'};
$id = $meobj->{'id'};
#echo($name);


$_SESSION['access_token'] = $access_token;
$_SESSION['user_name'] = $name;
$_SESSION['id'] = $id;
$_SESSION['amount'] = "50";
$_SESSION['type'] = "artists";
$_SESSION['time'] = "medium_term";
header('Location: ../stats.php')

?>
