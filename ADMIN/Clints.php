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
    if(isset($_POST['submit']))
    {

    //load logo file  
    $target_dir="UPLOADING/Uploads-Files-Clints/"; 
    $target_file= $target_dir . basename($_FILES["Icon"]["name"]);
    $Iconfile=$_FILES["Icon"]["name"];
    move_uploaded_file($_FILES["Icon"]["tmp_name"], $target_file);
    $PNA=$_POST['NA'];
    $PTP=$_POST['TP'];
    $PABU=$_POST['ABU'];


    $sql="INSERT INTO `tblclints`(`Name`,`Type`, `desctext`,`Icon` ) VALUES (:NA,:TP,:ABU,'$Iconfile')" ; 
    $query = $dbh->prepare($sql);
    $query->bindParam(':NA',$PNA,PDO::PARAM_STR);
    $query->bindParam(':TP',$PTP,PDO::PARAM_INT);
    $query->bindParam(':ABU',$PABU,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        $msg="تم إضافة البيانات بنجاح";  
    }else{
         $erorr="المعذرة، أحيانا تحدث أخطاء.. الرجاء المحاولة مجددا!"; 
    }

    }

     //delete Service
            if(isset($_GET['clid']))
            {
            $id=intval($_GET['clid']);
            $sql="delete from tblclints where id=:clid ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':clid',$id,PDO::PARAM_INT);
            $query->execute();
            if($query){
              $msg="تم حذف الخدمة بنجاح";  
            }else{
               $erorr="المعذرة، أحيانا تحدث أخطاء.. الرجاء المحاولة مجددا!";  
            }   

            }
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> <?php echo $CNAME." || "."  إضافة عميل   " ?> </title>
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
  <!--<link href="assets/css/style-arabic.css" rel="stylesheet">-->

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
      <h1> <?php echo "إضافة عميل"; ?> </h1>
    </div><!-- End Page Title -->

    <section class="section"  >
      <div class="row" >
        <div class="col-lg-6" >

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">  <?php echo "أدخل بيانات الخدمة"; ?> </h5>

              <!-- General Form Elements -->
              <form method="post" action="" enctype="multipart/form-data">
                  
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label"><?php echo "أيقونة العميل"; ?> </label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile" name="Icon">
                  </div>
                </div>    
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label"> <?php echo "إسم العميل"; ?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="NA" required>
                  </div>
                </div>
                <div class="row mb-3">
                    <fieldset class="row mb-3">
                      <legend class="col-form-label col-sm-2 pt-0"><?php echo " الرتبة  "; ?></legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="TP" id="gridRadios1" value="1" checked >
                          <label class="form-check-label" for="gridRadios1">
                             <?php echo "من عملائنا"; ?>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio"  name="TP" id="gridRadios2" value="2" >
                          <label class="form-check-label" for="gridRadios2">
                           <?php echo "من شركاء النجاح"; ?> 
                          </label>
                        </div>
                      </div>
                    </fieldset>
                </div>
                
                  
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label"> <?php echo "نبذة عن نشاطه التجاري  "; ?></label>
                  <div class="col-sm-10">
                      <textarea class="form-control" name="ABU" rows="5" >
                      </textarea>
                  </div>
                </div> 
         
                  
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
    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"><?php echo "بيانات العملاء";?></h5>
             

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?php echo " إسم العميل";?></th>
                    <th scope="col"><?php echo "  ايقونة العميل";?></th>
                    <th scope="col"><?php echo "    الرتبة";?></th>
                    <th scope="col"><?php echo "نبذة عن النشاط التجاري ";?></th>
                    <th scope="col"> <?php echo "حذف";?></th>
                    </tr>
                </thead>
                <tbody>
<?php 
$sql = "SELECT * FROM tblclints";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
//    $DateResult=$result->CreateDate;
//    $currentDate = new DateTime($DateResult);
//    $DR=$currentDate->format('Y-M-j');
    
?>  
                                                <tr>
                                                       <td><?php echo htmlentities($cnt);?></td>
                                                       <td><?php echo htmlentities($result->Name);?></td>
                                                       <td><?php 
    if($result->Icon){
    echo"<img class='img-file'   src='UPLOADING/Uploads-Files-Clints/".htmlentities($result->Icon)."'>"."</img>";
    }else{
        echo"<i class='bi bi-image'>"."</i>";
    } 
                                                        ?></td>
                                                       <td><?php 
    if($result->Type == '1'){
        echo"من عملائنا";
    }else if($result->Type == '2'){
        echo"من شركائنا";
    }else{
         echo"غير مصنف ";
    }
                                                        ?></td>
                                                       <td><?php echo htmlentities($result->desctext) ;?></td>
                                                         <td>
                                                            <a href="Clints.php?clid=<?php echo htmlentities($result->id);?>"><i class="bi bi-trash-fill" title="<?php echo "حذف السجل";?> "  onClick="return confirm('<?php echo "هل أنت متأكد من الحذف!";?>');"></i> </a>  
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