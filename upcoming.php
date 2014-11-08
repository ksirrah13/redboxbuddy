<?php

//include the api key and referral id
include('config.php');
include('inc/helpers.php');

$url = "https://api.redbox.com/v3/products/movies/comingsoon?apiKey=". $apikey ."&pageNum=1&pageSize=200";
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
$output = curl_exec($ch);

$products = json_decode($output, true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

    <title>MovieMafia | RedBox Buddy</title>
    <meta content="width=device-width, minimum-scale=1, maximum-scale=1" name="viewport">

    <!-- JS -->
    <script type="text/javascript" src="/js/jquery-2.0.js"></script>
    <script type="text/javascript" src="/js/colors.js"></script>
    <script type="text/javascript" src="/js/main.js"></script>
    <script type="text/javascript" src="/js/chosen.jquery.min.js"></script>

    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="/css/main.css" media="screen" />
    <link rel="stylesheet" type="text/css" href="/css/chosen.min.css" media="screen" />

</head>
<body>


<!-- The movie nav -->
<!-- movies -->
<div>
    <div>

        <?php
        foreach($products['Products']['Movie'] as $movie){
            echo '<div class="redbox_movie movie normal">';
            $format = '<a href="%s" target="_BLANK">%s</a><br/>';
            echo '<h2>' . sprintf( $format, $movie['@websiteUrl'], $movie['Title']). '</h2>';
            echo '<a href="'. $movie['BoxArtImages']['link'][1]['@href'] .'"><img class="pic" src="'.  $movie['BoxArtImages']['link'][2]['@href'] .'" target="_BLANK" /></a>';
            echo '<div class="description">'. ellipsis($movie['SynopsisLong'], 200) .'<br><br><span style="color:darkred;">At your RedBox: </span>'. $movie['RedboxComingSoonDate'] . '<br><br>' .'<a href="'. $movie['@websiteUrl'] .'" target="_BLANK" class="button">Get a notice</a></div>';
            echo '<br>';
            echo '</div>';
        }
        ?>
    </div>
</div>
</body>
</html>
