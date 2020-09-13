<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include('simple_html_dom.php');
$searchQuery = $_GET['query'];

$searchQuery = str_replace(' ','+',$searchQuery);
$curl = curl_init();

curl_setopt($curl, CURLOPT_URL, "https://www.google.com/search?q=" . $searchQuery);
curl_setopt($curl, CURLOPT_FOLLOWLOCATION,true);
curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/85.0.4183.102 Safari/537.36');


$result = curl_exec($curl);
var_dump($result);
curl_close($curl);

$domResults = new simple_html_dom();

$domResults->load($result);

foreach ($domResults->find('div.r') as $elements){
    echo $elements->find('h3', 0)->plaintext . '</br>';
    echo $elements->find('a', 0)->href . '</br>';
}