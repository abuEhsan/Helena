<?php
session_start();
include('Link/error-reporting.php');
if(!isset($_SESSION["ADMIN_LOGGED_IN"]) && $_SESSION["ADMIN_LOGGED_IN"] !== true){
   header("Location: index.php"); 
    exit;

}else{ 
        include('Link/config.php');
        include('Link/Setting.php');
        include("Link/Dir.php"); 
        include("Link/Favicons.php");
//        include("Link/languge.php"); 


    if(isset($_POST['CheckForgetPassword']))
    {

        $uname=filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $PEmail=filter_var($_POST['Email'], FILTER_SANITIZE_STRING);
        $sql ="SELECT ID,type,UserName,Password FROM tbladmin WHERE UserName=:username AND Email=:Email AND Status=1; ";
        $query= $dbh -> prepare($sql);
        $query-> bindParam(':username', $uname, PDO::PARAM_STR);
        $query-> bindParam(':Email', $PEmail, PDO::PARAM_STR);
        $query-> execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);
        if($query->rowCount() > 0)
        {
        foreach($results as $result)
        {
            
           //GET PASSWORD AND EMAIL
             $PPS=password_hash($result->Password, PASSWORD_DEFAULT);
             $PEM=$result->Email;
          // SENT TO EMAIL
            $to = $PEM;
            $subject=" كود إعادة تعين كلمة المرور  ";
            $from = 'PURENOVATECH <tariq9829@gmail.com>';
            // To send HTML mail, the Content-type header must be set
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
            // Create email headers
            $headers .= 'From: '.$from."\r\n".
                'Reply-To: '.$to."\r\n" .
                'X-Mailer: PHP/' . phpversion();

            // Compose a simple HTML email message
            $message = '<html><body>';
            $message .= '<h1 style="color:blue;">مـــرحباً ، '.$to.'</h1>';
            $message .= '<p style="color:#080;font-size:18px;"> '.$PPS.'   كلمة المرور الخاصة بك</p>';
            $message .= '</body></html>';

            // Sending email
            if(mail($to, $subject, $message, $headers)){
                $msg="تم إرسال كلمة المرور الخاصة بك ، الرجاء التحقق من بريدك الالكتروني.";
            }else{
            
                $erorr="المعذرة، لم نتمكن ارسال كود اعادة تعين كلمة المرور، الرجاء المحاولة مرة أخرى!";
           }  
            
            }//END LOOP

    
        
        }else{

            echo "<script>alert('البيانات غير صالحة');</script>";

        }

    }






?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> تسجيل العضوية </title>
  <meta content="" name="description">
  <meta content="" name="keywords">

<!-- Favicons -->
  <link href="<?php echo $FAVICONS; ?>" rel="icon">
  <link href="<?php echo $FAVICONS; ?>" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body dir="rtl">

  <main>
    <div class="container" style="font-family: 'Cairo';">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
<?php
$sql = "SELECT Name,Icon,Domain FROM `tblcompnydata` limit 1;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
    htmlentities($_SESSION['ICONSYSTEM']=$result->Icon);
    htmlentities($_SESSION['DOMAINSYSTEM']=$result->Domain);
?>  
              <div class="d-flex justify-content-center py-4">
                <a href="login.php" class="logo d-flex align-items-center w-auto">
                  <span class="d-none d-lg-block" style="font-family: 'Cairo';"><?php echo htmlentities($_SESSION['NAMESYSTEM']=$result->Name);?> </span>
                    <span > <img src="assets/img/<?php echo htmlentities($_SESSION['ICONSYSTEM']);?>" alt="<?php echo htmlentities($_SESSION['NAMESYSTEM']);?>"></span>
                </a>
              </div><!-- End Logo -->
<?php }} ?>
              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2" >
                    <h5 class="card-title text-center pb-0 fs-4" style="font-family: 'Cairo';">إعادة تعين كلمة المرور  </h5>
                    <p class="text-center small">ادخل أسم المستخدم  وبريدك الالكتروني ليتم ارسال كلمة المرور الخاصة بك</p>
                  </div>
                <?php if($msg){ ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-1"></i>
                           <?php echo $msg;?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                  <?php } if($erorr){ ?>
                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                            <?php echo $erorr; ?>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>
                  <?php } ?>

                  <form class="row g-3 needs-validation" method="post" action="" >

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">أسم المستخدم</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person"></i></span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">المعذرة، يرجى ادخال بيانات اسم المستخدم</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <label for="yourUsername" class="form-label"> بريدك الالكتروني</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="Email" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">المعذرة، يرجى ادخال بيانات اسم المستخدم</div>
                      </div>
                    </div>
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">تذكيري بكلمة المرور</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="CheckForgetPassword">إرســـال </button>
                    </div>
                    
                  </form>

                </div>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->
    <!-- ======= Footer ======= -->
 <?php include'Link/footer.php'; ?>  
    <!-- End Footer -->
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.min.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
<?php } ?>