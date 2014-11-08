 <?php

//include the api key and referral id
include('config.php');
include('inc/helpers.php');

$movie_id = $_POST["pdata"];
$movie_id1 = "09B9A382-C977-4A66-8C19-B0E46F208C50";
$url = "https://api.redbox.com/v3/products/" . $movie_id . "?apiKey=". $apikey;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
$output = curl_exec($ch);

$movie = json_decode($output, true);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />

    <title>RedBox API</title>
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
    <!-- movies -->
    <div>
        <div>
            <?php
                echo '<div class="redbox_movie movie narrow">';
                $format = '<a href="%s" target="_BLANK">%s</a><br/>';
                echo '<h2>' . sprintf( $format, $movie['Products']['Movie']['@websiteUrl'], $movie['Products']['Movie']['Title']). '</h2>';
                echo '<a href="'. $movie['Products']['Movie']['BoxArtImages']['link'][1]['@href'] .'"><img class="pic" src="'.  $movie['Products']['Movie']['BoxArtImages']['link'][2]['@href'] .'" target="_BLANK" /></a>';
                echo '<br><br><div class="description">'. ellipsis($movie['Products']['Movie']['SynopsisShort'], 200) .'<br><br><a href="'. $movie['Products']['Movie']['@websiteUrl'] .'" target="_BLANK" class="button">Rent Movie</a></div>';
                echo '<br>';
                echo '</div>';

            ?>
        </div>
    </div>
</body>
</html>
