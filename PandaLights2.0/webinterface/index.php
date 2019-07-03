<?php
  //some startup variables
  //select options [functions, head, nav] true or false for the start file
  $start = [1,1,1];
  $page = "Home";
  $docroot = $_SERVER["DOCUMENT_ROOT"];
  //include start file which in turn includes functions, head and nav file
  include("$docroot/files/php/start.php");
 ?>
 <div class="content">

     <div class="carousel"data-flickity='{ "wrapAround": true, "pageDots": false }'>
       <?php ProfileSwiper() ?>
    </div>

 </div>
<script>


    function ManToggle(l1, l2, l3, l4, l5){
      if(l1 == 1)$( "#Light1" ).prop( "checked", true );
      else       $( "#Light1" ).prop( "checked", false );

      if(l2 == 1)$( "#Light2" ).prop( "checked", true );
      else       $( "#Light2" ).prop( "checked", false );

      if(l3 == 1)$( "#Light3" ).prop( "checked", true );
      else       $( "#Light3" ).prop( "checked", false );

      if(l4 == 1)$( "#Light4" ).prop( "checked", true );
      else       $( "#Light4" ).prop( "checked", false );

      if(l5 == 1)$( "#Light5" ).prop( "checked", true );
      else       $( "#Light5" ).prop( "checked", false );

      $( "#manoverride" ).submit();
    }

    $('.swipeform').submit(function(e) {
    e.preventDefault();
    this.submit();
      setTimeout( function () {
         refreshLight()
     }, 300);
     setTimeout( function () {
        refreshLight()
    }, 300);
    setTimeout( function () {
       refreshLight()
   }, 300);
    });
</script>
