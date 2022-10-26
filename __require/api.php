<?php

GLOBAL $baseurl;
$baseurl = "http://localhost:3000";
/**
 * Stuur een API request naar de API
 * @param $path String
 * @return bool|string
 */
function Api_Request(string $path) {
    $key = Database_Api();
    GLOBAL $baseurl;
    $url = "$baseurl/$path/?api=$key";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    if(in_array($output, (array)Api_RequestAlt())) {
        echo "<h1 class='w3-center'>Response: <bold>$output</bold></h1>";
    }
    return $output;
}


/**
 * Stuur een API request naar de API
 * @return bool|string
 */
function Api_RequestAlt() {
    $key = Database_Api();
    GLOBAL $baseurl;

    $url = "$baseurl/results/?api=$key";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output);
}