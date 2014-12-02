<?php include('header.php')  ?>

<span><form action="locate.php" method="post"<li><input type="text" class="form-control" name="zip" placeholder="Enter Postal Code"></li> </form></span> 


	 <div class="locate">



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

