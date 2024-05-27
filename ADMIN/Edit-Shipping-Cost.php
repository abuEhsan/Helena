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
        
        $id=intval($_GET['sctid']);
        // submit this page
        if(isset($_POST['submit']))
        {
           
            $PNA=$_POST['NA'];
            $PNUM=$_POST['NUM'];

           
                 $sql="UPDATE `tblshippingcost` SET `bank`=:NA,`amount`=:NUM WHERE shipping_cost_id=:sctid";
                 $query = $dbh->prepare($sql);
                 $query->bindParam(':NA',$PNA,PDO::PARAM_STR);
                 $query->bindParam(':NUM',$PNUM,PDO::PARAM_STR);
                 $query->bindParam(':sctid',$id,PDO::PARAM_INT);
                 $query->execute();
                 if($query)
                 {
                     $msg="تم  تحديث البيانات بنجاح";  
                 }else{
                     $erorr="المعذرة، أحيانا تحدث أخطاء.. الرجاء المحاولة مجددا!"; 
                 }
        

        

        }

    
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

 
  <meta content="" name="description">
  <meta content="" name="keywords">
  <title> <?php echo $CNAME." || "."   تحديث بيانات الحساب البنكي    "; ?> </title>
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
    <div class="pagetitle" >
      <h1> <?php echo "تحديث بيانات الحساب"; ?> </h1>
    </div><!-- End Page Title -->

    <section class="section"  >
      <div class="row" >
        <div class="col-lg-6" >

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">  <?php echo "أدخل بيانات الحساب"; ?> </h5>

              <!-- General Form Elements -->
              <form method="post" action="" enctype="multipart/form-data">
<?php 

$sql = "SELECT `bank`, `amount`, `Status` FROM `tblshippingcost` WHERE shipping_cost_id=:sctid";
$query = $dbh->prepare($sql);
$query->bindParam(':sctid',$id,PDO::PARAM_INT);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
   
?>  
            
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label"> <?php echo "إسم البنك"; ?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="NA" value="<?php echo htmlentities($result->bank); ?>" required>
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label"> <?php echo "  رقم الايدلع "; ?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="NUM" value="<?php echo htmlentities($result->amount); ?>"  required>
                  </div>
                </div>
                
           
    

 <?php }} ?>                 
                  
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="submit">     <?php echo "إتمام"; ?></button>
                  </div>
                </div>

              </form><!-- End General Form Elements -->

            </div>
          </div>

        </div>

          
          
      </div>
    </section>

  </main><!-- End #main -->

    <!-- ======= Footer ======= -->
    <?php include("Link/sidebar.php"); ?>
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