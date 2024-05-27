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
        include("Link/Function-Get-Time-Ago.php");
//        include("Link/languge.php"); 
        
        // submit this page

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title> <?php echo $CNAME." || "."  لوحة التحكم  " ; ?> </title>
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
 <style>
    
    .icon-alert{
        margin: 2%px;
        font-size: 25px;
        padding: 1%;
    }
    
      body{
            font-family: 'Cairo';
         
        }
        
    h1,h2,h3,h4,h5,h6,ul,li,ol,a{
    font-family: 'Cairo';
     
        }
      .img-file {
            width: 70px;
            height: 70px;
            border-radius: 6px;
            margin: 2%;
        }  
/*
     i{
         color: #D6A31B;
     }
     .card-title{
         
     }
*/
    </style>

</head>
<body>
  <!-- ======= Header ======= -->
 <?php include("Link/header.php"); ?>
    <!-- End Header -->
  <!-- ======= Sidebar ======= -->
 <?php include("Link/sidebar.php"); ?>
 <?php // include("Link/sidebar-old.php"); ?>
    <!-- End Sidebar-->
  <main id="main" class="main">
    <div class="pagetitle" dir="rtl">
      <h1> <?php echo htmlentities("لوحة التحكم"); ?></h1>
    </div><!-- End Page Title -->
    <section class="section dashboard"  >
      <div class="row"> 
        <!-- Left side columns -->
        <div class="col-lg-8" >
          <div class="row" >
            <!--  Card -->
            <?php  include'Query/card-dashboard.php'; ?>  
            <!-- End Card -->    
              
            <!--  Card -->
            <?php  //include'Query/Last-Plaeing.php'; ?>  
             <?php //include'Query/Best-Sales-Product.php'; ?>  
            <!-- End Card --> 
               <!--  Card -->
            <?php  // include'Query/Report-Visted.php'; ?>  
            <!-- End Card --> 
          </div>
        </div><!-- End Left side columns -->
          <!-- Right side columns -->
        <div class="col-lg-4">
                 <?php  include'Query/Data-Part.php'; ?>  
                 <?php  include'Query/User-Online.php'; ?>  
                 <?php  include'Query/Website-Traffic-Report.php'; ?>  
                 <?php  include'Query/Budget-Report.php'; ?>  
        </div>
          <!-- End Right side columns -->
      </div>
    </section>
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