<?php include('header.php')  ?>
 

	<ul class="nav nav-tabs" role="tablist">
	  <li class="active ajax" data-time="30" data-url="top20.php"><a href="#">This Month</a></li>
	  <li class="ajax" data-time="7" data-url="top20.php"><a href="#">This Week</a></li>
	  
	</ul>

	 <div class="row20">



	</div> <!-- end row -->

<?php include('footerTabs.php') ?>

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

