<?php
if (isset($_GET['postal'])) {
    $url = 'https://zipcloud.ibsnet.co.jp/api/search?zipcode=' . $_GET['postal'];
    $response = getJSON_forAPI($url, true);
    echo $response;
}

//
function getJSON_forAPI($url, $type = false)
{
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($curl);
    curl_close($curl);
    if ($type) {
        $response = json_decode($response, true);
        $response = json_encode($response);
    }
    return $response;
}