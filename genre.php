<?php
//include the api key and referral id
include('config.php');
//include('inc/helpers.php');

$page_size = 20;
$category = $_POST['category'];
$genre = $_POST['genre'];
$box = $_POST['box'];
$page = 1;

if ($category != "all") {
    $category = "/" . $category;
} else {
    $category = "";
}

if ($genre == "all" ) {
    $url = "https://api.redbox.com/v3/products/movies" . $category . "?apiKey=". $apikey;
} else {
    $url = "https://api.redbox.com/v3/products/movies" . $category . "?apiKey=". $apikey ."&productTypes=Movies&searchField=Genre&q=" . $genre;    
}

if ($box == "all" || $category == "/comingsoon") {
    $url = $url . "&pageNum=" . $page . "&pageSize=" . $page_size;
}

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
$output = curl_exec($ch);

$products = json_decode($output, true);

if ($box != "all") {

    $url = "https://api.redbox.com/v3/inventory/stores/" . $box . "?apiKey=". $apikey; 

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
    $output = curl_exec($ch);

    $boxInv = json_decode($output, true);

    $movieID = array();

    foreach($boxInv['Inventory']['StoreInventory']['ProductInventory'] as $movie) {
        if ($movie['@inventoryStatus'] == "InStock") {
            array_push($movieID, $movie['@productId']);
            
        }

    }


}

if($_POST['action'] == "click") {

    $url = $movie['BoxArtImages']['atom:link'][2]['@href'];
    $http = curl_init($url);
    curl_setopt($http, CURLOPT_NOBODY, true);
    $result = curl_exec($http);
    $http_status = curl_getinfo($http, CURLINFO_HTTP_CODE);
    curl_close($http);

    $count = 0;


    if ($http_status != '403') {
        foreach($products['Products']['Movie'] as $movie){
         $id = $movie['@productId'];

         // echo 'b: ' . !!($box != "all") . ' c: ' . !!($category != "/comingsoon") . ' a: ' . !!(in_array($id, $movieID)) . "<br/>";
         if ($box != "all" && $category != "/comingsoon") {

            if (in_array($id, $movieID) && $count < $page_size) {
               echo '<a class="single" href="single.php?id='. $id .'" >';

               echo '<div class="col-xs-6 col-md-3 movieGrid">';
               echo '<img class="pic" src="'.  $movie['BoxArtImages']['atom:link'][2]['@href'] .'" alt="' . $movie['Title'] . '">';
               echo '</div>';

               echo '</a>'; 
               $count++;
           }


       } else {

        echo '<a class="single" href="single.php?id='. $id .'" >';

        echo '<div class="col-xs-6 col-md-3 movieGrid">';
        echo '<img class="pic" src="'.  $movie['BoxArtImages']['atom:link'][2]['@href'] .'" alt="' . $movie['Title'] . '">';
        echo '</div>';

        echo '</a>';

    }
    

}

}




}
