
  <?php /* ?><div class="hero-slider-section">
        <!-- Slider main container -->
        <div class="hero-slider-active swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <!-- Start Hero Single Slider Item -->
                <div class="hero-single-slider-item swiper-slide">
                    <!-- Hero Slider Image -->
                    <div class="hero-slider-bg">
                        <img src="assets/images/hero-slider/home-1/hero-slider1.jpg" alt="">
                    </div>
                    <!-- Hero Slider Content -->
                    <div class="hero-slider-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="hero-slider-content">
                                        <h4 class="subtitle">العرض السادس</h4>
                                        <h2 class="title">كافة ادوات ومستلزمات القهوة </h2>
                                        <p>توصيل مجاني داخل العاصمة الرياض</p>
                                        <a href="#" class="btn btn-lg btn-outline-golden">تسوق الآن </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Hero Single Slider Item -->
                
           
            </div>

            <!-- If we need pagination -->
            <div class="swiper-pagination active-color-golden"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev d-none d-lg-block"></div>
            <div class="swiper-button-next d-none d-lg-block"></div>
        </div>
    </div><?php */ ?>


    

    
  <div class="hero-slider-section">
        <!-- Slider main container -->
        <div class="hero-slider-active swiper-container">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper"><?php
           
           $sql = "SELECT * FROM tblpayment WHERE customer_email='{$_SESSION['customer']['cust_email']}' ORDER BY id DESC";
           $query = $dbh->prepare($sql);
           $query->execute();
           $results=$query->fetchAll(PDO::FETCH_OBJ);
           $cnt=0;
           if($query->rowCount() > 0)
           {
           foreach($results as $result)
           {                    
           ?>


                <!-- Start Hero Single Slider Item -->
                <div class="hero-single-slider-item swiper-slide">
                    <!-- Hero Slider Image -->
                    <div class="hero-slider-bg">
                    <img src="<?php echo $DirUPLOADIN_Uploads_File_Adds.phpentities($result->Image);?>" alt="">
                        <!-- <img src="assets/images/hero-slider/home-1/hero-slider1.jpg" alt=""> -->
                    </div>
                    <!-- Hero Slider Content -->
                    <div class="hero-slider-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="hero-slider-content">
                                        <!-- <h4 class="subtitle">العرض السادس</h4>
                                        <h2 class="title">كافة ادوات ومستلزمات القهوة </h2>
                                        <p>توصيل مجاني داخل العاصمة الرياض</p>
                                        <a href="#" class="btn btn-lg btn-outline-golden">تسوق الآن </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Hero Single Slider Item -->
                
           
            <?php }}else{?>
            
            
             <!-- Start Hero Single Slider Item -->
             <div class="hero-single-slider-item swiper-slide">
                    <!-- Hero Slider Image -->
                    <div class="hero-slider-bg">
                    <img src="<?php echo  $DirassetsImage.$LOGO; ?>" alt="">
                        <!-- <img src="assets/images/hero-slider/home-1/hero-slider1.jpg" alt=""> -->
                    </div>
                    <!-- Hero Slider Content -->
                    <div class="hero-slider-wrapper">
                        <div class="container">
                            <div class="row">
                                <div class="col-auto">
                                    <div class="hero-slider-content">
                                        <!-- <h4 class="subtitle">العرض السادس</h4>
                                        <h2 class="title">كافة ادوات ومستلزمات القهوة </h2>
                                        <p>توصيل مجاني داخل العاصمة الرياض</p>
                                        <a href="#" class="btn btn-lg btn-outline-golden">تسوق الآن </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- End Hero Single Slider Item -->
            
            <?php } ?></div>

            <!-- If we need pagination -->
            <div class="swiper-pagination active-color-golden"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev d-none d-lg-block"></div>
            <div class="swiper-button-next d-none d-lg-block"></div>
        </div>
    </div>