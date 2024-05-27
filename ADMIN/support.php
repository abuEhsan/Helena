<?php
session_start();
include('Link/error-reporting.php');
// $sql="update tbladmin  set Status=0 where ID='".$_SESSION['ADMIN_ID']."' AND ID!=3"; 
// $query = $dbh->prepare($sql);
// $query->execute();
// header("Location: logoutAdmin.php"); 
// exit;
if(!isset($_SESSION["ADMIN_LOGGED_IN"]) && $_SESSION["ADMIN_LOGGED_IN"] !== true || !isset($_SESSION['ADMIN_ROOT'])){

  header("Location: logoutAdmin.php"); 
  exit;

}else{ 
        include('Link/config.php');
        include('Link/Setting.php');
        include("Link/Dir.php"); 
        include("Link/Favicons.php");
//        include("Link/languge.php"); 
        // submit this page
        
       
        // Update   Block 
             if(isset($_GET['block']))
            {
 
                $pra=$_GET['block'];
                $sql="update tbladmin  set Status=0 where ID=:block "; 
                $query = $dbh->prepare($sql);
                $query->bindParam(':block',$pra,PDO::PARAM_STR);
                $query->execute();
                  if($query){
                      $msg="تم  الحضر بنجاح";    
                    }else{
                       $erorr="المعذرة، يوجد خطأ يرجى اعادة المحاولة "; 
                    }
             
            }
        
           // Update   unBlock 
             if(isset($_GET['unblock']))
            {
           
                $pra=$_GET['unblock'];
                $sql="update tbladmin  set Status=1 where ID=:unblock "; 
                $query = $dbh->prepare($sql);
                $query->bindParam(':unblock',$pra,PDO::PARAM_STR);
                $query->execute();
                  if($query){
                      $msg="تم رفع الحضر بنجاح";    
                    }else{
                       $erorr="المعذرة، يرجى المحاولة مرة اخرى"; 
                    }
            }



?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">

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
<!--  <link href="assets/css/style-arabic.css" rel="stylesheet">-->
  <!-- =======================================================
  * Template Name: NiceAdmin - v2.2.2
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
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
              <h5 class="card-title"><?php echo "تفاصيل بيانات الموظف";?></h5>
       

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?php echo "الترميز";?></th>
                    <th scope="col"><?php echo "الإسم الكامل";?></th>
                    <th scope="col"><?php echo "اسم المستخدم";?></th>
                    <th scope="col"><?php echo "صورة المستخدم ";?></th>
                    <th scope="col"><?php echo "الجنس";?></th>
                    <th scope="col"><?php echo "رقم الهاتف";?></th>
                    <th scope="col"><?php echo "البريد الالكتروني";?></th>
                    <th scope="col"><?php echo "عمليات تسجيل الدخول";?></th>
                    <th scope="col"><?php echo "تاريخ آخر دخول  ";?></th>
                    <th scope="col"><?php echo "تاريخ تحديث الحساب";?></th>
                    <th scope="col"><?php echo "تاريخ الانشاء";?></th>
                    <th scope="col"><?php echo "حالة الحساب";?></th>

                    </tr>
                </thead>
                <tbody>
<?php 
$sql = "SELECT * FROM `tbladmin` WHERE ID !=3 ORDER BY `tbladmin`.`ID` DESC;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
    $DateResult=$result->AdminRegdate;
    $currentDate = new DateTime($DateResult);
    $DR=$currentDate->format('Y-M-j');
    
?>  
                                                <tr>
                                                        <td><?php echo htmlentities($cnt);?></td>
                                                        <td><?php echo htmlentities($result->type);?></td>
                                                        <td><?php echo htmlentities($result->AdminName);?></td>
                                                        <td><?php echo htmlentities($result->UserName);?></td>
                                                        <td><?php 
    if($result->profile){
       echo"<img class='img-file'   src='".$DirUPLOADIN_Uploads_File_Images_Emploies_Admin.htmlentities($result->profile)."'>"."</img>"; 
    }else{
       echo"<img class='img-file'   src='".$DirUPLOADIN_Uploads_File_Images_Emploies_Admin."/icon-admin.png'>"."</img>";
    }
    
                                                            ?></td>
                                                        <td><?php 
    if($result->Gender == '1'){
          echo htmlentities(" ذكر");   
    }elseif($result->Gender == '2'){
          echo htmlentities(" أنثى");   
    }else{
         echo htmlentities("غير محدد"); 
    }
    
                                                            ?></td>
                                                        <td><?php echo htmlentities($result->MobileNumber);?></td>
                                                        <td><?php echo htmlentities($result->Email);?></td>
                                                        <td><?php echo htmlentities($result->totallog);?></td>
                                                        <td><?php echo htmlentities($result->TimeLogin);?></td>
                                                        <td><?php echo htmlentities($result->UpdationDate);?></td>
                                                        <td><?php echo htmlentities($DR);?></td>
<?php if($result->Status == '1'){ ?>                                               
                                                    
                                                        <td>
                                                            <a href="support.php?block=<?php echo htmlentities($result->ID);?>"><i class="bi bi-x" title="<?php echo "حظر الحساب";?>" onClick="return confirm('<?php echo "هل انت متاكد!";?>');" style="font-size: 25px;"></i>   </a>
                                                        </td>
<?php }else{ ?>                                                  
                                                    
                                                    
                                                        <td>
                                                            <a href="support.php?unblock=<?php echo htmlentities($result->ID);?>"><i class="bi bi-check-lg" title="<?php echo "رفع الحظر";?>" onClick="return confirm('<?php echo "هل انت متاكد!";?>');" style="font-size: 25px;"></i>   </a>
                                                        </td>
<?php } ?> 
                                                     
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