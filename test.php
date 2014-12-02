<?php

include('config.php');
include('inc/helpers.php');

$url1 = "https://api.redbox.com/v3/products/movies/top20?period=30&apiKey=". $apikey;
$url = "https://api.redbox.com/v3/products/09B9A382-C977-4A66-8C19-B0E46F208C50?apiKey=64fb41ac2e6c3646fad4b71cb764b5d5";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
$output = curl_exec($ch);

$movies = json_decode($output, true);

echo $output;
?>
