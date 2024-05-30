<?php
require_once('Links/Setting.php');
?>
<!DOCTYPE html>
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


    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
    <link rel="stylesheet" href="assets/css/style.arabi.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo&family=El+Messiri:wght@400;500&family=Lateef:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">

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

    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">من نحن</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <ul>
                                    <li><a href="index.php">الرئيسية</a></li>
                                    <li><a href="#">الصفحات</a></li>
                                    <li class="active" aria-current="page">من نحن</li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- Start About Top -->
    <div class="about-top">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-between d-sm-column">
                <div class="col-md-6">
                    <div class="about-img" data-aos="fade-up" data-aos-delay="0">
                        <div class="img-responsive">
                            <img src="assets/images/about/img-about.jpg" alt="عن المتجر">
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="content" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="title">عن متجرنا</h3>
                        <h5 class="semi-title">نؤمن بأن كل مشروع في العالم الرقمي هو نتيجة لفكرة وكل فكرة لها سبب.</h5>
                        <p>لهذا السبب، كل تصميم لدينا يخدم فكرة. قوتنا في التصميم تنعكس في اسمنا، واهتمامنا بالتفاصيل. متخصصونا لا يخشون الذهاب إلى أميال إضافية فقط للاقتراب من الكمال. نحن لا نطلب أن يكون كل شيء مثاليًا، لكننا نحتاج إلى أن يتم الاهتمام بكل شيء بعناية. هذا هو السبب في أننا مستعدون لتقديم أفضل ما لدينا. لا يتم تفويت أي تفصيل تحت أعين محترفي بيللي. مقدار التفاني والجهد يساوي مستوى الشغف والعزم. لنتحسن معًا كفريق واحد.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About Top -->

    <!-- Start Slill Progress -->
    <div class="progressbar-section section-top-gap-100 section-inner-bg">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <div class="content" data-aos="fade-up" data-aos-delay="0">
                        <h4 class="title">التصميم المثالي</h4>
                        <p>في هذا العصر، لا يمكن التقليل من أهمية التصميم، فن إنشاء مرئيات مذهلة لتحريك وجذب جمهورك. ومع تقدم العالم نحو الرقمنة، ازدادت أهمية التصميم الجرافيكي بشكل كبير.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="custom-progress m-t-40">
                        <div class="skill-progressbar" data-aos="fade-up" data-aos-delay="0">
                            <h6 class="font--semi-bold m-b-15">جودة المنتجات</h6>
                            <div class="line-progressbar" data-percentage="95" data-progress-color="#b19361"></div>
                        </div>
                        <div class="skill-progressbar" data-aos="fade-up" data-aos-delay="200">
                            <h6 class="font--semi-bold m-b-15">تنوع التصاميم</h6>
                            <div class="line-progressbar" data-percentage="90" data-progress-color="#b19361"></div>
                        </div>
                        <div class="skill-progressbar" data-aos="fade-up" data-aos-delay="400">
                            <h6 class="font--semi-bold m-b-15">خدمة العملاء</h6>
                            <div class="line-progressbar" data-percentage="98" data-progress-color="#b19361"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Slill Progress -->

    <!-- Start Service Section -->
    <div class="service-promo-section section-top-gap-100">
        <div class="service-wrapper">
            <div class="container">
                <div class="row">
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="0">
                            <div class="image">
                                <img src="assets/images/icons/icon_about1.jpg" alt="إبداع دائم">
                            </div>
                            <div class="content">
                                <h6 class="title">إبداع دائم</h6>
                                <p>حافظ على إبداعك مع مجموعة كبيرة من العناصر والأنماط والتأثيرات الجاهزة.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="200">
                            <div class="image">
                                <img src="assets/images/icons/icon_about2.jpg" alt="تخصيص سريع">
                            </div>
                            <div class="content">
                                <h6 class="title">تخصيص سريع</h6>
                                <p>سهل التثبيت وتكوين التخصيص ببضع نقرات فقط.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="400">
                            <div class="image">
                                <img src="assets/images/icons/icon_about3.jpg" alt="تكامل متميز">
                            </div>
                            <div class="content">
                                <h6 class="title">تكامل متميز</h6>
                                <p>تكامل الإضافات المتميزة هو السلاح السري لازدهار عملك.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                    <!-- Start Service Promo Single Item -->
                    <div class="col-lg-3 col-sm-6 col-12">
                        <div class="service-promo-single-item" data-aos="fade-up" data-aos-delay="600">
                            <div class="image">
                                <img src="assets/images/icons/icon_about4.jpg" alt="تحرير في الوقت الفعلي">
                            </div>
                            <div class="content">
                                <h6 class="title">تحرير في الوقت الفعلي</h6>
                                <p>يعد التحرير في الوقت الفعلي تجربة أساسية للمستخدم.</p>
                            </div>
                        </div>
                    </div>
                    <!-- End Service Promo Single Item -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Service Section -->

    <!--  Start  Team Section    -->
    <div class="team-section section-top-gap-100 secton-fluid section-inner-bg">
        <!-- Start Section Content Text Area -->
        <div class="section-title-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-content-gap">
                            <div class="secton-content text-center">
                                <h3 class="section-title">Meet Our Team</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Section Content Text Area -->
        <div class="team-wrapper">
            <div class="container">
                <div class="row mb-n6">
                    <div class="col-xl-3 mb-5">
                        <div class="team-single" data-aos="fade-up" data-aos-delay="0">
                            <div class="team-img">
                                <img class="img-fluid" src="assets/images/team/leader1.png" alt="">
                            </div>
                            <div class="team-content">
                                <h6 class="team-name font--bold mt-5">Ms. Veronica</h6>
                                <span class="team-title">Web Designer</span>
                                <ul class="team-social pos-absolute">
                                    <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                    <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                    <li><a href="#"><i class="ion-social-instagram"></i></a></li>
                                    <li><a href="#"><i class="ion-social-linkedin"></i></a></li>
                                    <li><a href="#"><i class="ion-social-rss"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 mb-5">
                        <div class="team-single" data-aos="fade-up" data-aos-delay="200">
                            <div class="team-img">
                                <img class="img-fluid" src="assets/images/team/leader2.png" alt="">
                            </div>
                            <div class="team-content">
                                <h6 class="team-name font--bold mt-5">Missa Santos</h6>
                                <span class="team-title">CEO Founder</span>
                                <ul class="team-social pos-absolute">
                                    <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                    <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                    <li><a href="#"><i class="ion-social-instagram"></i></a></li>
                                    <li><a href="#"><i class="ion-social-linkedin"></i></a></li>
                                    <li><a href="#"><i class="ion-social-rss"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 mb-5">
                        <div class="team-single" data-aos="fade-up" data-aos-delay="400">
                            <div class="team-img">
                                <img class="img-fluid" src="assets/images/team/leader3.png" alt="">
                            </div>
                            <div class="team-content">
                                <h6 class="team-name font--bold mt-5">Missa Santos</h6>
                                <span class="team-title">Chief Officer</span>
                                <ul class="team-social pos-absolute">
                                    <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                    <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                    <li><a href="#"><i class="ion-social-instagram"></i></a></li>
                                    <li><a href="#"><i class="ion-social-linkedin"></i></a></li>
                                    <li><a href="#"><i class="ion-social-rss"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-3 mb-5">
                        <div class="team-single" data-aos="fade-up" data-aos-delay="600">
                            <div class="team-img">
                                <img class="img-fluid" src="assets/images/team/leader4.png" alt="">
                            </div>
                            <div class="team-content">
                                <h6 class="team-name font--bold mt-5">Lisa Antonia</h6>
                                <span class="team-title">CTO</span>
                                <ul class="team-social pos-absolute">
                                    <li><a href="#"><i class="ion-social-facebook"></i></a></li>
                                    <li><a href="#"><i class="ion-social-twitter"></i></a></li>
                                    <li><a href="#"><i class="ion-social-instagram"></i></a></li>
                                    <li><a href="#"><i class="ion-social-linkedin"></i></a></li>
                                    <li><a href="#"><i class="ion-social-rss"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--   End  Team Section   -->

    <!-- Start Company Logo Section -->
    <div class="company-logo-section section-top-gap-100 section-fluid">
        <div class="company-logo-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="company-logo-slider default-slider-nav-arrow">
                            <!-- Slider main container -->
                            <div class="swiper-container company-logo-slider">
                                <!-- Additional required wrapper -->
                                <div class="swiper-wrapper">
                                    <!-- Start Company Logo Single Item -->
                                    <div class="company-logo-single-item swiper-slide">
                                        <div class="image"><img class="img-fluid"
                                                src="assets/images/company-logo/company-logo-1.png" alt=""></div>
                                    </div>
                                    <!-- End Company Logo Single Item -->
                                    <!-- Start Company Logo Single Item -->
                                    <div class="company-logo-single-item swiper-slide">
                                        <div class="image"><img class="img-fluid"
                                                src="assets/images/company-logo/company-logo-2.png" alt=""></div>
                                    </div>
                                    <!-- End Company Logo Single Item -->
                                    <!-- Start Company Logo Single Item -->
                                    <div class="company-logo-single-item swiper-slide">
                                        <div class="image"><img class="img-fluid"
                                                src="assets/images/company-logo/company-logo-3.png" alt=""></div>
                                    </div>
                                    <!-- End Company Logo Single Item -->
                                    <!-- Start Company Logo Single Item -->
                                    <div class="company-logo-single-item swiper-slide">
                                        <div class="image"><img class="img-fluid"
                                                src="assets/images/company-logo/company-logo-4.png" alt=""></div>
                                    </div>
                                    <!-- End Company Logo Single Item -->
                                    <!-- Start Company Logo Single Item -->
                                    <div class="company-logo-single-item swiper-slide">
                                        <div class="image"><img class="img-fluid"
                                                src="assets/images/company-logo/company-logo-5.png" alt=""></div>
                                    </div>
                                    <!-- End Company Logo Single Item -->
                                    <!-- Start Company Logo Single Item -->
                                    <div class="company-logo-single-item swiper-slide">
                                        <div class="image"><img class="img-fluid"
                                                src="assets/images/company-logo/company-logo-6.png" alt=""></div>
                                    </div>
                                    <!-- End Company Logo Single Item -->
                                    <!-- Start Company Logo Single Item -->
                                    <div class="company-logo-single-item swiper-slide">
                                        <div class="image"><img class="img-fluid"
                                                src="assets/images/company-logo/company-logo-7.png" alt=""></div>
                                    </div>
                                    <!-- End Company Logo Single Item -->
                                    <!-- Start Company Logo Single Item -->
                                    <div class="company-logo-single-item swiper-slide">
                                        <div class="image"><img class="img-fluid"
                                                src="assets/images/company-logo/company-logo-8.png" alt=""></div>
                                    </div>
                                    <!-- End Company Logo Single Item -->
                                </div>
                            </div>
                            <!-- If we need navigation buttons -->
                            <div class="swiper-button-prev d-none d-md-block"></div>
                            <div class="swiper-button-next d-none d-md-block"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Company Logo Section -->

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
   
    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
</body>



</html>