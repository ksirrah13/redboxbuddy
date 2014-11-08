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
    <div>
        <div>
            <?php

            $title = $movie['Products']['Movie']['Title'];
            $url = $movie['Products']['Movie']['@websiteUrl'];
            $picture = $movie['Products']['Movie']['BoxArtImages']['atom:link'][1]['@href'];
            $desc = $movie['Products']['Movie']['SynopsisLong'];

            
                echo '<div class="redbox_movie">';

                echo '<h2>' . $title . '</h2>';
                echo '<img src="' . $picture . '" alt="' . title .'" />';
                echo '<p>' . $desc . '</p>';
                echo '<a href="' . $url . '">' . 'View on RedBox' . '</a>';

                echo '</div>';

            ?>
        </div>
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
