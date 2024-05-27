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
        
        // submit this page
if(isset($_POST['submit']))
{



    $target_dir=$DirUPLOADIN_Uploads_File_Adds;
    //load logo file   
    $target_file= $target_dir . basename($_FILES["Icon"]["name"]);
    $Iconfile=$_FILES["Icon"]["name"];
    move_uploaded_file($_FILES["Icon"]["tmp_name"], $target_file);
    $PT=$_POST['TITLE'];    
    $PP=$_POST['PRICE']; 
    $PC=$_POST['CUR']; 
    $PTY=$_POST['TYPE']; 
    $PO=$_POST['OPTION']; 
    $PA=$_POST['ABUOT']; 
    $PSS=$_POST['SS'];
    $PSB=$_POST['SB']; 
    $sql="INSERT INTO tbladds(AdminId,title,Image,price,cur,type,option,submitbutton,about,Status) VALUES ('".$_SESSION['ADMIN_ID']."',:TITLE,'$Iconfile',:PRICE,:CUR,:TYPE,:OPTION,:SB,:ABUOT,:SS);";    
    $query = $dbh->prepare($sql);
    $query->bindParam(':TITLE',$PT,PDO::PARAM_STR);
    $query->bindParam(':PRICE',$PP,PDO::PARAM_STR);
    $query->bindParam(':CUR',$PC,PDO::PARAM_STR);
    $query->bindParam(':TYPE',$PTY,PDO::PARAM_STR);
    $query->bindParam(':OPTION',$PO,PDO::PARAM_STR);
    $query->bindParam(':SB',$PSB,PDO::PARAM_STR);
    $query->bindParam(':ABUOT',$PA,PDO::PARAM_STR);
    $query->bindParam(':SS',$PSS,PDO::PARAM_INT);
    $query->execute(); 
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        $msg="تم إضافة الاعلان بنجاح";  
    }else{
        $erorr="المعذرة، أحيانا تحدث أخطاء.. الرجاء المحاولة مجددا!"; 
    }
// 
}
    
           // Update Category  Block 
             if(isset($_GET['block']))
            {
 
                $pra=$_GET['block'];
                $sql="update tbladds  set Status=0 where id=:block "; 
                $query = $dbh->prepare($sql);
                $query->bindParam(':block',$pra,PDO::PARAM_STR);
                $query->execute();
                  if($query){
                      $msg="تم تحديث بيانات السجل بنجاح";  
                    }else{
                        $erorr="المعذرة، يرجى المحاولة مرة أخرى";  
                    }
            }
        
           // Update Classification  unBlock 
             if(isset($_GET['unblock']))
            {
           
                $pra=$_GET['unblock'];
                $sql="update tbladds  set Status=1 where id=:unblock "; 
                $query = $dbh->prepare($sql);
                $query->bindParam(':unblock',$pra,PDO::PARAM_STR);
                $query->execute();
                  if($query){
                       $msg="تم تحديث بيانات السجل بنجاح";   
                    }else{
                        $erorr="المعذرة، يرجى المحاولة مرة أخرى";  
                    }
            }
       //delete 
        if(isset($_GET['adid']))
        {
            $id=intval($_GET['adid']);
            $sql="delete from tbladds where id=:adid ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':adid',$id,PDO::PARAM_INT);
            $query->execute();
            if($query){
              $msg="تم حذف المنتج بنجاح";  
            }else{
               $erorr="المعذرة، أحيانا تحدث أخطاء.. الرجاء المحاولة مجددا!";  
            }   

        }
    
       
       

?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

 
  <title> <?php echo $CNAME." || "."  إضافة {$LANG->WORD11}   " ;?> </title>
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
      <h1> <?php echo "إضافة عرض"; ?> </h1>
    </div><!-- End Page Title -->

    <section class="section" >
      <div class="row" style=" width:150%;">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">  <?php echo "أدخل بيانات العرض"; ?> </h5>

              <!-- General Form Elements -->
              <form method="post" action="" enctype="multipart/form-data">
                <?php if(isset($_SESSION['AdminName'])){ ?>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label"> <?php echo " بيانات المستخدم"; ?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo htmlentities($_SESSION['AdminName']);  ?>" disabled >
                  </div>
                </div>  
                <?php }?>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label"> <?php echo "تاريخ النشر"; ?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" value="<?php echo htmlentities($today);  ?>" disabled >
                  </div>
                </div>  
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label"><?php echo "ملف البنر  "; ?> </label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile" name="Icon">
                  </div>
                </div>  
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label"><?php echo "عنوان العرض"; ?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="TITLE"  >
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label"><?php echo "حول العرض"; ?></label>
                  <div class="col-sm-10">
                      <textarea  class="form-control" name="ABUOT" rows="5" dir="rtl"></textarea>  
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label"><?php echo "سعر العرض"; ?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="PRICE" value="0"  >
                  </div>
                </div>
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"><?php echo " العملة";?></label>
                  <div class="col-sm-10">
                  <select class="form-select" aria-label="Default select example" name="CUR" required>
                      <option value="">يرجى تحديد العملة</option>
<?php $sql = "SELECT ID,Name from tblcurrncy";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{   
    if($result->ID == 2 ){
        echo "<option value='".$result->ID."' >" .$result->Name. "</option>";
    }else{
        echo "<option value='".$result->ID."'disabled >" .$result->Name. "</option>"; 
    }               
?>
<!--<option value="<?php echo htmlentities($result->ID); ?>" style=""><?php echo htmlentities($result->Name); ?></option>-->
<?php }}else{ echo "<option>"."لا توجد عملات "."</option>"; } ?>
                    </select>
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label"><?php echo "حدث التفعيل "; ?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="SB" value="إشتر الآن" required>
                  </div>
                </div>
                <div class="row mb-3">
                    <fieldset class="row mb-3">
                      <legend class="col-form-label col-sm-2 pt-0"><?php echo "صلاحية عرض المنشورس "; ?></legend>
                      <div class="col-sm-10">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" name="SS" id="gridRadios1" value="1"  >
                          <label class="form-check-label" for="gridRadios1">
                             <?php echo "يتم عرضه في الموقع حالا"; ?>
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio"  name="SS" id="gridRadios2" value="0" checked>
                          <label class="form-check-label" for="gridRadios2">
                           <?php echo "لا يتم عرضه في الموقع حالا"; ?> 
                          </label>
                        </div>
                      </div>
                    </fieldset>
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
              <h5 class="card-title"><?php echo "بيانات الاعلان";?></h5>
             

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?php echo "عنوان العرض";?></th>
                    <th scope="col"><?php echo " بنر العرض";?></th>
                    <th scope="col"><?php echo " سعر الاعلان";?></th>
                    <th scope="col"><?php echo " نوع تقديم الاعلان ";?></th>
                     <th scope="col"><?php echo "حول العرض ";?></th>
<!--                    <th scope="col"><?php echo " مميزات الاعلان ";?></th>-->
                    <th scope="col"><?php echo "حالة العرض";?></th>
                    <th scope="col"> <?php echo "تحديث";?></th>
                    <th scope="col"> <?php echo "حذف";?></th>
                    </tr>
                </thead>
                <tbody>
<?php $sql = "SELECT * FROM `tbladds` ORDER BY CreateDate DESC;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
    $DateResult=$result->CreateDate;
    $currentDate = new DateTime($DateResult);
    $DR=$currentDate->format('Y-M-j'); 
    
?>  
                                                <tr> 
                                                        <td><?php echo htmlentities($cnt);?></td>
                                                        <td><?php echo htmlentities($result->title);?></td>
                                                        <td><?php 
   if($result->Image){
    echo"<img class='img-file' width='100'   src='".$DirUPLOADIN_Uploads_File_Adds.htmlentities($result->Image)."'>"."</img>";
    }else{
        echo"<img class='img-file' width='100'   src='".$DirUPLOADIN_Uploads_File_Adds."/defult-icon.png'>"."</img>";
    } 

    
                                                        ?></td>
                                                        <td><?php 
$sql2 = "SELECT Name from tblcurrncy WHERE ID ='$result->cur' ";
$query = $dbh->prepare($sql2);
$query->execute();
$results2=$query->fetch();
echo htmlentities($result->price)." ".$results2['Name'];
                                                           
                                                           ?></td>
                                                        <td><?php 
if($result->type == '1'){
    echo " مجانا";
}
if($result->type == '2'){
    echo " لكل عملية بيع";
}
if($result->type == '3'){
    echo " / شهريا";
}
if($result->type == '4'){
    echo "/ سنويا";
}

                                                            ?> </td>
                                                           <td><?php 
echo substr($result->about, 0, 100);
    
                                                            ?> </td>
                                                        <td><?php 
if($result->Status == '1'){
    echo"يتم عرضه في الموقع";
}else{
    echo"لا يتم عرضه في الموقع";
}

    
                                                        ?></td>
<?php if($result->Status == '1'){ ?>                                               
                                                    
                                                        <td>
                                                            <a href="Adds.php?block=<?php echo htmlentities($result->id);?>"><i class="bi bi-check-lg" title="<?php echo "تحديث السجل";?>" onClick="return confirm('<?php echo "هل انت متأكد!";?>');"></i> </a>
                                                        </td>
<?php }else{ ?>                                                  
                                                    
                                                    
                                                        <td>
                                                            <a href="Adds.php?unblock=<?php echo htmlentities($result->id);?>"><i class="bi bi-x" title="<?php echo "تحديث السجل";?>" onClick="return confirm('<?php echo "هل انت متأكد!";?>');"></i> </a>
                                                        </td>
<?php } ?>
                                                        <td>
                                                            <a href="Adds.php?adid=<?php echo htmlentities($result->id);?>"><i class="bi bi-trash-fill" title="<?php echo "حذف السجل";?> "  onClick="return confirm('<?php echo "هل أنت متأكد من الحذف!";?>');"></i> </a>

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
    <?php include("Link/footer.php"); ?>
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
  <script src="Ajax/js/jquery.js"></script>
</body>

</html>
<?php } ?>