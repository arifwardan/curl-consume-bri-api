<?php
require_once "core.php";


class Token{
    public function getToken()
    {
        $url = URL_TOKEN;
        $data = "client_id=".CONSUMER_KEY."&client_secret=".CONSUMER_SECRET;
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");  //for updating we have to use PUT method.
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        $result = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        $json = json_decode($result, true);
        $accesstoken = $json['access_token'];
        
        return $accesstoken;
    }
}

$getToken = new Token;
// print_r($getToken->getToken());