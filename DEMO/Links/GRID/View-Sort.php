<div class="sort-product-tab-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="tab-content tab-animate-zoom">
                    <!-- Start Grid View Product -->
                    <div class="tab-pane active show sort-layout-single" id="layout-3-grid">
                        <div class="row">

                            <?php for ($i=1; $i <=6 ; $i++) { ?>
                            <div class="col-xl-4 col-sm-6 col-12">
                                <!-- بداية عنصر واحد افتراضي للمنتج -->
                                <div class="product-default-single-item product-color--golden" data-aos="fade-up"
                                    data-aos-delay="200">
                                    <div class="image-box">
                                        <a href="product-details-default.php" class="image-link">
                                            <img src="../assets/images/product/default/home-1/default-<?php echo $i; ?>.jpg"
                                                alt="">
                                            <img src="../assets/images/product/default/home-1/default-<?php echo $i+1; ?>.jpg"
                                                alt="">
                                        </a>
                                        <div class="action-link">
                                            <div class="action-link-left">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">أضف
                                                    إلى السلة</a>
                                            </div>
                                            <div class="action-link-right">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"><i
                                                        class="icon-magnifier"></i></a>
                                                <a href="wishlist.php"><i class="icon-heart"></i></a>
                                                <a href="compare.php"><i class="icon-shuffle"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="content">
                                        <div class="content-left">
                                        <h6 class="title"><a href="product-details-default.php">كاوريت لوبورتيس ساجيت</a></h6>
                                            <ul class="review-star">
                                                <li class="fill"><i class="ion-android-star"></i></li>
                                                <li class="fill"><i class="ion-android-star"></i></li>
                                                <li class="fill"><i class="ion-android-star"></i></li>
                                                <li class="fill"><i class="ion-android-star"></i></li>
                                                <li class="empty"><i class="ion-android-star"></i></li>
                                            </ul>
                                        </div>
                                        <div class="content-right">
                                            <span class="price">$95.00</span>
                                        </div>
                                    </div>
                                </div>
                                <!-- نهاية عنصر واحد افتراضي للمنتج -->
                            </div>
                            <?php } ?>


                        </div>
                    </div> <!-- End Grid View Product -->
                    <!-- Start List View Product -->
                    <div class="tab-pane sort-layout-single" id="layout-list">
                        <div class="row">
                            <?php for ($i=5; $i < 8 ; $i++) { ?>
                            <div class="col-12">
                                <!-- بداية العرض الافتراضي للمنتج -->
                                <div class="product-list-single product-color--golden">
                                    <a href="product-details-default.php" class="product-list-img-link">
                                        <img class="img-fluid"
                                            src="../assets/images/product/default/home-1/default-<?php echo $i; ?>.jpg"
                                            alt="">
                                        <img class="img-fluid"
                                            src="../assets/images/product/default/home-1/default-<?php echo $i+1; ?>.jpg"
                                            alt="">
                                    </a>
                                    <div class="product-list-content">
                                        <h5 class="product-list-link"><a href="product-details-default.php">KAOREET
                                                LOBORTIS SAGIT</a></h5>
                                        <ul class="review-star">
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="fill"><i class="ion-android-star"></i></li>
                                            <li class="empty"><i class="ion-android-star"></i></li>
                                        </ul>
                                        <span class="product-list-price"><del>$30.12</del> $25.12</span>
                                        <p>لوريم إيبسوم دولور سيت آميت، كونسيكتيتور أديبايسينغ إليت. نوبيس آد، إيوري
                                            إنكيديونت. آب كونسيكواتور
                                            تيمبوريبوس نون إيفينيت إنفنتوري دولوريمكو نيسيسيتاتيبوس سيد، دوكيموس
                                            كويسكوام، آد أسبيريوريس</p>
                                        <div class="product-action-icon-link-list">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart"
                                                class="btn btn-lg btn-black-default-hover">أضف إلى السلة</a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#modalQuickview"
                                                class="btn btn-lg btn-black-default-hover"><i
                                                    class="icon-magnifier"></i></a>
                                            <a href="wishlist.php" class="btn btn-lg btn-black-default-hover"><i
                                                    class="icon-heart"></i></a>
                                            <a href="compare.php" class="btn btn-lg btn-black-default-hover"><i
                                                    class="icon-shuffle"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <!-- نهاية العرض الافتراضي للمنتج -->

                            </div>
                            <?php } ?>
                        </div>
                    </div> <!-- End List View Product -->
                </div>
            </div>
        </div>
    </div>
</div>