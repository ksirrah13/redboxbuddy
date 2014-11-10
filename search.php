<?php include('header.php')  ?>

<?php
//include the api key and referral id
include('config.php');

$page_size = 20;
$category = $_POST['category'];
$page = 1;
$query = $_POST["query"];
//$url = "https://api.redbox.com/v3/products?apiKey=" . $apikey . "&q=" . $query;
$url = "https://api.redbox.com/v3/products?apiKey=". $apikey ."&pageNum=" . $page . "&pageSize=" . $page_size . "&q=" . $query;


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
$output = curl_exec($ch);

$products = json_decode($output, true);

?>
<div class="searchrow">
<?php
foreach($products['Products']['Movie'] as $movie){

echo '<div class="col-xs-6 col-md-3 <a href="'. $movie['BoxArtImages']['link'][1]['@href'] .'"><img class="pic" src="'.  $movie['BoxArtImages']['atom:link'][2]['@href'] .'" target="_BLANK"></a></div>';


               }



?>
</div>
<?php include('footerTabs.php')  ?>

<script>
var url = '<?php echo $url; ?>';
console.log(url);
</script>

</body>
</html>
