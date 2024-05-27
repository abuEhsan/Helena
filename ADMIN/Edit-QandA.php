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
        
        // submit this page
        
        //Edit students
        $id=intval($_GET['id']);

        if(isset($_POST['submit']))
        {
        $PQU=$_POST['QU'];
        $PAN=$_POST['AN'];
        $sql="update tblquesandans set questiontext=:QU,answertext=:AN where id=:id ";
        $query = $dbh->prepare($sql);
        $query->bindParam(':QU',$PQU,PDO::PARAM_STR);
        $query->bindParam(':AN',$PAN,PDO::PARAM_STR);
        $query->bindParam(':id',$id,PDO::PARAM_INT);
        $query->execute();
        if($query){
          $msg="تمت عملية تحديث البيانات بنجاح";  
        }else{
          $erorr="المعذرة، يرجى المحاولة مرة أخرى"; 
        }
            
        }




?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title> <?php echo $CNAME." || "."   تحديث الاسئلة الشائعة  " ?> </title>
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
 <!-- <link href="assets/css/style-arabic.css" rel="stylesheet">-->

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
      <style>
    
        body{
            font-family: 'Cairo';
        }
        
    h1,h2,h3,h4,h5,h6,ul,li,ol,a{
    font-family: 'Cairo';
        
     
        }
        
    </style>
</head>

<body>

   <!-- ======= Header ======= -->
 <?php include("Link/header.php"); ?>
    <!-- End Header -->

  <!-- ======= Sidebar ======= -->
 <?php include("Link/sidebar.php"); ?>
    <!-- End Sidebar-->
  <main id="main" class="main">

    <div class="pagetitle">
   <h1><?php echo "حديث بيانات الاسئلة الشائعة";?> </h1>
    </div><!-- End Page Title -->
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
    <section class="section profile">
      <div class="row">

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              
             
              
              
                  <!-- Profile Edit Form -->
                  <form  method="post" action="" enctype="multipart/form-data">
<?php 
$id=intval($_GET['id']);
$sql = "SELECT  questiontext,answertext from tblquesandans where id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_INT);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>
                

                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><?php echo "محتوى السؤوال";?> </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="QU" type="text" class="form-control" id="QU" value="<?php echo htmlentities($result->questiontext); ?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><?php echo " محتوى الاجابة";?> </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="AN" type="text" class="form-control" id="AN" value="<?php echo htmlentities($result->answertext); ?>" >
                      </div>
                    </div>

 
               
<?php }} ?>
                

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="submit"><?php echo "حفظ التحديث";?> </button>
                    </div>
                  </form><!-- End Profile Edit Form -->

            

          
            </div>
          </div>

        </div>
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