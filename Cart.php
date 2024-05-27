<?php
require_once('Links/Setting.php');


//WHENE CART IS EMPTY
$Title='';
 if(!isset($_SESSION['cart_p_id'])): 
                                
            $Title.='<h4 class="text-center">المعذرة .. السلة فارغة يجب إضافة منتجات في السلة لمشاهدها هنا!</h4>';

            $DisplayCard=0; 

    else:
            $Title.='<h4 class="text-center">جميع المنتجات التي بسلة المشتريات</h4>';
            $DisplayCard=1; 
            $DisplayImage=1; 
            $DisplayButton=1; 

endif;

$error_message = '';
if(isset($_POST['form1'])) {

    $i = 0;
    $statement = $dbh->prepare("SELECT * FROM tblproducts");
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $row) {
        $i++;
        $table_product_id[$i] = $row['id'];
        $table_quantity[$i] = $row['qualty'];
    }

    $i=0;
    foreach($_POST['product_id'] as $val) {
        $i++;
        $arr1[$i] = $val;
    }
    $i=0;
    foreach($_POST['quantity'] as $val) {
        $i++;
        $arr2[$i] = $val;
    }
    $i=0;
    foreach($_POST['product_name'] as $val) {
        $i++;
        $arr3[$i] = $val;
    }
    
    $allow_update = 1;
    for($i=1;$i<=count($arr1);$i++) {
        for($j=1;$j<=count($table_product_id);$j++) {
            if($arr1[$i] == $table_product_id[$j]) {
                $temp_index = $j;
                break;
            }
        }
        if($table_quantity[$temp_index] < $arr2[$i]) {
        	$allow_update = 0;
//            $error_message .= '"'.$arr2[$i].'" لا يتوفر من العنصر سوى  "'.$arr3[$i].'"\n';
        $error_message .='المعذرة.. كمية هذا العنصر محدودة لا يمكن الإضافة '.'"\n';
        } else {
            $_SESSION['cart_p_qty'][$i] = $arr2[$i];
        }
    }
    $error_message .= '\nتم تحديث المنتج بنجا!';
    
    
    if($allow_update == 0): 
        echo "<script>alert('".$error_message."');</script>";
        echo "<script type='text/javascript'> document.location = 'Cart.php'; </script>";
     else:
        echo "<script>alert('".$error_message."');</script>";
        echo "<script type='text/javascript'> document.location = 'Cart.php'; </script>";
    endif;
 
}
    
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
            .checkbox-default{
/*            background-color: aqua;*/
            padding: 2%;
            width: 32% ;
            
            }
            h1,h2,h3,h4,h5,h6,a,ul,li,span{
            font-family: 'Lateef', serif;
            font-family: 'Lateef';
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


    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">الكارد</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
                                 <?php 
                                
                                
                                    if($DisplayImage == 0){

                                        echo "<img class='img-fluid' src='assets/images/emprt-cart/empty-cart.png' alt=''>";
                                        echo "<br>".$Title."<br>";
                                        echo" <a href='index.php' class='btn btn-lg btn-golden'>متابعة التسوق</a>";
                                        
                                    }else{
                                        
                                        echo "<br>".$Title."<br>";
                                        echo" <a href='index.php' class='btn btn-lg btn-golden'>متابعة التسوق</a>";
                                        
                                    }
                                
                               ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->
<?php if($DisplayCard == 1 ){ ?>
    <!-- ...:::: Start Cart Section:::... -->
    <div class="cart-section">
        <!-- Start Cart Table -->
        <div class="cart-table-wrapper" data-aos="fade-up" data-aos-delay="0">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="table_desc">
                             <form action="" method="post" class="col-md-12">
                                <div class="table_page table-responsive">
                                    <table>
                                        <!-- Start Cart Table Head -->
                                        <thead>
                                            <tr>
                                                <th class="product_thumb">صورة</th>
                                                <th class="product_name">المنتج</th>
                                                <th class="product-price">القيمة</th>
                                                <th class="product_quantity">الكمية</th>
                                                <th class="product_total">الإجمالي</th>
                                                <th class="product_remove">حذف</th>
                                            </tr>
                                        </thead> <!-- End Cart Table Head -->
                                        <?php
                                                $table_total_price = 0;

                                                $i=0;
                                                foreach($_SESSION['cart_p_id'] as $key => $value) 
                                                {
                                                    $i++;
                                                    $arr_cart_p_id[$i] = $value;
                                                }


                                                $i=0;
                                                foreach($_SESSION['cart_p_qty'] as $key => $value) 
                                                {
                                                    $i++;
                                                    $arr_cart_p_qty[$i] = $value;
                                                }

                                                $i=0;
                                                foreach($_SESSION['cart_p_current_price'] as $key => $value) 
                                                {
                                                    $i++;
                                                    $arr_cart_p_current_price[$i] = $value;
                                                }

                                                $i=0;
                                                foreach($_SESSION['cart_p_name'] as $key => $value) 
                                                {
                                                    $i++;
                                                    $arr_cart_p_name[$i] = $value;
                                                }

                                                $i=0;
                                                foreach($_SESSION['cart_p_featured_photo'] as $key => $value) 
                                                { 
                                                    $i++;
                                                    $arr_cart_p_featured_photo[$i] = $value;
                                                }
                                        ?>
                                        <tbody>
                                            <!-- Start Cart Single Item-->
                                        <?php for($i=1;$i<=count($arr_cart_p_id);$i++): ?>
                                            <tr>
                                                <td class="product_thumb">
                                                    <a href="product-details-default.php?PID=<?php echo $arr_cart_p_id[$i]; ?>">
                                                    <img src="<?php echo $DirUPLOADIN_Uploads_File_Products.$arr_cart_p_featured_photo[$i]; ?>"
                                                            alt="">
                                                    </a>
                                                </td>
                                                <td class="product_name"><a href="product-details-default.php?PID=<?php echo $arr_cart_p_id[$i]; ?>"><?php echo $arr_cart_p_name[$i]; ?></a></td>
                                                <td class="product-price"><?php echo $arr_cart_p_current_price[$i]; ?></td>
                                                <td class="product_quantity"><label>العدد</label> 
<!--                                                    <input min="1"max="100" value="2" type="number">-->
                                                    <input type="hidden"  name="product_id[]" value="<?php echo $arr_cart_p_id[$i]; ?>">
                                                    <input type="hidden" name="product_name[]" value="<?php echo $arr_cart_p_name[$i]; ?>">
                                                    <input type="number" width="20px" step="1" min="1" max="" name="quantity[]" value="<?php echo $arr_cart_p_qty[$i]; ?>" title="الكمية" size="4" pattern="[0-9]*" inputmode="numeric">
                   
                                                </td>
                                                <td class="product_total"><?php
                                                    $row_total_price = $arr_cart_p_current_price[$i]*$arr_cart_p_qty[$i];
                                                    $table_total_price = $table_total_price + $row_total_price;
                                                    echo $row_total_price;
                                                ?></td>
                                                <td class="product_remove">
                                                    <a onclick="return confirmDelete();" href="cart-item-delete.php?PID=<?php echo $arr_cart_p_id[$i]; ?>">
                                                     <i class="fa fa-trash-o"></i>
                                                    </a>
                                                </td>
                                            </tr> <!-- End Cart Single Item-->
                                    <?php endfor; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="cart_submit">
                                    <button class="btn btn-md btn-golden" type="submit" name="form1">تحديث الكارد</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Cart Table -->

        <!-- Start Coupon Start -->
        <div class="coupon_area">
            <div class="container">
                <div class="row">
<!--
                    <div class="col-lg-6 col-md-6">
                        <div class="coupon_code left" data-aos="fade-up" data-aos-delay="200">
                            <h3>الكوبون</h3>
                            <div class="coupon_inner">
                                <p>ادخل كود الخصم الخاص بك</p>
                                <input class="mb-2" placeholder="Coupon code" type="text" disabled>
                                <button type="submit" class="btn btn-md btn-golden" disabled>تطبيق </button>
                            </div>
                        </div>
                    </div>
-->
                    <div class="col-lg-6 col-md-6">
                        <div class="coupon_code right" data-aos="fade-up" data-aos-delay="400">
                            <h3>إجمالي الكارد</h3>
                            <div class="coupon_inner">
                                <div class="cart_subtotal">
                                    <p>القيمة الاضافية</p>
                                    <p class="cart_amount"><?php 
                                        //Price Service
                                        $Delevery=0;
                                        echo  $Delevery;
                                 ?></p>
                                </div>
                                <div class="cart_subtotal ">
                                    <p>قيمة المشتريات</p>
                                    <p class="cart_amount"><span></span><?php 
                                        echo $table_total_price; 
                                        ?></p>
                                </div>
                                <a href="#">حساب التسوق</a>

                                <div class="cart_subtotal">
                                    <p>الإجمالي</p>
                                    <p class="cart_amount"><?php 
                                        echo $table_total_price+$Delevery; 
                                    ?></p>
                                </div>
                                <div class="checkout_btn">
                                    <a href="Checkout.php" class="btn btn-md btn-golden">تأكيد الشراء</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- End Coupon Start -->
    </div> 
    <!-- ...:::: End Cart Section:::... -->
<?php } ?>
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
 
