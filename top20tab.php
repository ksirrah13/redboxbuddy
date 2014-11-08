<?php include('header.php')  ?>
 

	<ul class="nav nav-tabs" role="tablist">
	  <li class="active ajax" data-time="30" data-url="top20.php"><a href="#">This Month</a></li>
	  <li class="ajax" data-time="7" data-url="top20.php"><a href="#">This Week</a></li>
	  
	</ul>

	 <div class="row20">



	</div> <!-- end row -->
<div data-role="navbar">
                <div class="footerfixed">
                                        <ul>
                                                <li><a href="index.php" data-icon="home">Home</a></li>
                                                <li><a href="top20tab.php" data-icon="star">Top 20</a></li>
                                                <li><a href="listviews.html" data-icon="grid">Lists</a></li>
                                                <li><a href="nav.html" data-icon="search">Nav</a></li>
                                        </ul>
                        </div> 


        <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
-->
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->
<!-- ajax -->
 <script>

  $('.footerfixed').on('click', 'a' , function() {
  window.location.replace($(this).attr('href'));

 });



 $('.ajax').click( function() {
 	var $time = $(this).data("time");
	var $url = $(this).data("url");

       $.ajax({
                               url: $url,
                               type:'post',
                               data:{'action':'click', 'time': $time},
                               success:function(data,status){
                                               $('.row20').html(data);

                               },
                               error:function(xhr,desc,err){
                                       console.log(xhr);
                                       console.log("Details: "+desc+"\nError:"+err);
                               }
                       });
       })

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
</body>
</html>

