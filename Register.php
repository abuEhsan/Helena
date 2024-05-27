<?php
require_once('Links/Setting.php');

    // IN REGISTER MEMBER
if(isset($_POST['REGISTER']))
 {
        
      
        $PPH=filter_var($_POST['cust_phone'], FILTER_SANITIZE_NUMBER_INT);       
        
       
        //CHEACKED FROM ERORR INPUT DATA
        $ERORR = array();
        
        // CHEACK FROM LENGTH PHONE NUMBER 
        if(strlen($PPH) < 9){
            
            $ERORR[]=' رقم الهاتف غير مكتمل';
        }

//        $NUM_CHECKED = str_split($PPH,1);
//        if($NUM_CHECKED[0] != '0'){
//            $ERORR[]=' المعذرة، هذا الرقم ليس صالحا للاستخدام.. الرجاء كتابة رقم صحيح';
//        }
//        if($NUM_CHECKED[0] == '7' && $NUM_CHECKED[1] == '7'){
//            $ERORR[]=' شركة الاتصالات يمن مبايل مقيدة عن الاشتراك.. الرجاء ادخال رقم إحدى الشركات الأخرى';
//        }
        
        
        //IF NOT FOUNT ENY ERORR
        
        if(empty($ERORR)){}
            

    $valid = 1;

    if(empty($_POST['cust_name'])) {
        $valid = 0;
         $ERORR[]=' الأسم غير مكتمل';
//        $error_message .= LANG_VALUE_123."<br>";
    }

    if(empty($_POST['cust_email'])) {
        $valid = 0;
//        $error_message .= LANG_VALUE_131."<br>";
         $ERORR[]=' الربد فارغ';
    } else {
        if (filter_var($_POST['cust_email'], FILTER_VALIDATE_EMAIL) === false) {
            $valid = 0;
             $ERORR[]=' البريد الالكتروني غير مكتمل';
//            $error_message .= LANG_VALUE_134."<br>";
        } else {
            $statement = $dbh->prepare("SELECT * FROM tblcustomer WHERE cust_email=? AND cust_status=?");
            $statement->execute(array($_POST['cust_email'],1));
            $total = $statement->rowCount();                            
            if($total) {
                $valid = 0;
                 $ERORR[]=' الحساب مسجل مسبقا';
//                $error_message .= LANG_VALUE_147."<br>";
            }
        }
    }

   
    if( empty($_POST['cust_password']) || empty($_POST['cust_re_password']) ) {
        $valid = 0;
//        $error_message .= LANG_VALUE_138."<br>";
         $ERORR[]=' كلمة المرور فارغة';
    }

    if( !empty($_POST['cust_password']) && !empty($_POST['cust_re_password']) ) {
        if($_POST['cust_password'] != $_POST['cust_re_password']) {
            $valid = 0;
             $ERORR[]=' كلمة المرور غير متطابقة';
//            $error_message .= LANG_VALUE_139."<br>";
        }
    }

    if($valid == 1) {
        $PPS=password_hash($_POST['cust_password'], PASSWORD_DEFAULT);
        $token = md5(time());
        $cust_datetime = date('Y-m-d h:i:s');
        $cust_timestamp = time();
        
        $cust_status=0; // or cust_status=0 to verify frm email
        // saving into the database
        $statement = $dbh->prepare("INSERT INTO tblcustomer (
                                        cust_name,
                                        cust_cname,
                                        cust_email,
                                        cust_phone,
                                        cust_country,
                                        cust_address,
                                        cust_city,
                                        cust_state,
                                        cust_zip,
                                        cust_b_name,
                                        cust_b_cname,
                                        cust_b_phone,
                                        cust_b_country,
                                        cust_b_address,
                                        cust_b_city,
                                        cust_b_state,
                                        cust_b_zip,
                                        cust_s_name,
                                        cust_s_cname,
                                        cust_s_phone,
                                        cust_s_country,
                                        cust_s_address,
                                        cust_s_city,
                                        cust_s_state,
                                        cust_s_zip,
                                        cust_password,
                                        cust_token,
                                        cust_datetime,
                                        cust_timestamp,
                                        cust_status
                                    ) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
        $statement->execute(array(
                                        strip_tags($_POST['cust_name']),
                                        strip_tags($_POST['cust_cname']),
                                        strip_tags($_POST['cust_email']),
                                        strip_tags($PPH),
                                        strip_tags($_POST['cust_country']),
                                        strip_tags($_POST['cust_address']),
                                        strip_tags($_POST['cust_city']),
                                        strip_tags($_POST['cust_state']),
                                        strip_tags($_POST['cust_zip']),
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        '',
                                        $PPS,
                                        $token,
                                        $cust_datetime,
                                        $cust_timestamp,
                                        $cust_status
                                    ));
        
        //Sent verify to email
        
        //include("EMAIL/Verify-Email-Script.php");
         $to =$_POST['cust_email'];
        $BASE_URL='helleaa.com';
        $subject = 'مرحبا بكم في متجر سقس بلس';
        $text='عزيزي العميل لتفعيل حسابك لدينا يرجى تأكيد العملية من خلال النقر على الرابط الموضح';
        $verify_link = $BASE_URL.'/verify.php?email='.$to.'&token='.$token;
        $message = '
'.$text.'<br><br>

<a href="'.$verify_link.'">'.$verify_link.'</a>';

        $headers = "From: helena@" . $BASE_URL . "\r\n" .
                   "Reply-To: noreply@" . $BASE_URL . "\r\n" .
                   "X-Mailer: PHP/" . phpversion() . "\r\n" . 
                   "MIME-Version: 1.0\r\n" . 
                   "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $sent=mail($to, $subject, $message, $headers);
        
        unset($_POST['cust_name']);
        unset($_POST['cust_cname']);
        unset($_POST['cust_email']);
        unset($_POST['cust_phone']);
        unset($_POST['cust_address']);

        if(!$sent){
                $success_message=" المعذرة ... إن لم يتم ارسال رسالة تحقق لبريدك الالكتروني يرجى إعادة تسجيل بياناتك مجدد بعد 30 ثانية  ";
                echo "<script>alert('".$success_message."')</script>";
                echo "<script type='text/javascript'> document.location = 'Register.php'; </script>";
           }else{
                $success_message=" تم تسجيل بياناتك بنجاح ... الرجاء التحقق من بريدك الالكتروني لتأكيد تسجيل حسابك!";
                echo "<script>alert('".$success_message."')</script>"; 
                echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
            
           }

         }
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
                        <h3 class="breadcrumb-title"> إنشاء حساب جديد </h3>
                        <div class="breadcrumb-nav breadcrumb-nav-color--black breadcrumb-nav-hover-color--golden">
                            <nav aria-label="breadcrumb">
<!--
                                <ul>
                                    <li><a href="index.php">Home</a></li>
                                    <li><a href="shop-grid-sidebar-left.php">Shop</a></li>
                                    <li class="active" aria-current="page">Login</li>
                                </ul>
-->
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- ...:::: End Breadcrumb Section:::... -->

    <!-- ...:::: Start Customer Login Section :::... -->
    <div class="customer-login">
        <div class="container">
            <div class="row">
          
                <!--register area start-->
                <div class="col-lg-6 col-md-6">
                    <div class="account_form register" data-aos="fade-up" data-aos-delay="200">
                        <h3>إنشاء حساب</h3>
<?php if(!empty($ERORR) || !empty($erorr)){ ?>
        
        
                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                   <?php

                    foreach($ERORR as $errorAlert){
                        echo $errorAlert ."<br>";
                    }

                    echo $erorr;


                    ?>


                  </div>
<?php } ?>
                        <form action="#" method="post">
                            <div class="default-form-box">
                                <label>الأسم <span>*</span></label>
                                <input type="text" name="cust_name" required>
                            </div>
                            <div class="default-form-box">
                                <label>البريد الالكتروني <span>*</span></label>
                                <input  type="email" name="cust_email" required>
                            </div>
                            <div class="default-form-box">
                                <label>رقم الهاتف <span></span></label>
                                <input type="text" type="number" name="cust_phone" required>
                            </div>
                            <div class="default-form-box">
                                <label>كلمة المرور <span>*</span></label>
                                <input type="password" name="cust_password" required>
                            </div>
                            <div class="default-form-box">
                                <label>تأكيد كلمة المرور <span>*</span></label>
                                <input type="password" name="cust_re_password" required>
                            </div>
                            <div class="login_submit">
                                <button class="btn btn-md btn-black-default-hover" type="submit" name="REGISTER" >إشاء الحساب</button>
                                 <a href="login.php">لدي حساب مسبقا!</a>
                            </div>
                        </form>
                    </div>
                </div>
                <!--register area end-->
            </div>
        </div>
    </div> <!-- ...:::: End Customer Login Section :::... -->

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