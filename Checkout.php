<?php
require_once('Links/Setting.php');
if(!isset($_SESSION['cart_p_id'])) {
    header('location: Cart.php');
    exit;
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
/*            font-family: 'Lateef', serif;*/
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

    <!-- Offcanvas Overlay -->
    <div class="offcanvas-overlay"></div>

  
    <!-- ...:::: Start Breadcrumb Section:::... -->
    <div class="breadcrumb-section breadcrumb-bg-color--golden">
        <div class="breadcrumb-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="breadcrumb-title">إكمال عملية الدفع</h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
<!--
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.php">Shop</a></li>
                                    <li class="active" aria-current="page">Checkout</li>
                                </ul>
-->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Checkout Section:::... -->
    <div class="checkout-section">
        <div class="container">
        
         <?php if(!isset($_SESSION['customer'])): ?>
            <div class="row">
                <!-- User Quick Action Form -->
                <div class="col-12">
                    <div class="user-actions accordion" data-aos="fade-up" data-aos-delay="0">
                        <h3>
                            <i class="fa fa-file-o" aria-hidden="true"></i>
                            المعذة..يجب عليك تسجيل الدخول أولا
<!--
                            <a class="Returning" href="#" data-bs-toggle="collapse" data-bs-target="#checkout_login"
                                aria-expanded="true">تسجيل الدخول</a>
-->
                             <a class="Returning" href="login.php" >تسجيل الدخول</a>
                        </h3>
                        <div id="checkout_login" class="collapse" data-parent="#checkout_login">
                            <div class="checkout_info">
                                <p>العمعذرة.. يجب عليك تسجيل الدخول لحسابك لكي تتمكن من عملية الشر!</p>
                                <form action="#">
                                    <div class="form_group default-form-box">
                                        <label>البريد الالكتروني <span>*</span></label>
                                        <input type="email" name="EM" required>
                                    </div>
                                    <div class="form_group default-form-box">
                                        <label>كلمة المرور <span>*</span></label>
                                        <input type="password" name="PS" required>
                                    </div>
                                    <div class="form_group group_3 default-form-box">
                                        <button class="btn btn-md btn-black-default-hover" type="submit" name="LoginInSide">تسجيل الدخول</button>
                                       
                                    </div>
                                    <a href="#"> هل نسيت كلمة المرور؟</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- User Quick Action Form -->
            </div>
        <?php else: ?>
        
            <!-- Start User Details Checkout Form -->
            <div class="checkout_form" data-aos="fade-up" data-aos-delay="400">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                            <h3>تفاصيل الفاتورة</h3>
                            <div class="row">
                                        <div class="col-lg-6">
                                                <div class="default-form-box">
                                                    <label>إسم المستلم <span></span></label>
                                                    <input type="text" name="cust_b_name"  id="name" placeholder="إسمك" value="<?php echo $_SESSION['customer']['cust_b_name']; ?>" disabled>
                                                </div>
                                            </div>
                                        <div class="col-12">
                                                <div class="default-form-box">
                                                    <label>اسم النشاط </label>
                                                    <input type="text" id="name" placeholder="اسم النشاط" name="cust_b_cname" value="<?php echo $_SESSION['customer']['cust_b_cname']; ?>" disabled >
                                                </div>
                                            </div>
                                        <div class="col-12">
                                                <div class="select_form_select default-form-box">
                                                    <label for="countru_name">الدولة <span></span></label>
                                                    
                                                    <select class="niceselect_option wide" name="cust_b_country"
                                                        id="countru_name" disabled><?php
                                                            $statement = $dbh->prepare("SELECT * FROM tblcountry WHERE ID=2");
                                                            $statement->execute();
                                                            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                            foreach ($result as $row) {
                                                                ?>
                                                                <option value="<?php echo $row['ID']; ?>" <?php if($row['ID'] == $_SESSION['customer']['cust_s_country']) {echo 'selected';} ?>><?php echo $row['Name']; ?></option>
                                                            <?php }

                                    
                                                ?></select>
                                                </div>
                                            </div>
                                        <div class="col-12">
                                                <div class="default-form-box">
                                                    <label>المحافظة <span></span></label>
                                                    <input  type="text" name="cust_b_city" value="<?php echo $_SESSION['customer']['cust_b_city']; ?>" placeholder="المدينة" disabled>
                                                </div>
                                            </div>     
                                        <div class="col-12">
                                                <div class="default-form-box">
                                                    <label>المديرية <span></span></label>
                                                    <input type="text" name="cust_b_state" value="<?php echo $_SESSION['customer']['cust_b_state']; ?>" placeholder="الحي" disabled>
                                                </div>
                                            </div>
                                        <div class="col-lg-6">
                                                <div class="default-form-box">
                                                    <label>رقم الهاتف<span></span></label>
                                                    <input type="text" id="phone" placeholder="رقم هانفك " name="cust_b_phone" value="<?php echo $_SESSION['customer']['cust_b_phone']; ?>" max="9" disabled>
                                                </div>
                                            </div>
                                        <div class="col-lg-6">
                                                <div class="default-form-box">
                                                    <label> عنوان السكن <span></span></label>
                                                    <input type="text" value="<?php if($_SESSION['customer']['cust_b_address']) {
                                                        echo $_SESSION['customer']['cust_b_address']; 
                                                        }else{
                                                          echo "معلومات وتفاصيل أخرى لمنزل المستلم";
                                                        }
                                                    ?>"  disabled>
                                                </div>
                                            </div>
<!--
                                <div class="col-12">
                                    <label class="checkbox-default" for="newAccount" data-bs-toggle="collapse"
                                        data-bs-target="#newAccountPassword">
                                        <input type="checkbox" id="newAccount">
                                        <span style="float: left;">إنشاء حساب؟</span>
                                    </label>
                                    <div id="newAccountPassword" class="collapse mt-3"
                                        data-parent="#newAccountPassword">
                                        <div class="card-body1 default-form-box">
                                            <label> Account password <span>*</span></label>
                                            <input placeholder="password" type="password">
                                        </div>
                                    </div>
                                </div>
-->
                                <form action="UpdateBill.php" method="post" >
                                <div class="col-12">
                                    <label class="checkbox-default" for="newShipping" data-bs-toggle="collapse"
                                        data-bs-target="#anotherShipping">
                                        <input type="checkbox" id="newShipping">
                                        <span style="float: left;">الشحن لعنوان مختلف؟</span>
                                    </label>

                                    <div id="anotherShipping" class="collapse mt-3" data-parent="#anotherShipping">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="default-form-box">
                                                    <label>إسم المستلم <span>*</span></label>
                                                    <input type="text" name="cust_b_name"  id="name" placeholder="إسمك" value="<?php echo $_SESSION['customer']['cust_b_name']; ?>" required>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="default-form-box">
                                                    <label>اسم النشاط </label>
                                                    <input type="text" id="name" placeholder="اسم النشاط" name="cust_b_cname" value="<?php echo $_SESSION['customer']['cust_b_cname']; ?>" >
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="select_form_select default-form-box">
                                                    <label for="countru_name">الدولة <span>*</span></label>
                                                    
                                                    <select class="niceselect_option wide" name="cust_b_country"
                                                        id="countru_name"><?php
                                                    $statement = $dbh->prepare("SELECT * FROM tblcountry WHERE ID=2");
                                                    $statement->execute();
                                                    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                                    foreach ($result as $row) {
                                                        ?>
                                                        <option value="<?php echo $row['ID']; ?>" <?php if($row['ID'] == $_SESSION['customer']['cust_s_country']) {echo 'selected';} ?>><?php echo $row['Name']; ?></option>
                                                        <?php }
                                       
                                    
                                                ?></select>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="default-form-box">
                                                    <label>المحافظة <span>*</span></label>
                                                    <input  type="text" name="cust_b_city" value="<?php echo $_SESSION['customer']['cust_b_city']; ?>" placeholder="المدينة" required>
                                                </div>
                                            </div>
                                        
                                            <div class="col-12">
                                                <div class="default-form-box">
                                                    <label>المديرية <span>*</span></label>
                                                    <input type="text" name="cust_b_state" value="<?php echo $_SESSION['customer']['cust_b_state']; ?>" placeholder="الحي" required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="default-form-box">
                                                    <label>رقم الهاتف<span>*</span></label>
                                                    <div class="col-lg-6">
                                                    <input type="text" id="phone" placeholder="رقم هانفك " name="cust_b_phone" value="<?php echo $_SESSION['customer']['cust_b_phone']; ?>" max="9" required>
                                                </div>
                                            </div>
                                                <div class="default-form-box">
                                                    <label> عنوان السكن <span>*</span></label>
                                                    <input type="text" value="<?php if($_SESSION['customer']['cust_b_address']) {
                                                        echo $_SESSION['customer']['cust_b_address']; 
                                                        }else{
                                                          echo "معلومات وتفاصيل أخرى لمنزل المستلم";
                                                        }
                                                    ?>" name="cust_b_address" required>
                                                </div>
                                            </div>
                                            <div class="order_button pt-3">
                                                <button class="btn btn-md btn-black-default-hover" type="submit" name="UPDATE_BILL">تحديث الفاتورة</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <div class="order-notes">
                                        <label for="order_note">ملاحظة الطلب</label>
                                        <textarea id="order_note"
                                            placeholder="أضف ملاحظاتك للطلب وآلية التوصيل والتسليم"></textarea>
                                    </div>
                                </div>
                                </form>
                                
                            </div>
                    
                    </div>
                    <div class="col-lg-6 col-md-6">
                        
                            <h3>طلبك</h3>
                            <div class="order_table table-responsive">
                                <style>
                                    tr{
                                        text-align: right;
                                    }
                                </style>
                                <table dir="rtl" >
                                    <thead >
                                        <tr>
                                            <th>المنتج</th>
                                            <th>الصورة</th>
                                            <th>السعر</th>
                                            <th>العدد</th>
                                            <th>الاجمالي</th>
                                        </tr>
                                    </thead><?php
                                    
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
                                    ?><tbody>
                                    <?php for($i=1;$i<=count($arr_cart_p_id);$i++): ?>
                                     <tr>
                                     <td><?php 
                                         
                                         echo $arr_cart_p_name[$i];
                                         
                                         ?></td>
                                      <td>
                                            <img width="50" src="<?php echo $DirUPLOADIN_Uploads_File_Products.$arr_cart_p_featured_photo[$i]; ?>" alt="">
                                       </td>
                                        <td><?php 
                                         
                                         echo $arr_cart_p_current_price[$i];
                                         
                                         ?></td>
                                         <td><?php 
                                         
                                         echo $arr_cart_p_qty[$i];
                                         
                                         ?></td>
                                         <td><?php 
                                         
                                                $row_total_price = $arr_cart_p_current_price[$i]*$arr_cart_p_qty[$i];
                                                 $table_total_price = $table_total_price + $row_total_price;
                                                 echo $row_total_price;
                                         
                                         ?></td>
                                    </tr>
                                    <?php endfor; ?>
                                    </tbody>
                                     <tfoot>
                                        <tr>
                                            <th>القيمة المضافة</th>
                                            <td colspan="4"><center><?php 
                                                //Price Service
                                                  $Delevery=0;
                                                 echo  $Delevery;
                                            ?></center></td>
                                        </tr>
                                        <tr>
                                            <th>المشتريات</th>
                                            <td colspan="4"><center><?php echo $table_total_price; ?></center></td>
                                        </tr>
                                        <tr class="order_total">
                                            <th>إجمالي الفاتورة</th>
                                            <td colspan="4"><strong>
                                                <center><?php echo $table_total_price+$Delevery; ?></center>
                                                </strong></td>
                                        </tr>
                                    </tfoot>
                               
                                </table>
                            </div>
                            
                            <div class="payment_method" >
                                <!-- Start payment_method -->
                                <div class="panel-default">
                                 <form action="payment/bank/init.php" method="post" id="bank_form">
                                    <input type="hidden" name="amount" value="<?php echo $table_total_price; ?>">
                                    <label class="checkbox-default act" for="currencyCod" data-bs-toggle="collapse"
                                        data-bs-target="#methodCod" >
                                        <input type="radio" id="currencyCod" >
                                        <span style="float: left;" active >الدفع بالإيداع البنكي</span>
                                    </label>
                                    <div id="methodCod" class="collapse" data-parent="#methodCod" style="margin: 1%; padding: 2%;">
                                        <div class="card-body1" >
                                              <div class="col-lg-6 ">
                                                  <h4> الايداع للحساب البنكي</h4>
                                                   <p>
                                                    الرجال ارسال رقم الحوالة لحسابنا المصرفي.
                                                     <span>  لن يتم شحن طلب مالم يتم التحقق من من عملية الدفع</span>
                                                   </p>

                                                    <h6>الحسابات البنكية</h6>
<!--                                                    <p><strong>بنك الأهلي - رقم الحساب: </strong> SA77 100 0011 100 0548 8001</p>-->
                                                    <p><strong>بنك الأهلي - الآيبان: </strong> SA77 100 0011 100 0548 8001</p>
                                            </div>
                                               <div class="col-12 mt-3">
                                                    <label for="order_note">يرجى كتابة التفاصيل في هذا الحقل  <strong style="color:red;">*</strong></label>
                                                    <div class="order-notes">
                                                        <textarea id="order_note" placeholder="أضف تفاصيل عملية الإداع ( رقم عملية الايداع  )" name="transaction_info" required></textarea>
                                                    </div>
                                                </div>
                                        </div>
                                        <div class="order_button pt-3">
                                            <input class="btn btn-md btn-black-default-hover" type="submit" name="form3" value="تأكيد الدفع">
                                        </div>
                                    </div>
                                 </form>
                                </div>
                                 <!-- End payment_method -->
                                <!-- Start payment_method -->
<!--
                                <div class="panel-default">
                                    <label class="checkbox-default" for="currencyDev" data-bs-toggle="collapse"
                                        data-bs-target="#methodDev" data-parent="#methodDev" style="margin: 1%; padding: 2%;">
                                        <input type="radio" id="currencyDev">
                                        <span style="float: left;">الدفع عند التوصيل</span>
                                    </label>

                                    <div id="methodDev" class="collapse" data-parent="#methodDev">
                                        <div class="card-body1">
                                              <div class="col-lg-6 ">
                                                  <h4>الدفع عن التوصيل</h4>
                                                   <p>
                                                        عند تسليمك الطلب الخاصة بك يرجى دفع ملغ الفاتورة كاملا مع رسوم الخدمات الاضافية
                                                   </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
-->
                                 <!-- End payment_method -->
                               
<!--
                                <div class="panel-default">
                                    <label class="checkbox-default" for="currencyPaypal" data-bs-toggle="collapse"
                                        data-bs-target="#methodPaypal">
                                        <input type="checkbox" id="currencyPaypal">
                                        <span style="float: left;">PayPal</span>
                                    </label>
                                    <div id="methodPaypal" class="collapse " data-parent="#methodPaypal">
                                        <div class="card-body1">
                                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a
                                                PayPal account.</p>
                                        </div>
                                    </div>
                                </div>
-->
                                
                            </div>
                        
                    </div>
                </div>
            </div> 
            <!-- Start User Details Checkout Form -->
        <?php endif; ?>
        </div>
    </div><!-- ...:::: End Checkout Section:::... -->
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
    <script>
      
//      	function confirmDelete()
//	{
//	    return confirm("هل أنت متأكد من حذف البيانات؟");
//	}
//	$(document).ready(function () {
//		advFieldsStatus = $('#').val();
//
//		$('#paypal_form').hide();
//		$('#stripe_form').hide();
//		$('#bank_form').hide();
//
//        $('#advFieldsStatus').on('change',function() {
//            advFieldsStatus = $('#advFieldsStatus').val();
//            if ( advFieldsStatus == '' ) {
//            	$('#paypal_form').hide();
//				$('#stripe_form').hide();
//				$('#bank_form').hide();
//            } else if ( advFieldsStatus == 'PayPal' ) {
//               	$('#paypal_form').show();
//				$('#stripe_form').hide();
//				$('#bank_form').hide();
//            } else if ( advFieldsStatus == 'Stripe' ) {
//               	$('#paypal_form').hide();
//				$('#stripe_form').show();
//				$('#bank_form').hide();
//            } else if ( advFieldsStatus == 'Bank Deposit' ) {
//            	$('#paypal_form').hide();
//				$('#stripe_form').hide();
//				$('#bank_form').show();
//            }
//        });
//	});

   
  </script>
</body>


</html>