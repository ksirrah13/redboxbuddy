<?php include('header.php'); 
include('config.php'); 


$box = $_GET['box'] == "" ? "all" : $_GET['box'];

if ($box != "all") {

$url = "https://api.redbox.com/v3/stores?apiKey=" . $apikey . "&storeList=" . $box;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('accept: application/json'));
$output = curl_exec($ch);

$store = json_decode($output, true);

$address = $store['StoreBulkList']['Store']['Location']['Address'] . ", ";
$address .= $store['StoreBulkList']['Store']['Location']['City'] . ", ";
$address .= $store['StoreBulkList']['Store']['Location']['State'];

$address .= "<div class='btn' id='clearLoc' style='color:red'> X</div>";
}

?>


<!-- Persistent variables -->
<div style="display:none;">
<span id="category">default</span>
<span id="genre">all</span>
<span id="box"><?php echo $box ?></span>


</div>
<!-- End Persistent variables -->



<span><form action="search.php" method="post"<li><input type="text" class="form-control" name="query" placeholder="Search"></li> </form></span>

<!--  <div class="btn btn-default centered" id="genreBtn">Apply filter by genre</div>

 <div id="slider1_container" >

        
            
            <a class="ajax" href="#" data-url="genre.php" data-genre="all">No filter</a>
            <a class="ajax" href="#" data-url="genre.php" data-genre="Action">Action</a>
            <a class="ajax" href="#" data-url="genre.php" data-genre="Comedy">Comedy</a>
            <a class="ajax" href="#" data-url="genre.php" data-genre="Horror">Horror</a>
            <a class="ajax" href="#" data-url="genre.php" data-genre="Drama">Drama</a>
            <a class="ajax" href="#" data-url="genre.php" data-genre="Family">Family</a>
            <a class="ajax" href="#" data-url="genre.php" data-genre="Romance">Romance</a>
            <a class="ajax" href="#" data-url="genre.php" data-genre="Kids">Kids</a>
 
    
     

        
    </div> -->

    <p id="boxSearch"></p>

    <?php include('slider.php') ?>

<p id="filter"></p>
	<ul class="nav nav-tabs" role="tablist">
	  <li class="active ajax" data-category="default" data-url="genre.php"><a href="#">New Releases</a></li>
	  <li class="ajax" data-category="comingsoon" data-url="genre.php"><a href="#">Coming Soon</a></li>
	  <li class="ajax" data-category="all" data-url="genre.php"><a href="#">All movies</a></li>
	  
	</ul>

	 <div class="row">



	</div> <!-- end row -->


<?php include('footerTabs.php') ?>

<!-- ajax -->
 <script>

 $('.footerfixed').on('click', 'a' , function() {
  window.location.replace($(this).attr('href'));


 });

 $('.ajax').click( function() {

 	$('#category').html($(this).data('category') || $('#category').html());
 	$('#genre').html($(this).data('genre') || $('#genre').html());
	
	var $category = $('#category').html();
	var $genre = $('#genre').html();
  

	if ($genre != "all") {
		$('#genreBtn').html("Filtered by: " + $genre);
	} else {
		$('#genreBtn').html("Apply filter by Genre");
	}

	var $url = $(this).data("url");
       $.ajax({
                               url: $url,
                               type:'post',
                               data:{'action':'click', 'category': $category, 'genre': $genre, 'box': $box},
                               success:function(data,status){
                                               $('.row').html(data);
                             
                               },
                               error:function(xhr,desc,err){
                                       console.log(xhr);
                                       console.log("Details: "+desc+"\nError:"+err);
                               }
                       });
       })


  var add = "<?php echo $address ?>";

var $box = $('#box').html();
  if ($box != "all") {
    $('#boxSearch').html("Searching box: " + add);
  } else {
    $('#boxSearch').html("");
  }

  $('#clearLoc').click( function() {
    $('#box').html("all");
    window.location.replace('index.php');
  });

$(document).ready(function(){
    $(".ajax.active").trigger('click');
});




</script>

<script> 

 $('.nav-tabs').on('click', 'li', function() {
        $(this).siblings("li").removeClass("active");
        $(this).addClass("active");
});


 </script>
</div>
</body>
</html>

