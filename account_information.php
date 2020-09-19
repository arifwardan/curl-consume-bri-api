<?php

require_once "core.php";

$NoRek = REKENING;
$secret = CONSUMER_SECRET;
$timestamp = gmdate("Y-m-d\TH:i:s.000\Z");
$token = $accesstoken;
$path = "/sandbox/v2/inquiry/".$NoRek;
$verb = "GET";
$body="";

$base64sign = generateSignature($path,$verb,$token,$timestamp,$body,$secret);

$urlGet ="https://partner.api.bri.co.id/sandbox/v2/inquiry/".$NoRek;
$chGet = curl_init();
curl_setopt($chGet,CURLOPT_URL,$urlGet);

$request_headers = array(
                    "Authorization:Bearer " . $token,
                    "BRI-Timestamp:" . $timestamp,
                    "BRI-Signature:" . $base64sign
                );
curl_setopt($chGet, CURLOPT_HTTPHEADER, $request_headers);
curl_setopt($chGet, CURLINFO_HEADER_OUT, true);


// curl_setopt($chGet, CURLOPT_CUSTOMREQUEST, "GET");  //for updating we have to use PUT method.
curl_setopt($chGet, CURLOPT_RETURNTRANSFER, true);

$resultGet = curl_exec($chGet);
$httpCodeGet = curl_getinfo($chGet, CURLINFO_HTTP_CODE);
// $info = curl_getinfo($chGet);
// print_r($info);
curl_close($chGet);

$jsonGet = json_decode($resultGet, true);


echo "<br/> <br/>";
echo "Response Get : ".$resultGet;