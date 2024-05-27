<?php 
//session_start();
include('Link/error-reporting.php');
//if(isset($_SESSION["MEMBER_LOGGED_IN"]) && $_SESSION["MEMBER_LOGGED_IN"] === true){
//   header("Location: dashboard.php"); 
//    exit;
//
//}else{ 
    
    // Include config file
        require_once "Link/config.php";
        include('Link/Setting.php');
        include("Link/Dir.php"); 
        include("Link/Favicons.php");

   //GET CODE ID
    if(isset($_GET['MID']))
    {
        $MID=$_GET['MID'];
        // CHECK FROM MEMBER DATA
        
         $sql="SELECT ID,parentID,Email,Phone,zipCode  FROM `tblcheackfromregistermembers` WHERE ID=:MID ";
         $query = $dbh->prepare($sql);
         $query->bindParam(':MID',$MID,PDO::PARAM_STR);
         $query->execute();
         $results=$query->fetchAll(PDO::FETCH_OBJ);
         if($query->rowCount() > 0)
         {
            foreach($results as $result)
            { 
              $ID=$result->ID; 
              $PI=$result->parentID;
              $EM=$result->Email;
              $PH=$result->Phone;
              $ZC=$result->zipCode;
                
             // GET COUNTRY
                $sql = "SELECT id,Name,zipCode from tblcountries WHERE zipCode='$ZC' ";
                $query = $dbh->prepare($sql);
                $query->execute();
                $results=$query->fetchAll(PDO::FETCH_OBJ);
                foreach($results as $result)
                { $CO=$result->Name;  }
            }
            
         }
        
    }
    
    
    
    
   //  REGISTER MEMBER
    if(isset($_POST['REGISTER']))
    {

        $PCID=$_POST['CID'];
        $PPI=$_POST['PI'];
        $PNA=$_POST['NA'];
        $PBR=$_POST['BR'];
        $PCO=$_POST['CO'];
        $PAD=$_POST['AD'];
        $PPH=$_POST['PH'];
        $PEM=filter_var($_POST['EM'], FILTER_SANITIZE_EMAIL); //Filter data
        $PGN=$_POST['GN'];
        $PPS=password_hash($_POST['PS'], PASSWORD_DEFAULT);
        
        
        
             // checked if Email and phone found
                $sql="SELECT Email  FROM `tblmembers` WHERE Email=:EM OR Phone=:PH";
                $query = $dbh->prepare($sql);
                $query->bindParam(':EM',$PEM,PDO::PARAM_STR);
                $query->bindParam(':PH',$PPH,PDO::PARAM_STR);
                $query->execute();
                if($query->rowCount() > 0)
                {
                      //$erorr="المعذرة، هذا السجل موجود .. تأكد من رقم الهاتف أو البريد الالكتروني!";
                      // Automatcly dirctory to Login Member
                      echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
                    
                }else{
                
                    //IF FREE OR NO
                    
                      if($_POST['PI']){
                          //IF WAS FROM LINK
                           //IF WAS FROM LINK
                           $sqlp="SELECT parentID  FROM `tblcheackfromregistermembers` WHERE ID='$MID'";
                            $Q = $dbh->prepare($sqlp);
                            $Q->execute();
                            $row = $Q->fetch();
                            $PID = $row["parentID"];
                           //INSERT DATA
                          $sql="INSERT INTO `tblmembers`(`parentID`,`CID`, `Name`, `Birth`, `Country`, `Phone`, `Email`,Password, `Addresses`, `Gender`) VALUES ('$PID',:CID,:NA,:BR,:CO,:PH,:EM,'$PPS',:AD,:GN)";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':CID',$PCID,PDO::PARAM_INT);
                            $query->bindParam(':NA',$PNA,PDO::PARAM_STR);
                            $query->bindParam(':BR',$PBR,PDO::PARAM_STR);
                            $query->bindParam(':CO',$PCO,PDO::PARAM_STR);
                            $query->bindParam(':PH',$PPH,PDO::PARAM_STR);
                            $query->bindParam(':EM',$PEM,PDO::PARAM_STR);
                            $query->bindParam(':AD',$PAD,PDO::PARAM_STR);
                            $query->bindParam(':GN',$PGN,PDO::PARAM_INT);
                            $query->execute();
                            $lastInsertId = $dbh->lastInsertId();
                            if($lastInsertId)
                            {
                                // UPDATE FROM REGISTER STATUS
                                 $sql="UPDATE `tblcheackfromregistermembers` SET Status='1' WHERE ID=:CID";
                                 $query = $dbh->prepare($sql);
                                 $query->bindParam(':CID',$PCID,PDO::PARAM_INT);
                                 $query->execute();
                                  //SHOW MASSAGE
                                $msg="تمت تسجيل عضويتك  بنجاح .. قم بادخل بيانات الدخول الى لوحة التحكم الخاصة بك  "; 
                                // Automatcly dirctory to Dashbarde
                                 echo "<script>alert('".$msg."');</script>";
                                 echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
                                
                            }else{
                                $erorr="المعذرة، يرجى المحاولة مرة أخرى";  
                            }
                          
                      }else{
                          
                          //IF WAS FREE REGISTER
                           //INSERT DATA
                            $sql="INSERT INTO `tblmembers`(`CID`,`Name`,`Birth`,`Country`,`Phone`,`Email`, Password,`Addresses`, `Gender`) VALUES (:CID,:NA,:BR,:CO,:PH,:EM,'$PPS',:AD,:GN)";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':CID',$PCID,PDO::PARAM_INT);
                            $query->bindParam(':NA',$PNA,PDO::PARAM_STR);
                            $query->bindParam(':BR',$PBR,PDO::PARAM_STR);
                            $query->bindParam(':CO',$PCO,PDO::PARAM_STR);
                            $query->bindParam(':PH',$PPH,PDO::PARAM_STR);
                            $query->bindParam(':EM',$PEM,PDO::PARAM_STR);
                            $query->bindParam(':AD',$PAD,PDO::PARAM_STR);
                            $query->bindParam(':GN',$PGN,PDO::PARAM_INT);
                            $query->execute();
                            $lastInsertId = $dbh->lastInsertId();
                            if($lastInsertId)
                            {
                                 // UPDATE FROM REGISTER STATUS
                                 $sql="UPDATE `tblcheackfromregistermembers` SET Status='1' WHERE ID=:CID";
                                 $query = $dbh->prepare($sql);
                                 $query->bindParam(':CID',$PCID,PDO::PARAM_INT);
                                 $query->execute();
                                
                                //SHOW MASSAGE
                                 $msg="تمت تسجيل عضويتك  بنجاح .. قم بادخل بيانات الدخول الى لوحة التحكم الخاصة بك  "; 
                                // Automatcly dirctory to Dashbarde
                                 echo "<script>alert('".$msg."');</script>";
                                 echo "<script type='text/javascript'> document.location = 'index.php'; </script>";
                            }else{
                                 $erorr="المعذرة، يرجى المحاولة مرة أخرى";  
                            }
                      }
                    
                       
                 }// END else IF WHAS FOUND
              
        
            
    }//END SUBMIT REGISTER
    

    
    
    





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
//    htmlentities($_SESSION['ICONSYSTEM']=$result->Icon);
//    htmlentities($_SESSION['DOMAINSYSTEM']=$result->Domain);
?>  
              <div class="d-flex justify-content-center py-4">
                <a href="login.php" class="logo d-flex align-items-center w-auto">
                  <span class="d-none d-lg-block" style="font-family: 'Cairo';"><?php echo htmlentities($CNAME);?> </span>
                    <span > <img src="<?php echo $DirassetsImage.phpentities($ICON);?>" alt="<?php echo htmlentities($CNAME);?>"></span>
                </a>
              </div><!-- End Logo -->
<?php }} ?>
              <div class="card mb-3">

                <div class="card-body">

                     <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4" style="font-family: 'Cairo';">سجل عضويتك</h5>
                    <p class="text-center small">أهــلا بك ، يرجى كتابة جميع بياناتك الشخصية </p>
                  </div>
                    
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                   مـــرحباً  <?php echo htmlentities($EM) ; ?>
           
                 </div>

                  <form class="row g-3 needs-validation" method="post" action="" novalidate>
                     <div class="col-12" style="display: none; ">
                      <input type="text"  class="form-control" id="yourName" value="<?php echo htmlentities($MID); ?>" disabled >   
                      <input type="text" name="CID" class="form-control" id="yourName" value="<?php echo $MID; ?>"  >                                            
                     </div>
<?php if($PI){ ?>                   
                     <div class="col-12" style="display: none; ">
                      <input type="text"  class="form-control" id="yourName" value="<?php echo htmlentities($PI); ?>" disabled >   
                      <input type="text" name="PI" class="form-control" id="yourName" value="<?php echo htmlentities($PI); ?>" >                                            
                     </div>
 <?php } ?>                     
                      
                     <div class="col-12" style="display: none; ">
                      <label for="yourEmail" class="form-label"> رقم هاتفك</label>
                      <input type="text" name="PH" class="form-control" id="phoneid" maxlength="9" value="<?php echo $PH; ?>" required>
                      <div class="invalid-feedback">المعذرة، يرجى تعبئة الحقل!</div>
                    </div> 
                    <div class="col-12" style="display: none; ">
                      <label for="yourEmail" class="form-label">بريدك الالكتروني</label>
                      <input type="email" name="EM" class="form-control" id="yourEmail" value="<?php echo $EM; ?>"  required>
                      <div class="invalid-feedback">المعذرة، يرجى تعبئة الحقل!</div>
                    </div>
<?php if($CO){ ?>
                    <div class="col-12" style="display: none; ">
                      <label for="yourName" class="form-label">البلد </label> 
                      <input type="text" name="CO" class="form-control" value="<?php echo $CO; ?>"   required>             <div class="invalid-feedback">المعذرة، يرجى تعبئة الحقل!</div>
                    </div>
<?php } ?>
                    <div class="col-12">
                      <label for="yourName" class="form-label">إسمك الرباعي</label> 
                      <input type="text" name="NA" class="form-control" id="yourName" required>             <div class="invalid-feedback">المعذرة، يرجى تعبئة الحقل!</div>
                    </div>
      
                    <div class="col-12">
                      <label for="yourName" class="form-label">عام الميلاد </label>
                     <select class="form-select" aria-label="Default select example" name="BR" required>
                        <option value="">حدد تاريخ ميلادك</option>
<?php
    
  for($i=2005; $i >= 1980; $i-- ){

?>
                         <option value=""><?php echo $i; ?></option>
<?php } ?>
                                                                                                                                                                      
                        </select>  
                    </div>
             
                    <div class="col-12">
                      <label for="yourName" class="form-label">مكان الاقامة (عنوانك) </label>
                      <input type="text" name="AD" class="form-control" id="yourName" required>
                      <div class="invalid-feedback">المعذرة، يرجى تعبئة الحقل!</div>
                    </div>
                    <div class="col-12">
                        <label for="yourEmail" class="form-label">نوع الجنس</label>
                       <fieldset class="row mb-3">
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="GN" id="gridRadios1" value="1" checked >
                          <label class="form-check-label" for="gridRadios1">
                             <?php echo "ذكر"; ?>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="GN" id="gridRadios2" value="2">
                          <label class="form-check-label" for="gridRadios2">
                           <?php echo "أنثى"; ?> 
                          </label>
                        </div>
                      </div>
                      </fieldset>
                    </div>
                

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">كلمة المرور</label>
                      <input type="password" name="PS" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">المعذرة، يرجى تعبئة الحقل!</div>
                    </div>

                   
                    <div class="col-12">
                        <br><br>
                      <button class="btn btn-primary w-100" type="submit" name="REGISTER">إنشاء الحساب</button>
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
<?php // } ?>