
<?php
//include the api key and referral id
include('config.php');

$page_size = 20;
$category = $_POST['category'];
$page = 1;

$url = "https://api.redbox.com/v3/products/movies/top20?period=30&apiKey=". $apikey;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
$output = curl_exec($ch);

$movies = json_decode($output, true);

if($_POST['action'] == "click") {

echo '<ol class="movies">';
            foreach($movies['Top20']['Item'] as $movie){
                echo '<li><a href="'. strtolower($movie['@websiteUrl']) .'">'. $movie['Title'] .'</a></li>';
            }
echo '</ol>';
}
?>
