<?php
require_once('Links/Setting.php');
?><!DOCTYPE html>
<html lang="zxx">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <meta content="<?php echo htmlentities($MetaDescriptionHome);?>" name="description">
    <meta content="<?php echo htmlentities($MetaKeywordHome);?>" name="keywords">
    <title><?php echo htmlentities($MetaTitleHome);?></title>

    <!-- ::::::::::::::Favicon icon::::::::::::::-->
    <link rel="shortcut icon" href="<?php echo  $DirassetsImage.$ICON; ?>" type="image/png">

    <!-- ::::::::::::::All CSS Files here :::::::::::::: -->
    <!-- Vendor CSS -->
    <!-- <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/vendor/ionicons.css">
    <link rel="stylesheet" href="assets/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css"> -->

    <!-- Plugin CSS -->
    <!-- <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="assets/css/plugins/venobox.min.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.lineProgressbar.css">
    <link rel="stylesheet" href="assets/css/plugins/aos.min.css"> -->

    <!-- Main CSS -->
    <!-- <link rel="stylesheet" href="assets/sass/style.css"> -->
 
    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css">     
<!--    <link rel="stylesheet" href="assets/css/style.arabi.css">-->
    <style>
    body{
        direction: rtl; 
        
    }    
        h1,h2,h3,h4,h5,h6,a,ul,li,p,span{
            font-family: 'Lateef', serif;
            font-weight: 400;
            font-style: normal;
        }
</style>
</head>

<body>
    <!-- Start Header Area -->
    <?php include("Links/Header-Section.php"); ?>
    <!-- Start Header Area -->

    <!-- Start Mobile Header -->
    <?php include("Links/Mobile-Header-Section.php"); ?>
    <!-- End Mobile Header -->

    <!--  Start Offcanvas Mobile Menu Section -->
    <?php include("Links/Offcanvas-Mobile-Menu-Section.php"); ?>
    <!-- ...:::: End Offcanvas Mobile Menu Section:::... -->

    <!-- Start Offcanvas Addcart Section -->
    <?php include("Links/Offcanvas-Addcart-Section.php"); ?>
    <!-- End  Offcanvas Addcart Section -->


    <!-- Start Offcanvas Search Bar Section -->
    <?php include("Links/Offcanvas-Search-Bar-Section.php"); ?>
    <!-- End Offcanvas Search Bar Section -->

    <!-- Offcanvas Overlay -->
    <div class="offcanvas-overlay"></div>
    
      <!-- Start Ads Slider Section-->
    <?php  include("Links/Ads-Slider-Section.php"); ?>
      <!-- End Ads Slider Section-->

     <!-- Start Hero Slider Section-->
    <?php // include("Links/Hero-Slider-Section.php"); ?>
      <!-- End Hero Slider Section-->



    <!-- Start Product Default Slider Section -->
    <!-- <?php include("Links/Product-Slider-Section.php"); ?> -->
   <!-- End Product Default Slider Section -->
    
    <!-- Start Category Product Default Slider Section -->
    <?php include("Links/Category-Product-Slider-Section.php"); ?>
   <!-- End Category Product Default Slider Section -->
    
    <!-- Start Best Sales Product Default Slider Section -->
    <?php include("Links/Best-Sales-Products-Slider-Section.php"); ?>
   <!-- End Best Sales Product Default Slider Section -->

    <!-- Start Service Section -->
    <?php include("Links/Service-Section.php"); ?>
    <!-- End Service Section -->
    
    <!-- Start Banner Section -->
    <?php //include("Links/Banner-Section.php"); ?>
    <!-- End Banner Section -->

    <!-- Start Blog Slider Section -->
    <?php // include("Links/Blog-Slider-Section.php"); ?>
    <!-- End Blog Slider Section -->

    <!-- Start Instagramr Section -->
    <?php //include("Links/Instagramr-Section.php"); ?>
    <!-- End Instagramr Section -->
<br>
<br>
<br>
    <!-- Start Footer Section -->
    <?php include("Links/Footer-Section.php"); ?>
    <!-- End Footer Section -->

    <!-- material-scrolltop button -->
    <button class="material-scrolltop" type="button"></button>

    <!-- Start Modal Add cart -->
    <?php include("Links/Modal-Add-Cart.php"); ?>
    <!-- End Modal Add cart -->

    <!-- Start Modal Quickview cart -->
    <?php include("Links/Modal-Quickview-Cart.php"); ?>
    <!-- End Modal Quickview cart -->

    <!-- ::::::::::::::All JS Files here :::::::::::::: -->
    <!-- Global Vendor, plugins JS -->
    <!-- <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/jquery-ui.min.js"></script>  -->

    <!--Plugins JS-->
    <!-- <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/material-scrolltop.js"></script>
    <script src="assets/js/plugins/jquery.nice-select.min.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/venobox.min.js"></script>
    <script src="assets/js/plugins/jquery.waypoints.js"></script>
    <script src="assets/js/plugins/jquery.lineProgressbar.js"></script>
    <script src="assets/js/plugins/aos.min.js"></script>
    <script src="assets/js/plugins/jquery.instagramFeed.js"></script>
    <script src="assets/js/plugins/ajax-mail.js"></script> -->

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!--
    <script src="assets/js/wishlist.js"></script>
 
-->
  <script type="text/javascript">
      $(document).ready(function(){
        let whishstate=document.getElementsByClassName("icon-whishstate");
         $( "button" ).on( "click", function() {
                alert( "Handler for `click` called." );
          } );
                
//                $("#whishstate").click(function(){
//                 alert("External content loaded successfully!");
//                           $.ajax({
//                                      type: "POST",
//                                      url: 'AJAX/Add-To-Wishlist.php',
//                                      data: ({product_id: link_data}),
//                                      success: function(data) {
//                                           if(data == '1')
//                                           {
//                                              $('a[data-data="' + link_data + '"] > i.whishstate').css({"color":"red"})
//                                           }
//                                           else{
//                                               $('a[data-data="' + link_data + '"] > i.whishstate').css({"color":"red"})
//                                           }
//                                      }   
//                                 });
//                });
                
                
         });  
</script>
</body>



</html>