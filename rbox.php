<?php 

$rboxUrl = $_GET['url'];

include ('header.php')

?>


<iframe width="100%" height="100%" src="<?php echo $rboxUrl ?>"></iframe>

<?php include('footerTabs.php') ?>

<!-- ajax -->
 <script>

 $('.footerfixed').on('click', 'a' , function() {
  window.location.replace($(this).attr('href'));


 });

 </script>
   

</body>
</html>