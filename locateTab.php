<?php include('header.php')  ?>

<input type="text" id="zip" class="form-control" name="zip" placeholder="Enter Postal Code">
<button id="getLoc" class="btn btn-default centered">Use your current location</button>

 

<h5>Redbox Locations:</h5>
<hr>
<ol>
  <div class="locateRow">

	</div> <!-- end row -->

<?php include('footerTabs.php') ?>

<!-- ajax -->
 <script>

 $('#getLoc').click(function() {
  var result, lat, lon;

    if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(getPos);
    } else {
      result = "none";
    }

    function getPos(pos) {
      lat = pos.coords.latitude;
      lon = pos.coords.longitude;
      result = lat + "," + lon;
      $.ajax({
                               url: 'locate.php',
                               type:'post',
                               data:{'loc': result},
                               success:function(data,status){
                                               console.log(status);
                                               $('.locateRow').html(data);

                               },
                               error:function(xhr,desc,err){
                                       console.log(xhr);
                                       console.log("Details: "+desc+"\nError:"+err);
                               }
                       });


    }

})

$('#zip').keyup(function(e) {
  if (e.keyCode == 13) {
    var zip = $('#zip').val();

      $.ajax({
                               url: 'locate.php',
                               type:'post',
                               data:{'zip': zip},
                               success:function(data,status){
                                               console.log(status);
                                               $('.locateRow').html(data);
                               },
                               error:function(xhr,desc,err){
                                       console.log(xhr);
                                       console.log("Details: "+desc+"\nError:"+err);
                               }
                       });


    }

})

  $('.footerfixed').on('click', 'a' , function() {
  window.location.replace($(this).attr('href'));

 });


 $('.nav-tabs').on('click', 'li', function() {
        $(this).siblings("li").removeClass("active");
        $(this).addClass("active");
});


 </script>
</body>
</html>

