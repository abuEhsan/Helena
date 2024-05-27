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
            $statement = $dbh->prepare("SELECT * FROM tblcustomer WHERE cust_email=? AND cust_status='1'");
            $statement->execute(array($_POST['cust_email']));
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
        //include("Links/Email.php");


       
        $to =$_POST['cust_email'];
        $BASE_URL='suqiplus.com';
        $subject = 'مرحبا بكم في متجر سقس بلس';
        $text='عزيزي العميل لتفعيل حسابك لدينا يرجى تأكيد العملية من خلال النقر على الرابط الموضح';
        $verify_link = $BASE_URL.'/verify.php?email='.$to.'&token='.$token;
        $message = '
'.$text.'<br><br>

<a href="'.$verify_link.'">'.$verify_link.'</a>';

        $headers = "From: Suqiplus@" . $BASE_URL . "\r\n" .
                   "Reply-To: noreply@" . $BASE_URL . "\r\n" .
                   "X-Mailer: PHP/" . phpversion() . "\r\n" . 
                   "MIME-Version: 1.0\r\n" . 
                   "Content-Type: text/html; charset=ISO-8859-1\r\n";
        
        // Sending Email
        mail($to, $subject, $message, $headers);


        unset($_POST['cust_name']);
        unset($_POST['cust_cname']);
        unset($_POST['cust_email']);
        unset($_POST['cust_phone']);
        unset($_POST['cust_address']);
//        unset($_POST['cust_city']);
//        unset($_POST['cust_state']);
//        unset($_POST['cust_zip']);
           // Send email for confirmation of the account
        
           $success_message="تمت تسجيل عضويتك  بنجاح .. قم بادخل بيانات الدخول الى لوحة التحكم الخاصة بك  "; 
           $success_message="تمت تسجيل عضويتك  بنجاح .. يرجى التحقق من بريدك الالكتروني لتفعيل الحساب  "; 
//         Automatcly dirctory to Dashbarde
            echo "<script>alert('".$success_message."');</script>";
            echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
         }
}
    
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo htmlentities($MetaTitleHome);?></title>
  <meta content="<?php echo htmlentities($MetaDescriptionHome);?>" name="description">
  <meta content="<?php echo htmlentities($MetaKeywordHome);?>" name="keywords">
  <!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cairo&family=El+Messiri:wght@400;500&family=Lateef:wght@600&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Variables CSS Files. Uncomment your preferred color scheme -->
   <?php include("Links/Setup-Color-Page.php");  ?>

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/style-arabic.css" rel="stylesheet">
  <style>
      body{
          background-color:#F0F2F2 ;
      }
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 
    {
      font-family: 'Cairo';  
      color: var(--color-black) ;
    }

      
</style>
</head>
<body>
      <main id="main">
 
        <div class="container">
              <div class="row justify-content-center">
                <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center"><?php
$sql = "SELECT Name,Icon,Domain FROM `tblcompnydata` limit 1;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
  
 
              ?><div class="d-flex justify-content-center py-4">
                <a href="login.php" class="logo d-flex align-items-center w-auto">
                  <span class="d-none d-lg-block" style="font-family: 'Cairo';"><?php //echo htmlentities($CNAME); ?> </span>
                    <span > <img width="40" height="40" src="<?php echo $DirassetsImage.htmlentities($ICON);?>" alt="<?php echo htmlentities($CNAME);?>"></span>
                </a>
              </div><!-- End Logo -->
<?php }} ?>

                  <div class="card mb-3">

                    <div class="card-body">

                      <div class="pt-4 pb-2">
                        <h5 class="card-title text-center pb-0 fs-4">إنشاء حساب</h5>
                        <p class="text-center small">يرجى ملئ جميع البيانات الأساسية</p>
                      </div>
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
                      <form class="row g-3 needs-validation" method="post" novalidate>
                          
                        <div class="col-12">
                          <label for="yourName" class="form-label">اسمك </label>
                          <input type="text" name="cust_name" class="form-control" id="yourName" required>
                          <div class="invalid-feedback">المعذرة، يرجى ملئ الحقل</div>
                        </div>

                        <div class="col-12">
                          <label for="yourEmail" class="form-label">البيريد الإلكتروني</label>
                          <input type="email" name="cust_email" class="form-control" id="yourEmail" required>
                          <div class="invalid-feedback">المعذرة، يرجى ملئ الحقل</div>
                        </div>

<!--
                        <div class="col-12">
                          <label for="yourUsername" class="form-label">إسم المستخدم</label>
                          <div class="input-group has-validation">
                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                            <input type="text" name="username" class="form-control" id="yourUsername" required>
                            <div class="invalid-feedback">المعذرة، يرجى ملئ الحقل</div>
                          </div>
                        </div>
-->
                        <div class="col-12">
                          <label for="yourPhone" class="form-label">رقم <?php echo $LANG->WORD87; ?></label>
                          <input type="number" name="cust_phone" class="form-control" id="yourPhone" maxlength="9" required>
                          <div class="invalid-feedback">المعذرة، يرجى ملئ الحقل</div>
                        </div>
                        <div class="col-12">
                          <label for="yourPassword" class="form-label">كلمة المرور</label>
                          <input type="password" name="cust_password" class="form-control" id="yourPassword" required>
                          <div class="invalid-feedback">المعذرة، يرجى ملئ الحقل</div>
                        </div>
                        <div class="col-12">
                          <label for="yourPassword" class="form-label">تأكيد كلمة المرور</label>
                          <input type="password" name="cust_re_password" class="form-control" id="yourPassword" required>
                          <div class="invalid-feedback">المعذرة، يرجى ملئ الحقل</div>
                        </div>

                        <div class="col-12">
                          <div class="form-check">
                            <input class="form-check-input" name="REGISTER" type="checkbox" value="" id="acceptTerms" required>
                            <label class="form-check-label" for="acceptTerms">أوافق على جميع <a href="#">الشروط والخصوصية</a></label>
                            <div class="invalid-feedback">يجى تأكيد الموافقة</div>
                          </div>
                        </div>
                        <div class="col-12">
                          <button class="btn  y w-100" name="REGISTER" style="  background-color: var(--color-primary);" type="submit">إنشاء الحساب</button>
                        </div>
                        <div class="col-12">
                          <p class="small mb-0">لدي حساب مسبقا <a href="login.php"><?php echo $LANG->WORD49; ?></a></p>
                        </div>
                      </form>

                    </div>
                  </div> 


                </div>
              </div>
            </div>
   
      </main><!-- End #main -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>