<?php


$URL = 'https://eatrynearme.com/api/getData';
 
$curl_googleindex = curl_init();


    curl_setopt_array($curl_googleindex, array(
        CURLOPT_URL => $URL,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 15,
        CURLOPT_TIMEOUT => 15,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',

    ));

$response = curl_exec($curl_googleindex);
curl_close($curl_googleindex);







