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
    <link rel="stylesheet" href="assets/css/style.arabi.css">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo&family=El+Messiri:wght@400;500&family=Lateef:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body{
            direction: rtl; 
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


    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">المراجعة</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
<!--
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.php">Shop</a></li>
                                    <li class="active" aria-current="page">Compare</li>
                                </ul>
-->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Compare Section:::... -->
    <div class="compare-section">
        <!-- Start Cart Table -->
        <div class="compare-table-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                            <div class="table_page table-responsive compare-table">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <td class="first-column">المنتج</td>
                                            <td class="product-image-title">
                                                <a href="product-details-default.php" class="image"><img
                                                        src="assets/images/product/default/home-1/default-1.jpg"
                                                        alt="Compare Product"></a>
                                                <a href="shop-grid-sidebar-left.php" class="category">Furniture</a>
                                                <a href="product-details-default.php" class="title">Rinosin title</a>
                                            </td>
                                            <td class="product-image-title">
                                                <a href="product-details-default.php" class="image"><img
                                                        src="assets/images/product/default/home-1/default-2.jpg"
                                                        alt="Compare Product"></a>
                                                <a href="shop-grid-sidebar-left.php" class="category">Furniture</a>
                                                <a href="product-details-default.php" class="title">Macro title</a>
                                            </td>
                                            <td class="product-image-title">
                                                <a href="product-details-default.php" class="image"><img
                                                        src="assets/images/product/default/home-1/default-3.jpg"
                                                        alt="Compare Product"></a>
                                                <a href="shop-grid-sidebar-left.php" class="category">Furniture</a>
                                                <a href="product-details-default.php" class="title">Oakley title</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="first-column">الوصف</td>
                                            <td class="pro-desc">
                                                <p>Eye glasses are very important for thos whos have some difficult in
                                                    their eye to see every hing clearly and perfectly</p>
                                            </td>
                                            <td class="pro-desc">
                                                <p>Eye glasses are very important for thos whos have some difficult in
                                                    their eye to see every hing clearly and perfectly</p>
                                            </td>
                                            <td class="pro-desc">
                                                <p>Eye glasses are very important for thos whos have some difficult in
                                                    their eye to see every hing clearly and perfectly</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="first-column">السعر</td>
                                            <td class="pro-price">$295</td>
                                            <td class="pro-price">$275</td>
                                            <td class="pro-price">$395</td>
                                        </tr>
                                        <tr>
                                            <td class="first-column">اللون</td>
                                            <td class="pro-color">Black</td>
                                            <td class="pro-color">Black</td>
                                            <td class="pro-color">Black</td>
                                        </tr>
                                        <tr>
                                            <td class="first-column">Stock</td>
                                            <td class="pro-stock">In Stock</td>
                                            <td class="pro-stock">In Stock</td>
                                            <td class="pro-stock">In Stock</td>
                                        </tr>
                                        <tr>
                                            <td class="first-column">اضافة للكارد</td>
                                            <td class="pro-addtocart"><a href="#" class="btn btn-md btn-golden"
                                                    data-bs-toggle="modal" data-bs-target="#modalAddcart"><span>ADD TO
                                                        CART</span></a></td>
                                            <td class="pro-addtocart"><a href="#" class="btn btn-md btn-golden"
                                                    data-bs-toggle="modal" data-bs-target="#modalAddcart"><span>ADD TO
                                                        CART</span></a></td>
                                            <td class="pro-addtocart"><a href="#" class="btn btn-md btn-golden"
                                                    data-bs-toggle="modal" data-bs-target="#modalAddcart"><span>ADD TO
                                                        CART</span></a></td>
                                        </tr>
                                        <tr>
                                            <td class="first-column">حذف</td>
                                            <td class="pro-remove"><button><i class="fa fa-trash-o"></i></button></td>
                                            <td class="pro-remove"><button><i class="fa fa-trash-o"></i></button></td>
                                            <td class="pro-remove"><button><i class="fa fa-trash-o"></i></button></td>
                                        </tr>
                                        <tr>
                                            <td class="first-column">التقييم</td>
                                            <td class="pro-ratting">
                                                <div class="product-review">
                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                    <span class="review-empty"><i class="fa fa-star"></i></span>
                                                </div>
                                            </td>
                                            <td class="pro-ratting">
                                                <div class="product-review">
                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                    <span class="review-empty"><i class="fa fa-star"></i></span>
                                                </div>
                                            </td>
                                            <td class="pro-ratting">
                                                <div class="product-review">
                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                    <span class="review-fill"><i class="fa fa-star"></i></span>
                                                    <span class="review-empty"><i class="fa fa-star"></i></span>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Cart Table -->
    </div> <!-- ...:::: Start Compare Section:::... -->

    <br><br>
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
</body>


</html>