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
            if(isset($_GET['pid']))
            {
                $id=intval($_GET['pid']);
                $sql="delete from tblpleadings where ID=:pid ";
                $query = $dbh->prepare($sql);
                $query->bindParam(':pid',$id,PDO::PARAM_INT);
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
  <title> <?php echo $CNAME." || "."    إدارة الطلبات  "; ?> </title>
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

 
  <main id="main" class="main">

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

       <?php 
        
        if(isset($_GET['view-m'])){
//        include"View-Message.php"; 
        }
            
        ?>  

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo "تفاصيل الطلب"; ?></h5>
             

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?php echo "محتوى الطلب";?></th>
                    <th scope="col"><?php echo "  نوع الطلب ";?></th>
                    <th scope="col"><?php echo "  الجهة ";?></th>
                    <th scope="col"><?php echo "إسم المقدم ";?> </th>
                    <th scope="col"><?php echo "تاريخ الطلب";?></th>
                    <th scope="col"><?php echo "حالة الطلب";?> </th>
                    <th scope="col"><?php echo "حذف الطلب";?></th>
                    </tr>
                </thead>
                <tbody>
<?php $sql = "SELECT `ID`, `AddID`, `TypePleading`,`NameCustomer`, `CompanyName`, `Phone`, `Address`, `pleadingText`,`Is_Read`, `CraeteDate`, `Status` FROM `tblpleadings` ORDER BY `CraeteDate` DESC";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   
    
    $DateResult=$result->CraeteDate;
    $currentDate = new DateTime($DateResult);
    $DR=$currentDate->format('Y-M-j H:i:s');
    $subStr=substr($result->pleadingText, 0, 100);
                    
?>
                                                <tr>
                                                        <td><?php echo htmlentities($cnt);?></td>
                                                        <td><?php echo htmlentities($subStr)."<a href='View-Pleading.php?view_m=".$result->ID."'> "."<i class='bi bi-arrow-right' style='color:blue;'>"."</i>"."</a>";?></td>
                                                      <td><?php 
    
if($result->TypePleading == '1'){
    
    echo" طلب قطاع أعمال";
        
}elseif($result->TypePleading == '2'){
    
    echo" طلب $LANG->WORD6 ";
    
}else{
    
     echo" لم يتم تصنيف الطلب ";
    
}

                                                          
                                                          ?></td>
                                                        <td><?php echo htmlentities($result->CompanyName);?></td>
                                                        <td><?php echo htmlentities($result->NameCustomer);?></td>
                                                        <td><?php echo htmlentities($DR);?></td>
                                                        <td ><?php if($result->Is_Read==1){
   echo "<span  class='badge rounded-pill bg-danger'>" ." ".htmlentities('  تـمـت   المعـاينة  ')." "."</span>";
}
else{
   echo "<span  class='badge rounded-pill bg-success'>".htmlentities('لم يتم المعاينة ')."</span>";
}
                                                    ?></td>
<!--
                                                        <td>
                                                            <button type="button" class=" btn-primary" data-bs-toggle="modal" data-bs-target="#verticalycentered"><a href="View-Message.php?view_m=<?php echo htmlentities($result->ID);?>"><i class="bi bi-eye-fill" style='color:white;' title="<?php echo " معاينة التفاصيل ";?>"></i> </a></button>
                                                        </td>
-->
                                                         <td>
                                                            <a href="Manage-Orders-Pleading.php?pid=<?php echo htmlentities($result->ID);?>"><i class="bi bi-trash-fill" title="<?php  echo "حذف الطلب ";?> "  onClick="return confirm('<?php echo "هل أنت متأكد من حذف السجل!";?>');"></i> </a>

                                                        </td>
                                                    </tr> 
                    
                   <?php $cnt=$cnt+1;}} ?>
                </tbody>
              </table>
              <!-- End Table with stripped rows -->

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