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
        
        $id=intval($_GET['Eproid']);
        // submit this page
        if(isset($_POST['submit']))
        {

            $PCT=$_POST['CT'];    
            $PNA=$_POST['NA'];
            $PABU=$_POST['ABU'];
//            $PLD=$_POST['LD'];
            $PPR=$_POST['PR'];
            $PCUR=$_POST['CUR'];
            $PQTY=$_POST['QTY'];
            $PSS=$_POST['SS'];
            $sql="UPDATE `tblproducts` SET `CategoryId`=:CT,`Name`=:NA,`about`=:ABU,`price`=:PR,`CurrencyId`=:CUR,`qualty`=:QTY,`alt`=:NA ,`Status`=:SS,LastUpdateDate=CURRENT_DATE WHERE id=:Eproid";
            $query = $dbh->prepare($sql);
            $query->bindParam(':CT',$PCT,PDO::PARAM_INT);
            $query->bindParam(':NA',$PNA,PDO::PARAM_STR);
            $query->bindParam(':ABU',$PABU,PDO::PARAM_STR);
//            $query->bindParam(':LD',$PLD,PDO::PARAM_STR);
            $query->bindParam(':PR',$PPR,PDO::PARAM_STR);
            $query->bindParam(':CUR',$PCUR,PDO::PARAM_STR);
            $query->bindParam(':QTY',$PQTY,PDO::PARAM_STR);
            $query->bindParam(':SS',$PSS,PDO::PARAM_INT);
            $query->bindParam(':Eproid',$id,PDO::PARAM_INT);
            $query->execute();
            if($query)
            {
                 $msg="تم  تحديث المنتج بنجاح";  
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
  <title> <?php echo $CNAME." || "."   تحديث المنتج  " ?> </title>
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
      <h1> <?php echo "تحديث بيانات المنتجات"; ?> </h1>
    </div><!-- End Page Title -->

    <section class="section"  >
      <div class="row" >
        <div class="col-lg-6" >

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">  <?php echo "أدخل بيانات المنتج"; ?> </h5>

              <!-- General Form Elements -->
              <form method="post" action="" enctype="multipart/form-data">
<?php 
$id=intval($_GET['Eproid']);
$sql = "SELECT p.id,p.Name AS PN,p.CurrencyId,qualty,p.Icon,p.about,p.linkdemo,p.price,p.typeIcon,p.Status AS ST,p.CreateDate,p.LastUpdateDate,c.ID AS CT,u.id AS UID  FROM tblproducts p\n"

    . "JOIN tblcategory c\n"

    . "ON p.CategoryId=c.id\n"

    . "JOIN tbladmin u \n"

    . "ON p.AdminId=u.id \n"
    
    ."WHERE p.id=:Eproid ;";
        
$query = $dbh->prepare($sql);
$query->bindParam(':Eproid',$id,PDO::PARAM_INT);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $resultM)
{ 
    
   $PCT=$resultM->CT;
   $PST=$resultM->ST;
   $PUID=$resultM->UID;
   $PAUP=$resultM->about;
   $PQTY=$resultM->qualty;
   $PPR=$resultM->price;
   $PCUR=$resultM->CurrencyId;
    
?>  
                
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label"> <?php echo "إسم المنتج"; ?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="NA" value="<?php echo htmlentities($resultM->PN);?>" required>
                  </div>
                </div>
    
          
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"><?php echo "الصنف";?></label>
                  <div class="col-sm-10">
                   <select class="form-select" aria-label="Default select example" name="CT" required>
<?php $sql2 = "SELECT ID,Name from tblcategory WHERE ID='$PCT' ";
$query = $dbh->prepare($sql2);
$query->execute();
$results2=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results2 as $result2)
{   ?>
<option value="<?php echo htmlentities($result2->ID); ?>"><?php echo htmlentities($result2->Name); ?></option>
<?php }} ?>
                    </select>
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"><?php echo "مدخل البيانات  ";?></label>
                  <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="DOVID" required>
<?php $sql3 = "SELECT id,AdminName from tbladmin WHERE id='$PUID'";
$query = $dbh->prepare($sql3);
$query->execute();
$results3=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results3 as $result3)
{   ?>
<option value="<?php echo htmlentities($result3->id); ?>"><?php echo htmlentities($result3->AdminName); ?></option>
<?php }} ?>
                    </select>
                  </div>
                </div>
                  
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label"> <?php echo "حول المنتج "; ?></label>
                  <div class="col-sm-10">
                    <did class="textarea">
                    <textarea class="form-control" name="ABU" >
                         <?php echo $PAUP; ?>
                    </textarea>
<!--
                      <textarea class="tinymce-editor" name="ABU" required>
                          <?php echo $PAUP; ?>
                      </textarea>
-->
                    </did>
                  </div>
                </div> 
            <div class="row mb-3">
                      <label for="inputNumber" class="col-sm-2 col-form-label"><?php echo " كمية المنتج"; ?> </label>
                      <div class="col-sm-10">
                        <input class="form-control" type="text" id="validationDefault02" value="<?php echo htmlentities($PQTY); ?>" name="QTY" >
                      </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label"><?php echo "سعر المنتج"; ?> </label>
                  <div class="col-sm-10">
                    <input class="form-control" type="text" id="formFile" value="<?php echo htmlentities($PPR); ?>" name="PR">
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"><?php echo " العملة";?></label>
                  <div class="col-sm-10">
                   <select class="form-select" aria-label="Default select example" name="CUR" required>
<?php $sql4 = "SELECT ID,Name from tblcurrncy WHERE ID='$PCUR'";
$query = $dbh->prepare($sql4);
$query->execute();
$results4=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results4 as $result4)
{   ?>
<option value="<?php echo htmlentities($result4->ID); ?>"><?php echo htmlentities($result4->Name); ?></option>
<?php }}else{ echo "<option>"."لا توجد عملة "."</option>"; } ?>
                    </select>
                  </div>
                </div>
                  
<?php
if($PST == '1'){ 
?>
                <div class="row mb-3">
                    <fieldset class="row mb-3">
                      <legend class="col-form-label col-sm-2 pt-0"><?php echo "صلاحية عرض المنتج "; ?></legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="SS" id="gridRadios1" value="1" checked >
                          <label class="form-check-label" for="gridRadios1">
                             <?php echo "يتم عرضه في الموقع حالا"; ?>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="SS" id="gridRadios2" value="0" >
                          <label class="form-check-label" for="gridRadios2">
                           <?php echo "لا يتم عرضه في الموقع حالا"; ?> 
                          </label>
                        </div>
                      </div>
                    </fieldset>
                </div>
<?php }else{ ?>
                  <div class="row mb-3">
                    <fieldset class="row mb-3">
                      <legend class="col-form-label col-sm-2 pt-0"><?php echo "صلاحية عرض المنتج "; ?></legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="SS" id="gridRadios1" value="1"  >
                          <label class="form-check-label" for="gridRadios1">
                             <?php echo "يتم عرضه في الموقع حالا"; ?>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="SS" id="gridRadios2" value="0" checked >
                          <label class="form-check-label" for="gridRadios2">
                           <?php echo "لا يتم عرضه في الموقع حالا"; ?> 
                          </label>
                        </div>
                      </div>
                    </fieldset>
                </div>
                  
<?php } //end else ?>
        
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