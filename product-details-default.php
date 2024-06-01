<?php

require_once('Links/Setting.php');

    if(isset($_GET['PID']))
    {
        
        $product_id = $_GET['PID'];  // تأكد من تعقيم هذا المدخل لمنع حقن SQL

        // Add View
        $sql = "UPDATE tblproducts SET totalview=totalview+1 WHERE id='$product_id';";
        $query = $dbh->prepare($sql);
        $query->execute();


      

        $sql = "SELECT p.id, p.Name AS ProductName, p.Icon, p.about, p.price, p.current_price, p.CurrencyId, p.qualty, p.alt, p.CreateDate, c.Name AS CategoryName, c.Image
                FROM tblproducts p
                JOIN tblcategory c ON p.CategoryId = c.ID
                WHERE p.Status = 1 AND c.Status = 1 AND p.id = :product_id";
        
        $query = $dbh->prepare($sql);
        $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        
        if($query->rowCount() > 0) {
            // Fetch Products Data
            $product_data = $results;
        
            // Fetch Other Images Products
            $sql = "SELECT images FROM tbldetailsimages WHERE proid = :product_id";
            $query = $dbh->prepare($sql);
            $query->bindParam(':product_id', $product_id, PDO::PARAM_INT);
            $query->execute();
            $results = $query->fetchAll(PDO::FETCH_OBJ);
        
            if($query->rowCount() > 0) {
                $product_images = $results;
            } else {
                echo "No product Images found";
            }
        } else {
            echo "No product found";
        }
        

        
    }
    
    
?>
<!DOCTYPE html>
<html lang="zxx">


<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>DEMO || TARIQ BAOBIED MARKTING</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Lemonada:wght@300..700&family=Readex+Pro:wght@160..700&family=Tajawal:wght@200;300;400;500;700;800;900&display=swap"
        rel="stylesheet">

    <!-- ::::::::::::::Favicon icon::::::::::::::-->
    <link rel="shortcut icon" href="assets/images/logo/logoipsum-332.svg" type="image/svg">

    <!-- ::::::::::::::All CSS Files here :::::::::::::: -->
    <!-- Vendor CSS -->
    <link rel="stylesheet" href="assets/css/vendor/ionicons.css">
    <link rel="stylesheet" href="assets/css/vendor/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/vendor/simple-line-icons.css">
    <link rel="stylesheet" href="assets/css/vendor/jquery-ui.min.css">

    <!-- Plugin CSS -->
    <link rel="stylesheet" href="assets/css/plugins/animate.min.css">
    <link rel="stylesheet" href="assets/css/plugins/swiper-bundle.min.css">
    <link rel="stylesheet" href="assets/css/plugins/nice-select.css">
    <link rel="stylesheet" href="assets/css/plugins/venobox.min.css">
    <link rel="stylesheet" href="assets/css/plugins/jquery.lineProgressbar.css">
    <link rel="stylesheet" href="assets/css/plugins/aos.min.css">

    <!-- Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!-- <link rel="stylesheet" href="assets/css/vendor/vendor.min.css">
    <link rel="stylesheet" href="assets/css/plugins/plugins.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css"> -->
    <style>
    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    p,
    a,
    li,
    span,
    button {
        font-family: "Tajawal", sans-serif;
        font-weight: bold;
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
                        <h3 class="breadcrumb-title">التفاصيل - تفاصيل المنتج</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <!-- <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.php">Shop</a></li>
                                    <li class="active" aria-current="page">Product Details Default</li>
                                </ul> -->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- Start Product Details Section -->
    <div class="product-details-section">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-6" dir="ltr">
                    <div class="product-details-gallery-area" data-aos="fade-up" data-aos-delay="0">
                        <!-- Start Large Image -->
                        <div class="product-large-image product-large-image-horaizontal swiper-container">
                            <div class="swiper-wrapper">
                                <?php
                            if (!empty($product_data)) {
                                foreach ($product_data as $product) {
                                    if (!empty($product->Icon)) {
                                        echo '<div class="product-image-large-image swiper-slide zoom-image-hover img-responsive">';
                                        echo '<img src="ADMIN/UPLOADING/Uploads-Files-Products/' . $product->Icon . '" alt="">';
                                        echo '</div>';
                                    }
                                }
                            }
                            ?>
                            </div>
                        </div>
                        <!-- End Large Image -->
                        <!-- Start Thumbnail Image -->
                        <div
                            class="product-image-thumb product-image-thumb-horizontal swiper-container pos-relative mt-5">
                            <div class="swiper-wrapper">
                                <?php
                            if (!empty($product_images)) {
                                foreach ($product_images as $product) {
                                    if (!empty($product->images)) {
                                        echo '<div class="product-image-thumb-single swiper-slide">';
                                        echo '<img class="img-fluid" src="ADMIN/UPLOADING/Uploads-Files-Products/Details/' . $product->images . '" alt="">';
                                        echo '</div>';
                                    }
                                }
                            }
                            ?>
                            </div>
                            <!-- Add Arrows -->
                            <div class="gallery-thumb-arrow swiper-button-next"></div>
                            <div class="gallery-thumb-arrow swiper-button-prev"></div>
                        </div>
                        <!-- End Thumbnail Image -->
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6" dir="rtl">
                    <div class="product-details-content-area product-details--golden" data-aos="fade-up"
                        data-aos-delay="200">
                        <!-- Start Product Details Text Area-->
                        <div class="product-details-text">
                            <h4 class="title"><?php echo $product_data[0]->ProductName; ?></h4>
                            <div class="d-flex align-items-center">
                                <ul class="review-star">
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="empty"><i class="ion-android-star"></i></li>
                                </ul>
                                <a href="#" class="customer-review ml-2">(مراجعة العميل)</a>
                            </div>
                            <div class="price">$<?php echo $product_data[0]->price; ?></div>
                            <p><?php echo $product_data[0]->about; ?></p>
                        </div> <!-- End Product Details Text Area-->
                        <!-- Start Product Variable Area -->
                        <div class="product-details-variable">
                            <h4 class="title">Available Options</h4>
                            <!-- Product Variable Single Item -->
                            <div class="variable-single-item">
                                <div class="product-stock"> <span class="product-stock-in"><i
                                            class="ion-checkmark-circled"></i></span>
                                    <?php echo $product_data[0]->qualty; ?> في المخزون</div>
                            </div>
                            <!-- Product Variable Single Item -->
                            <div class="d-flex align-items-center ">
                                <div class="variable-single-item ">
                                    <span>الكمية</span>
                                    <div class="product-variable-quantity">
                                        <input min="1" max="100" value="1" type="number">
                                    </div>
                                </div>
                                <div class="product-add-to-cart-btn">
                                    <a href="#" class="btn btn-block btn-lg btn-black-default-hover"
                                        data-bs-toggle="modal" data-bs-target="#modalAddcart">+ أضف إلى السلة</a>
                                </div>
                            </div>
                            <!-- Start Product Details Meta Area-->
                            <div class="product-details-meta mb-20">
                                <a href="wishlist.php" class="icon-space-right"><i class="icon-heart"></i>أضف إلى قائمة
                                    الرغبات</a>
                            </div> <!-- End Product Details Meta Area-->
                        </div> <!-- End Product Variable Area -->

                        <!-- Start Product Details Catagories Area-->
                        <div class="product-details-catagory mb-2">
                            <span class="title">الفئات:</span>
                            <ul>
                                <li><a href="#"><?php echo $product_data[0]->CategoryName; ?></a></li>
                            </ul>
                        </div> <!-- End Product Details Catagories Area-->
                        <!-- Start Product Details Social Area-->
                        <div class="product-details-social">
                            <span class="title">شارك هذا المنتج:</span>
                            <ul>
                                <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('https://yourwebsite.com/product-page-url'); ?>"
                                        target="_blank"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('https://yourwebsite.com/product-page-url'); ?>"
                                        target="_blank"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="https://pinterest.com/pin/create/button/?url=<?php echo urlencode('https://yourwebsite.com/product-page-url'); ?>&media=<?php echo urlencode('https://yourwebsite.com/path-to-image.jpg'); ?>&description=<?php echo urlencode($product_data[0]->ProductName); ?>"
                                        target="_blank"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="https://plus.google.com/share?url=<?php echo urlencode('https://yourwebsite.com/product-page-url'); ?>"
                                        target="_blank"><i class="fa fa-google-plus"></i></a></li>
                                <li><a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode('https://yourwebsite.com/product-page-url'); ?>&title=<?php echo urlencode($product_data[0]->ProductName); ?>&summary=<?php echo urlencode($product_data[0]->about); ?>&source=<?php echo urlencode('Your Website Name'); ?>"
                                        target="_blank"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div> <!-- End Product Details Social Area-->

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Product Details Section -->

    <!-- Start Product Content Tab Section -->
    <div class="product-details-content-tab-section section-top-gap-100" dir="rtl">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="product-details-content-tab-wrapper" data-aos="fade-up" data-aos-delay="0">

                        <!-- Start Product Details Tab Button -->
                        <ul class="nav tablist product-details-content-tab-btn d-flex justify-content-center">
                            <li><a class="nav-link active" data-bs-toggle="tab" href="#description">الوصف</a></li>
                            <!-- <li><a class="nav-link" data-bs-toggle="tab" href="#specification">Specification</a></li>
                            <li><a class="nav-link" data-bs-toggle="tab" href="#review">المراجعات (1)</a></li> -->
                        </ul> <!-- End Product Details Tab Button -->

                        <!-- Start Product Details Tab Content -->
                        <div class="product-details-content-tab">
                            <div class="tab-content">
                                <!-- Start Product Details Tab Content Single -->
                                <div class="tab-pane active show" id="description">
                                    <div class="single-tab-content-item">
                                        <p><?php echo $product_data[0]->about; ?></p>
                                    </div>
                                </div> <!-- End Product Details Tab Content Single -->
                                <!-- Start Product Details Tab Content Single -->
                                <div class="tab-pane" id="specification">
                                    <div class="single-tab-content-item">
                                        <p><?php echo $product_data[0]->about; ?></p>
                                    </div>
                                </div> <!-- End Product Details Tab Content Single -->
                                <!-- Start Product Details Tab Content Single -->
                                <div class="tab-pane" id="review">
                                    <div class="single-tab-content-item">
                                        <!-- Start - Review Comment -->
                                        <ul class="comment">
                                            <li class="comment-list">
                                                <div class="comment-wrapper">
                                                    <div class="comment-img">
                                                        <img src="assets/images/user/image-1.png" alt="">
                                                    </div>
                                                    <div class="comment-content">
                                                        <div class="comment-content-top">
                                                            <div class="comment-content-left">
                                                                <h6 class="comment-name">حسن</h6>
                                                                <ul class="review-star">
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="fill"><i class="ion-android-star"></i>
                                                                    </li>
                                                                    <li class="empty"><i class="ion-android-star"></i>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="comment-content-right">
                                                                <a href="#"><i class="fa fa-reply"></i>رد</a>
                                                            </div>
                                                        </div>

                                                        <div class="para-content">
                                                            <p>منتج جيد بشكل عام، الجودة مناسبة للسعر.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul> <!-- End - Review Comment -->
                                        <!-- Start Add Review Form -->
                                        <div class="review-form">
                                            <div class="review-form-text-top">
                                                <h5>أضف مراجعة</h5>
                                            </div>

                                            <form action="submit_review.php" method="POST">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="default-form-box">
                                                            <label for="name">الاسم</label>
                                                            <input id="name" name="name" type="text">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="default-form-box">
                                                            <label for="email">البريد الإلكتروني</label>
                                                            <input id="email" name="email" type="email">
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="default-form-box">
                                                            <label for="review">مراجعتك</label>
                                                            <textarea id="review" name="review" cols="30"
                                                                rows="10"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <button class="btn btn-md btn-black-default-hover"
                                                            type="submit">إرسال</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div> <!-- End Add Review Form -->
                                    </div>
                                </div> <!-- End Product Details Tab Content Single -->
                            </div>
                        </div> <!-- End Product Details Tab Content -->
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Product Content Tab Section -->


    <!-- Start Product Related Default Slider Section -->
    <?php include('Links/Related-Products-Section.php'); ?>
    <!-- End Product Related Default Slider Section -->

    <!-- Start Footer Section -->
    <?php  include("Links/Footer-Section.php"); ?>
    <!-- End Footer Section -->

    <!-- material-scrolltop button -->
    <button class="material-scrolltop" type="button"></button>

    <!-- Start Modal Add cart -->
    <div class="modal fade" id="modalAddcart" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="modal-add-cart-product-img">
                                            <img class="img-fluid"
                                                src="assets/images/product/default/home-1/default-1.jpg" alt="">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="modal-add-cart-info"><i class="fa fa-check-square"></i>Added to cart
                                            successfully!</div>
                                        <div class="modal-add-cart-product-cart-buttons">
                                            <a href="cart.php">View Cart</a>
                                            <a href="checkout.php">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-5 modal-border">
                                <ul class="modal-add-cart-product-shipping-info">
                                    <li> <strong><i class="icon-shopping-cart"></i> There Are 5 Items In Your
                                            Cart.</strong></li>
                                    <li> <strong>TOTAL PRICE: </strong> <span>$187.00</span></li>
                                    <li class="modal-continue-button"><a href="#" data-bs-dismiss="modal">CONTINUE
                                            SHOPPING</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Add cart -->

    <!-- Start Modal Quickview cart -->
    <div class="modal fade" id="modalQuickview" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col text-right">
                                <button type="button" class="close modal-close" data-bs-dismiss="modal"
                                    aria-label="Close">
                                    <span aria-hidden="true"> <i class="fa fa-times"></i></span>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="product-details-gallery-area mb-7">
                                    <!-- Start Large Image -->
                                    <div class="product-large-image modal-product-image-large swiper-container">
                                        <div class="swiper-wrapper">
                                            <div class="product-image-large-image swiper-slide img-responsive">
                                                <img src="assets/images/product/default/home-1/default-1.jpg" alt="">
                                            </div>
                                            <div class="product-image-large-image swiper-slide img-responsive">
                                                <img src="assets/images/product/default/home-1/default-2.jpg" alt="">
                                            </div>
                                            <div class="product-image-large-image swiper-slide img-responsive">
                                                <img src="assets/images/product/default/home-1/default-3.jpg" alt="">
                                            </div>
                                            <div class="product-image-large-image swiper-slide img-responsive">
                                                <img src="assets/images/product/default/home-1/default-4.jpg" alt="">
                                            </div>
                                            <div class="product-image-large-image swiper-slide img-responsive">
                                                <img src="assets/images/product/default/home-1/default-5.jpg" alt="">
                                            </div>
                                            <div class="product-image-large-image swiper-slide img-responsive">
                                                <img src="assets/images/product/default/home-1/default-6.jpg" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Large Image -->
                                    <!-- Start Thumbnail Image -->
                                    <div
                                        class="product-image-thumb modal-product-image-thumb swiper-container pos-relative mt-5">
                                        <div class="swiper-wrapper">
                                            <div class="product-image-thumb-single swiper-slide">
                                                <img class="img-fluid"
                                                    src="assets/images/product/default/home-1/default-1.jpg" alt="">
                                            </div>
                                            <div class="product-image-thumb-single swiper-slide">
                                                <img class="img-fluid"
                                                    src="assets/images/product/default/home-1/default-2.jpg" alt="">
                                            </div>
                                            <div class="product-image-thumb-single swiper-slide">
                                                <img class="img-fluid"
                                                    src="assets/images/product/default/home-1/default-3.jpg" alt="">
                                            </div>
                                            <div class="product-image-thumb-single swiper-slide">
                                                <img class="img-fluid"
                                                    src="assets/images/product/default/home-1/default-4.jpg" alt="">
                                            </div>
                                            <div class="product-image-thumb-single swiper-slide">
                                                <img class="img-fluid"
                                                    src="assets/images/product/default/home-1/default-5.jpg" alt="">
                                            </div>
                                            <div class="product-image-thumb-single swiper-slide">
                                                <img class="img-fluid"
                                                    src="assets/images/product/default/home-1/default-6.jpg" alt="">
                                            </div>
                                        </div>
                                        <!-- Add Arrows -->
                                        <div class="gallery-thumb-arrow swiper-button-next"></div>
                                        <div class="gallery-thumb-arrow swiper-button-prev"></div>
                                    </div>
                                    <!-- End Thumbnail Image -->
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-product-details-content-area">
                                    <!-- Start  Product Details Text Area-->
                                    <div class="product-details-text">
                                        <h4 class="title">Nonstick Dishwasher PFOA</h4>
                                        <div class="price"><del>$70.00</del>$80.00</div>
                                    </div> <!-- End  Product Details Text Area-->
                                    <!-- Start Product Variable Area -->
                                    <div class="product-details-variable">
                                        <!-- Product Variable Single Item -->
                                        <div class="variable-single-item">
                                            <span>Color</span>
                                            <div class="product-variable-color">
                                                <label for="modal-product-color-red">
                                                    <input name="modal-product-color" id="modal-product-color-red"
                                                        class="color-select" type="radio" checked>
                                                    <span class="product-color-red"></span>
                                                </label>
                                                <label for="modal-product-color-tomato">
                                                    <input name="modal-product-color" id="modal-product-color-tomato"
                                                        class="color-select" type="radio">
                                                    <span class="product-color-tomato"></span>
                                                </label>
                                                <label for="modal-product-color-green">
                                                    <input name="modal-product-color" id="modal-product-color-green"
                                                        class="color-select" type="radio">
                                                    <span class="product-color-green"></span>
                                                </label>
                                                <label for="modal-product-color-light-green">
                                                    <input name="modal-product-color"
                                                        id="modal-product-color-light-green" class="color-select"
                                                        type="radio">
                                                    <span class="product-color-light-green"></span>
                                                </label>
                                                <label for="modal-product-color-blue">
                                                    <input name="modal-product-color" id="modal-product-color-blue"
                                                        class="color-select" type="radio">
                                                    <span class="product-color-blue"></span>
                                                </label>
                                                <label for="modal-product-color-light-blue">
                                                    <input name="modal-product-color"
                                                        id="modal-product-color-light-blue" class="color-select"
                                                        type="radio">
                                                    <span class="product-color-light-blue"></span>
                                                </label>
                                            </div>
                                        </div>
                                        <!-- Product Variable Single Item -->
                                        <div class="d-flex align-items-center flex-wrap">
                                            <div class="variable-single-item ">
                                                <span>Quantity</span>
                                                <div class="product-variable-quantity">
                                                    <input min="1" max="100" value="1" type="number">
                                                </div>
                                            </div>

                                            <div class="product-add-to-cart-btn">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modalAddcart">Add To
                                                    Cart</a>
                                            </div>
                                        </div>
                                    </div> <!-- End Product Variable Area -->
                                    <div class="modal-product-about-text">
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia iste
                                            laborum ad impedit pariatur esse optio tempora sint ullam autem deleniti nam
                                            in quos qui nemo ipsum numquam, reiciendis maiores quidem aperiam, rerum vel
                                            recusandae</p>
                                    </div>
                                    <!-- Start  Product Details Social Area-->
                                    <div class="modal-product-details-social">
                                        <span class="title">SHARE THIS PRODUCT</span>
                                        <ul>
                                            <li><a href="#" class="facebook"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#" class="twitter"><i class="fa fa-twitter"></i></a></li>
                                            <li><a href="#" class="pinterest"><i class="fa fa-pinterest"></i></a></li>
                                            <li><a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
                                            </li>
                                            <li><a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>

                                    </div> <!-- End  Product Details Social Area-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Modal Quickview cart -->

    <!-- ::::::::::::::All JS Files here :::::::::::::: -->
    <!-- Global Vendor, plugins JS -->
    <script src="assets/js/vendor/modernizr-3.11.2.min.js"></script>
    <script src="assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="assets/js/vendor/jquery-migrate-3.3.0.min.js"></script>
    <script src="assets/js/vendor/popper.min.js"></script>
    <script src="assets/js/vendor/bootstrap.min.js"></script>
    <script src="assets/js/vendor/jquery-ui.min.js"></script>

    <!--Plugins JS-->
    <script src="assets/js/plugins/swiper-bundle.min.js"></script>
    <script src="assets/js/plugins/material-scrolltop.js"></script>
    <script src="assets/js/plugins/jquery.nice-select.min.js"></script>
    <script src="assets/js/plugins/jquery.zoom.min.js"></script>
    <script src="assets/js/plugins/venobox.min.js"></script>
    <script src="assets/js/plugins/jquery.waypoints.js"></script>
    <script src="assets/js/plugins/jquery.lineProgressbar.js"></script>
    <script src="assets/js/plugins/aos.min.js"></script>
    <script src="assets/js/plugins/jquery.instagramFeed.js"></script>
    <script src="assets/js/plugins/ajax-mail.js"></script>

    <!-- Use the minified version files listed below for better performance and remove the files listed above -->
    <!-- <script src="assets/js/vendor/vendor.min.js"></script>
    <script src="assets/js/plugins/plugins.min.js"></script> -->

    <!-- Main JS -->
    <script src="assets/js/main.js"></script>
</body>


</html>