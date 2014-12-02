
<?php
//include the api key and referral id
include('config.php');

$page_size = 8;
$page = 1;
$zip = $_POST["zip"] ? $_POST["zip"] : -1;
$loc = $_POST["loc"] ? $_POST["loc"] : -1;

if ($zip != -1) {
	$url = "https://api.redbox.com/v3/stores/postalcode/" . $zip . "?apiKey=". $apikey ."&pageNum=" . $page . "&pageSize=" . $page_size . "&sortBy=distance" . "&sortDir=asc";

} else if ($loc != -1) {
	$url = "https://api.redbox.com/v3/stores/latlong/" . $loc . "?apiKey=". $apikey ."&pageNum=" . $page . "&pageSize=" . $page_size . "&sortBy=distance" . "&sortDir=asc";

} else if ($loc == "none") {
	echo "Geolocation is not supported on this device";
}


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
$output = curl_exec($ch);

$stores = json_decode($output, true);

foreach($stores['StoreBulkList']['Store'] as $store){

$id = $store['@storeId'];
$dist = number_format($store['DistanceFromSearchLocation'], 2); 

//echo '<p>"'. $store['City'] .'"</p>';
echo '<div><a href="index.php?box='. $id .'"><li>';
echo $store['Location']['Address'] . ", " . $store['Location']['City'] . ", " . $store['Retailer'] . ", " . $store['Channel'] . " - " . $dist . " miles" ;
echo '</li></a></div>';
}

?>
