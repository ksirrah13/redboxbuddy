<?php

//include the api key and referral id
include('config.php');
include('inc/helpers.php');

$time = $_POST['time'];

$url = "https://api.redbox.com/v3/products/movies/top20?period=".$time."&apiKey=". $apikey;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
$output = curl_exec($ch);

$movies = json_decode($output, true);
$timeString = $time == '30' ? 'This Month' : 'This Week';


if ($_POST['action'] = 'click') {
    echo '<h2>Top 20 ' . $timeString . '</h2>';
    echo '<ol>';
            foreach($movies['Top20']['Item'] as $movie){
            	$id = $movie['@productId'];
                echo '<li><a href=single.php?id='. $id .'>'. $movie['Title'] .'</a></li>';
}
        echo '</ol>';
            }
?>