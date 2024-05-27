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
        
         //delete students
        if(isset($_GET['mid']))
        {
            $id=intval($_GET['mid']);
            $sql="delete from tblpleadings where ID=:mid ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':mid',$id,PDO::PARAM_INT);
            $query->execute();
            if($query){
              $msg="تم حذف الطلب بنجاح";  
            }else{
                $erorr="المعذرة، يرجى المحاولة مرة أخرى";  
            }   
        }

?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <title> <?php echo $CNAME." || "."    إدارة الطلبات - معاينة الطلبات  " ?> </title>
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
 <?php // include("Link/sidebar-old.php"); ?>
    <!-- End Sidebar-->

 
  <main id="main" class="main" dir="rtl">

    <div class="pagetitle">
      <h1><?php echo "إدارة الطلبات";?> </h1>
    </div><!-- End Page Title -->
<?php if($msg){ ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle me-1"></i>
               <?php echo $msg;?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
      <?php }if($erorr){ ?>
       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-octagon me-1"></i>
                <?php echo $erorr; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
      <?php } ?>
    <section class="section">
      <div class="row">
        <div class="col-lg-12"> 
          <div class="card">
            <div class="card-body">
                <h5 class="card-title"><?php echo "تفاصيل الطلب";?></h5><?php
$id=intval($_GET['view_m']);        
//$sql = "SELECT tblcontactdata.FullName,tblcontactdata.PhoneNumber,tblcontactdata.UserIp,tblcontactdata.EmailId,tblcontactdata.Subject,tblcontactdata.Message,tblcontactdata.PostingDate,tblcontactdata.id,tbladminremarks.adminRemark,tbladminremarks.remarkDate from tblcontactdata left join  tbladminremarks on  tbladminremarks.contactFormId=tblcontactdata.id where tblcontactdata.id=:view_m";
        
$sql = "UPDATE tblpleadings SET Is_Read=1 WHERE ID=:view_m";   
$query = $dbh->prepare($sql);
$query-> bindParam(':view_m',$id,PDO::PARAM_INT);
$query->execute();
  
        
$sql = "SELECT * FROM tblpleadings WHERE ID=:view_m";
$query = $dbh -> prepare($sql);
$query-> bindParam(':view_m',$id,PDO::PARAM_INT);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0){
foreach($results as $result){

              ?><!-- Table with stripped rows -->
             <ul class="px-0 list-unstyled" align="right">
                  <li><b>إسم الجهة      : </b><?php echo htmlentities($result->CompanyName);?></li>
                  <li><b>إسم المرسل     : </b><?php echo htmlentities($result->NameCustomer);?></li>
                  <li><b>هاتف المرسل    : </b><?php echo htmlentities($result->Phone);?></li>
                  <li><b> موقع الطلب    : </b><?php echo htmlentities($result->Address);?></li>
                  <li><b>تاريخ الطلب     : </b><?php echo htmlentities($result->CraeteDate);?></li>
              </ul><hr>
              <table class="table ">
                    <tbody>
                     <tr>
                        <th scope="row"> تفاصيل الطلب </th>
                        <td><p style="color:blue;"><?php echo htmlentities($result->tblpleadings);?></p>
                        </td>
                      </tr>
                    </tbody>
                  </table>
              <!-- End Table with stripped rows -->
<?php }} ?>
                
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