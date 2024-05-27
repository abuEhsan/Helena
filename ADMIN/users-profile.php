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
        

        
        //Submit this page
        if(isset($_POST['submit']))
        {
            
 
          $target_dir=$DirUPLOADIN_Uploads_File_Images_Emploies_Admin;
          $target_file= $target_dir . basename($_FILES["Image"]["name"]);
          $Imagefile=$_FILES["Image"]["name"];
          move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file);
            
       
            $PFN=$_POST['FN'];  
            $PUS=$_POST['US'];
            $PPH=$_POST['PH'];
            $PEM=$_POST['EM'];
            $PGN=$_POST['GN'];


          if($Imagefile != '' ) {
              
                $con="update tbladmin set AdminName=:FN,UserName=:US,profile='$Imagefile',MobileNumber=:PH,Email=:EM,Gender=:GN where ID='".$_SESSION['ADMIN_ID']."' ";
                $chngpwd1 = $dbh->prepare($con);
                $chngpwd1-> bindParam(':FN', $PFN, PDO::PARAM_STR);
                $chngpwd1-> bindParam(':US', $PUS, PDO::PARAM_STR);
                $chngpwd1-> bindParam(':PH', $PPH, PDO::PARAM_STR);
                $chngpwd1-> bindParam(':EM', $PEM, PDO::PARAM_STR);
                $chngpwd1-> bindParam(':GN', $PGN, PDO::PARAM_STR);
                $chngpwd1->execute();
                 if($chngpwd1){
                  $_SESSION['ADMIN_PROFILE']=$Imagefile;
                  $msg="تم تحديث البيانات بنجاح";  
                }else{
                   $erorr="المعذرة، يرجى المحاولة مرة أخرى";  
                }
         
            }else{
              
                $con="update tbladmin set AdminName=:FN,UserName=:US,MobileNumber=:PH,Email=:EM,Gender=:GN where ID='".$_SESSION['ADMIN_ID']."' ";
                $chngpwd1 = $dbh->prepare($con);
                $chngpwd1-> bindParam(':FN', $PFN, PDO::PARAM_STR);
                $chngpwd1-> bindParam(':US', $PUS, PDO::PARAM_STR);
                $chngpwd1-> bindParam(':PH', $PPH, PDO::PARAM_STR);
                $chngpwd1-> bindParam(':EM', $PEM, PDO::PARAM_STR);
                $chngpwd1-> bindParam(':GN', $PGN, PDO::PARAM_STR);
                $chngpwd1->execute();
                 if($chngpwd1){
                  $msg="تم تحديث البيانات بنجاح";  
                }else{
                   $erorr="المعذرة، يرجى المحاولة مرة أخرى";  
                }
                             
                             
            }//end if cheked file
          
       
        }//end if submit
        
        
        
        
      //submit delete profile
        
             if(isset($_GET['delp']))
                {
                    $defultIcon="icon-admin.png";
                    $sql="update tbladmin set profile='$defultIcon' where ID='".$_SESSION['ADMIN_ID']."' ";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    if($query){
                      $msg="تم حذف الصورة بنجاح";  
                    }else{
                        $erorr="المعذرة، يرجى المحاولة مرة أخرى";  
                    }   
                }
        
        
        
   
        
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title></title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <title> <?php echo $CNAME." || "."    إدارة ضبط الملف الشخصي  " ?> </title>
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
<!--  <link href="assets/css/style-arabic.css" rel="stylesheet">-->

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
   <h1><?php echo "تحديث الملف الشخصي";?> </h1>
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

$sql = "SELECT  * from tbladmin where ID='".$_SESSION['ADMIN_ID']."'";
$query = $dbh->prepare($sql);

$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>
                  

                      
                    <div class="row mb-3">
                     <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">صورتك الشخصية </label>
                      <div class="col-md-8 col-lg-9">
<?php if($result->profile){ ?>
                       <img src="<?php echo $DirUPLOADIN_Uploads_File_Images_Emploies_Admin.htmlentities($result->profile);?>" alt="Profile" width="160" height="170">
<?php }else{ ?>
                       <img src="<?php echo $DirUPLOADIN_Uploads_File_Images_Emploies_Admin; ?>/icon-admin.png" alt="Profile" width="160" height="170">    
<?php } ?>
                        <div class="pt-2">
<!--                          <a href="users-profile.php?delp=1" class="btn btn-danger btn-sm" title="حذف صورة ملفك الشخصي"  onClick="return confirm('<?php echo "هل أنت متأكد من حذف صورة ملفك الشخصي!";?>');"><i class="bi bi-trash"></i></a><br><br>-->
                          <input class="form-control " type="file" id="formFile" name="Image" >
                        </div>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><?php echo "الاسم الكامل";?> </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="FN" type="text" class="form-control" id="FN" value="<?php echo htmlentities($result->AdminName); ?>">
                      </div>
                    </div>
                      
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><?php echo "اسم المستخدم";?> </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="US" type="text" class="form-control"value="<?php echo htmlentities($result->UserName); ?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><?php echo " رقم الهاتف";?> </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="PH" type="text" class="form-control"value="<?php echo htmlentities($result->MobileNumber); ?>" maxlength="9">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label"><?php echo " البريد الالكتروني";?> </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="EM" type="email" class="form-control"value="<?php echo htmlentities($result->Email); ?>">
                      </div>
                    </div>
                     <fieldset class="row mb-3">
                  <legend class="col-form-label col-sm-2 pt-0"><?php echo "نوع الجنس "; ?></legend>
<?php 
if($result->Gender == '1')
{
?>  
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="GN" id="gridRadios1" value="1" checked >
                      <label class="form-check-label" for="gridRadios1">
                        <?php echo "ذكر"; ?>
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="GN" id="gridRadios1" value="2"  >
                      <label class="form-check-label" for="gridRadios1">
                        <?php echo "أنثى "; ?>
                      </label>
                    </div>
                  </div>
<?php } ?>
<?php  
if($result->Gender == '0')
{
?>  
                  <div class="col-sm-10">
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="GN" id="gridRadios1" value="1"  >
                      <label class="form-check-label" for="gridRadios1">
                        <?php echo "ذكر"; ?>
                      </label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="GN" id="gridRadios1" value="2" checked >
                      <label class="form-check-label" for="gridRadios1">
                         <?php echo " أنثى"; ?>
                      </label>
                    </div>
                  </div>
<?php } ?>
                   
                   
                </fieldset>
                      
                

               
<?php }} ?>
                

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="submit"><?php echo "حفظ التعديلات";?> </button>
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