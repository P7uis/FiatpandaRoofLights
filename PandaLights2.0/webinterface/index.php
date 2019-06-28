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
   <a class="nav-link" href="/toggle/index.php?page=<?php echo $page; ?>"><?php echo LightsList();?></a><br>

   <div class="swiper-container">
    <div class="swiper-wrapper">
      <?php ProfileSwiper() ?>
    </div>
    <!-- Add Pagination -->
    <div class="swiper-pagination"></div>
</div>

 </div>
<script>
var x = window.matchMedia("(max-width: 600px)")
if (x.matches) {var slidecount = 1  }
else { slidecount = 3 }
var swiper = new Swiper('.swiper-container', {
  slidesPerView: slidecount,
      spaceBetween: 30,
      slidesPerGroup: 1,
      loop: true,
      loopFillGroupWithBlank: true,
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      },
    });
</script>
