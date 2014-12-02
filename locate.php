<?php include('header.php')  ?>

<?php
//include the api key and referral id
include('config.php');

$page_size = 5;
$category = $_POST['category'];
$page = 1;
$zip = $_POST["zip"];
$url = "https://api.redbox.com/v3/stores/postalcode/" . $zip . "?apiKey=". $apikey ."&pageNum=" . $page . "&pageSize=" . $page_size . "&sortBy=distance" . "&sortDir=asc";


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
$output = curl_exec($ch);

$stores = json_decode($output, true);

?>
<div class="locaterow">
<span><form action="locate.php" method="post"<li><input type="text" class="form-control" name="zip" placeholder="Enter Postal Code"></li> </form></span> 
<h5>Redbox Locations:</h5>
<hr>
<ol>
<?php
foreach($stores['StoreBulkList']['Store'] as $store){

//$id = $store['@StoreId'];
//echo '<p>"'. $store['City'] .'"</p>';
echo '<div><a><li>';
echo $store['Location']['Address'] . ", " . $store['Location']['City'] . ", " . $store['Retailer'] . ", " . $store['Channel'];
echo '</li></a></div>';
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
