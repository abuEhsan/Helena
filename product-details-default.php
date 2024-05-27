<?php
require_once('Links/Setting.php');

    if(isset($_GET['PID']))
    {
    $ID=$_GET['PID'];
        // Add View
        $sql = "UPDATE tblproducts SET totalview=totalview+1 WHERE id='$ID';";
        $query = $dbh->prepare($sql);
        $query->execute();
        
        
    }


if(isset($_GET['W_PID']))
{
    if(!isset($_SESSION['customer'])) {
        $success_message1="المعذرة.. يجب علية تسجيل الدخول أولا لكي تتمكن من هذة الميزة";
        echo "<script>alert('".$success_message1."')</script>";
        echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
    }else{
        
        $ID=intval($_GET['W_PID']);
        $addmemberid = $_SESSION['customer']['cust_id'];
        $addproductid = $_GET['W_PID'];
        $sql="SELECT count(id) cnt FROM tblwhish_list WHERE member_id = '$addmemberid' AND product_id = '$addproductid'";
        $query = $dbh->prepare($sql);
        $query->execute();
        $results=$query->fetch();
        if($results['cnt'] == 1):
            $sql="DELETE FROM tblwhish_list WHERE member_id = '$addproductid' AND product_id = '$addmemberid'";
            $query = $dbh->prepare($sql);
            $query->execute();
            //from Database
            echo '0';
        else:
            $sql="INSERT INTO tblwhish_list SET product_id = '$addproductid', member_id = '$addmemberid'";
            $query = $dbh->prepare($sql);
            $query->execute();
            //from Database
            echo '1';
        endif;
    }
    
}
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


    <style>
    body {
        direction: rtl;

    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    a,
    ul,
    li,
    span {
        /*            font-family: 'Lateef', serif;*/
        font-family: 'Lateef';
        font-weight: bold;
    }

    .comment-form-container {
        background: #F0F0F0;
        border: #e0dfdf 1px solid;
        padding: 20px;
        border-radius: 2px;
    }

    .input-row {
        margin-bottom: 20px;
    }

    .input-field {
        width: 100%;
        border-radius: 2px;
        padding: 10px;
        border: #e0dfdf 1px solid;
    }

    .btn-submit {
        padding: 10px 20px;
        background: #333;
        border: #1d1d1d 1px solid;
        color: #f0f0f0;
        font-size: 0.9em;
        width: 100px;
        border-radius: 2px;
        cursor: pointer;
    }

    ul {
        list-style-type: none;
    }

    .comment-row {
        border-bottom: #e0dfdf 1px solid;
        margin-bottom: 15px;
        padding: 15px;
    }

    .outer-comment {
        padding: 10px;
        border: #dedddd 1px solid;
        background: #FFF;
    }

    span.commet-row-label {
        font-style: italic;
    }

    span.posted-by {
        color: #09F;
    }

    .comment-info {
        font-size: 0.8em;
    }

    .comment-text {
        margin: 10px 0px;
    }

    .btn-reply {
        font-size: 0.8em;
        text-decoration: underline;
        color: #888787;
        cursor: pointer;
    }

    #comment-message {
        margin-left: 20px;
        color: #189a18;
        display: none;
    }

    .like-unlike {
        vertical-align: text-bottom;
        cursor: pointer;
    }

    .post-action {
        margin-top: 15px;
        font-size: 0.8em;
    }

    span.posted-at {
        color: #929292;
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
                        <h3 class="breadcrumb-title">تفاصيل المنتج</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                <!--
                                <ul>
                                    <li><a href="index.php">الرئيسية</a></li>
                                    <li><a href="shop-grid-sidebar-left.php">المتجر</a></li>
                                    <li class="active" aria-current="page">تفاصيل المنتج</li>
                                </ul>
-->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->
    <?php
      

    $sql = "SELECT p.id,p.Name AS PN,p.Icon,p.about,p.price,p.price,p.current_price,p.CurrencyId,p.qualty,p.alt,p.CreateDate,c.Name AS CN,c.Image\n"

    . "FROM tblproducts p\n"

    . "JOIN tblcategory c ON p.CategoryId = c.ID\n"

    . "WHERE p.Status = 1 AND c.Status=1  AND p.id={$ID}";

$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{    
   $ICON=$DirUPLOADIN_Uploads_File_Products.$result->Icon;
?>
    <!-- Start Product Details Section -->
    <div class="product-details-section">
        <div class="container">
            <div class="row">

                <div class="col-xl-5 col-lg-6">
                    <div class="product-details-gallery-area" data-aos="fade-up" data-aos-delay="0">
                        <!-- Start Large Image -->
                        <div class="product-large-image product-large-image-horaizontal swiper-container">
                            <div class="swiper-wrapper"><?php
     
        $sqlim2 = "SELECT * FROM `tbldetailsimages` WHERE proid ='$ID';";
        $query2 = $dbh->prepare($sqlim2);
        $query2->execute();
        $resultsim=$query2->fetchAll(PDO::FETCH_OBJ);
        if($query2->rowCount() > 0)
        {
            foreach($resultsim as $resultim)
            { $DIR = $DirUPLOADIN_Uploads_File_Products.$resultim->images;
                echo "<div class='product-image-large-image swiper-slide zoom-image-hover img-responsive'><img src='ADMIN/UPLOADING/Uploads-Files-Products/'".$resultim->images."' alt=''></div>";
            }
        }else{
           //ICON DEFULT
            echo"<div class='product-image-large-image swiper-slide zoom-image-hover img-responsive'><img src='ADMIN/UPLOADING/Uploads-Files-Products/'".$ICON."' alt='' ></div>"; 
        }
   
    
                     ?></div>
                        </div>
                        <!-- End Large Image -->
                        <!-- Start Thumbnail Image -->
                        <div
                            class="product-image-thumb product-image-thumb-horizontal swiper-container pos-relative mt-5">
                            <div class="swiper-wrapper"><?php
        $sqlim3 = "SELECT * FROM `tbldetailsimages` WHERE proid ='$ID';";
        $query3 = $dbh->prepare($sqlim3);
        $query3->execute();
        $resultsim=$query3->fetchAll(PDO::FETCH_OBJ);
        if($query3->rowCount() > 0)
        {
            foreach($resultsim as $resultim)
            {  
                $DIR=$DirUPLOADIN_Uploads_File_Products.$resultim->images;
                echo"<div class='product-image-thumb-single swiper-slide'>"." <img src='".$DIR."' alt='' >"."</div>"; 
            }
        }
        //ICON DEFULT
   
                            ?></div>
                            <!-- Add Arrows -->
                            <div class="gallery-thumb-arrow swiper-button-next"></div>
                            <div class="gallery-thumb-arrow swiper-button-prev"></div>
                        </div>
                        <!-- End Thumbnail Image -->
                    </div>
                </div>
                <div class="col-xl-7 col-lg-6">
                    <div class="product-details-content-area product-details--golden" data-aos="fade-up"
                        data-aos-delay="200">
                        <!-- Start  Product Details Text Area-->
                        <div class="product-details-text">
                            <h4 class="title"><?php echo $result->CN." | ".$result->PN;?></h4>
                            <div class="d-flex align-items-center">
                                <!--
                                <ul class="review-star">
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="fill"><i class="ion-android-star"></i></li>
                                    <li class="empty"><i class="ion-android-star"></i></li>
                                </ul>
                                <a href="#" class="customer-review ml-2">( تقييم العملاء  )</a>
-->
                            </div>
                            <div class="price"><?php
$sql2 = "SELECT Name from tblcurrncy WHERE ID ='$result->CurrencyId' ";
$query = $dbh->prepare($sql2);
$query->execute();
$results2=$query->fetch();
echo htmlentities($result->price)." ".$results2['Name'];
                                                          

                                ?></div>
                            <p><?php echo $result->about ?></p>
                        </div> <!-- End  Product Details Text Area-->
                        <!-- Start Product Variable Area -->
                        <div class="product-details-variable">
                            <h4 class="title">الإجراءات</h4>

                            <!-- Product Variable Single Item -->
                            <div class="d-flex align-items-center ">
                                <!--
                                <div class="variable-single-item ">
                                    <span>Quantity</span>
                                    <div class="product-variable-quantity">
                                        <input min="1" max="100" value="1" type="number">
                                    </div>
                                </div>
-->

                                <div class="product-add-to-cart-btn"><?php
//BUTTON ADD TO CART
if (isset($_SESSION['cart_p_id']) && in_array($result->PID, $_SESSION['cart_p_id'])) {
    echo " <a > تمت الاضافة  </a>";
}else if($result->qualty <= '0'){
    echo " <a> <span style='color:red;'> الكمية نفذة </span> </a>";
}else{
    echo " <a  href='Add-To-Cart.php?PID=".$result->PID."' class='btn btn-block btn-lg btn-black-default-hover'> + إضافة للسلة </a>";
}
    
                            ?> </div>
                            </div>
                            <!-- Start  Product Details Meta Area-->
                            <div class="product-details-meta mb-20">
                                <div id="output">
                                    <img src='./assets/images/IMG-LIKE/like.png' />
                                </div>
                                <br>
                                <a class="icon-space-right"
                                    href="product-details-default.php?W_PID=<?php echo $result->PID; ?>">
                                    <i class="icon-heart" style="margin-left: 3%; float:rigth;" id="whishstate"></i>
                                    إضافة للمفضلات
                                </a>

                            </div> <!-- End  Product Details Meta Area-->
                        </div> <!-- End Product Variable Area -->

                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End Product Details Section -->
    <?php }} ?>
    <!-- Start Product Default Slider Section -->
    <?php include("Links/Related-Products-Section.php"); ?>
    <!-- End Product Default Slider Section -->
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
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/reView-Systems.js"></script>
    <script src="assets/js/addLike_And_Unlike.js"></script>





</body>


</html>