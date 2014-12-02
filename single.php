 <?php

//include the api key and referral id
include('config.php');
include('inc/helpers.php');

$movie_id = $_GET["id"];
$movie_id1 = "09B9A382-C977-4A66-8C19-B0E46F208C50";
$url = "https://api.redbox.com/v3/products/movies/" . $movie_id . "?apiKey=". $apikey;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
$output = curl_exec($ch);

$movie = json_decode($output, true);

include('header.php');
?>

 <!-- movies -->
    <div class="row">
            <?php

            $title = $movie['Products']['Movie']['Title'];
            $url = $movie['Products']['Movie']['@websiteUrl'];
            $picture = $movie['Products']['Movie']['BoxArtImages']['atom:link'][1]['@href'];
            $desc = $movie['Products']['Movie']['SynopsisLong'];
            $format = $movie['Products']['Movie']['@format'];


            
                echo '<div class="thumbnail centered col-xs-12 col-md-12">';

                echo '<hr>';
                echo '<img class="img-rounded" src="' . $picture . '" alt="' . title .'" />';
                echo '<hr>';
                echo '<h3 class="singleTitle">' . $title . '</h3>';
                echo '<p>' . $desc . '</p>';
                echo '<a class="btn btn-default" href="rbox.php?url=' . $url . '">' . 'Rent on ' . $format . '</a>';

                echo '</div>';

            ?>

    </div>
 

<?php include('footerTabs.php') ?>

<!-- ajax -->
 <script>

 $('.footerfixed').on('click', 'a' , function() {
  window.location.replace($(this).attr('href'));


 });

 </script>
   

</body>
</html>
