
<?php
//include the api key and referral id
include('config.php');
//include('inc/helpers.php');

$page_size = 20;
$category = $_POST['category'];
$page = 1;

$url = "https://api.redbox.com/v3/products/movies/". $category . "?apiKey=". $apikey ."&pageNum=" . $page . "&pageSize=" . $page_size;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
$output = curl_exec($ch);

$products = json_decode($output, true);

if($_POST['action'] == "click") {

    $url = $movie['BoxArtImages']['atom:link'][2]['@href'];
    $http = curl_init($url);
    curl_setopt($http, CURLOPT_NOBODY, true);
    $result = curl_exec($http);
    $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
    curl_close($http);

    if ($http_status != '403') {
        foreach($products['Products']['Movie'] as $movie){
            $id = $movie['@productId'];

            echo '<a href=# data-url=single.php data-id=' . $id . ' >';

	    echo '<div class="col-xs-6 col-md-3 <a href="'. $movie['BoxArtImages']['link'][1]['@href'] .'"><img class="pic" src="'.  $movie['BoxArtImages']['atom:link'][2]['@href'] .'" target="_BLANK" alt="No image found :("></a></div>';
 	       
           echo '</a>';

           }
	}



}
