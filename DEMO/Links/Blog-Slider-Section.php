<div class="blog-default-slider-section section-top-gap-100 section-fluid">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="section-content">
                                <h3 class="section-title">أحدث المدونات</h3>
                                <p>قدّم المقالات بأفضل طريقة لتسليط الضوء على لحظات مثيرة في مدونتك.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Start Section Content Text Area -->
        <div class="blog-wrapper" data-aos="fade-up" data-aos-delay="200">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="blog-default-slider default-slider-nav-arrow">
                            <!-- Slider main container -->
                            <div class="swiper-container blog-slider">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Start Product Default Single Item -->
                                    <?php for($i=1; $i < 6; $i++){ ?>
                                        <div class="blog-default-single-item blog-color--green swiper-slide">
                                           <div class="image-box">
                                                <a href="blog-single-sidebar-left.php" class="image-link">
                                                    <img class="img-fluid" src="../assets/images/blog/blog-grid-home-1-img-<?php echo $i; ?>.jpg" alt="">
                                                </a>
                                            </div>
                                            <div class="content">
                                                <h6 class="title"><a href="blog-single-sidebar-left.php">مدونة المشاركة الأولى</a></h6>
                                                <p>تطلعات جديدة حول مستحضرات التجميل الفرنسية والصنية المتقدمة صناعة ، تنتج افضل مجموعة اعمال في مجال التجميل </p>
                                                <div class="inner">
                                                    <a href="blog-single-sidebar-left.php" class="read-more-btn icon-space-left">اقرأ المزيد <span><i
                                                                class="ion-ios-arrow-thin-right"></i></span></a>
                                                    <div class="post-meta">
                                                        <a href="#" class="date">24 أبريل</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                    <!-- End Product Default Single Item -->
                                </div>
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev"></div>
                            <div class="swiper-button-next"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>