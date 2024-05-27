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


            $target_dir=$DirUPLOADIN_Uploads_File_Category; 
            $target_file= $target_dir . basename($_FILES["Icon"]["name"]);
            $Iconfile=$_FILES["Icon"]["name"];
            move_uploaded_file($_FILES["Icon"]["tmp_name"], $target_file);
            
            $PN=$_POST['NAME'];    
            $PAB=$_POST['ABU']; 
            //CHECHED FROM FOUND OR NOT
            $sql="SELECT ID  FROM `tblcategory` WHERE Name='$PN' ";
            $query = $dbh->prepare($sql);
            $query->execute();
            if($query->rowCount() > 0)
            {
                 $erorr="المعذرة، هذا الصنف  موجود مسبقا في قاعدة البيانات"; 

            }else{
                  
            $sql="INSERT INTO tblcategory(Name,Image,about) VALUES (:NAME,'$Iconfile','$PAB');";    
            $query = $dbh->prepare($sql);
            $query->bindParam(':NAME',$PN,PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if($lastInsertId)
            {
                $msg="تم إضافة الصنف بنجاح";  
            }else{
                $erorr="المعذرة، أحيانا تحدث أخطاء.. الرجاء المحاولة مجددا!"; 
            }

         }//END CHECHED FROM FOUND OR NOT
        }//END SUBMIT
       // Update Category  Block 
             if(isset($_GET['block']))
            {
 
                $pra=$_GET['block'];
                $sql="update tblcategory  set Status=0 where id=:block "; 
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
                $sql="update tblcategory  set Status=1 where id=:unblock "; 
                $query = $dbh->prepare($sql);
                $query->bindParam(':unblock',$pra,PDO::PARAM_STR);
                $query->execute();
                  if($query){
                       $msg="تم تحديث بيانات السجل بنجاح";   
                    }else{
                        $erorr="المعذرة، يرجى المحاولة مرة أخرى";  
                    }
            }

?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title> <?php echo $CNAME." || "."  الاصناف والأقسام    " ;?> </title>
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
      <h1> <?php echo "إضافة صنف"; ?> </h1>
    </div><!-- End Page Title -->

    <section class="section" >
      <div class="row" style=" width:150%;">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">  <?php echo "أدخل بيانات الصنف"; ?> </h5>

              <!-- General Form Elements -->
              <form method="post" action="" enctype="multipart/form-data">
        
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label"><?php echo "بنل القسم  "; ?> </label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile" name="Icon">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label"><?php echo " إسم الصنف /القسم"; ?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="NAME" placeholder="مثلا: فلاتر ">
                  </div>
                </div>
                 <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-2 col-form-label"><?php echo " حول الصنف /القسم"; ?></label>
                  <div class="col-sm-10">
                    <textarea class="form-control" name="ABU" rows="5"></textarea>
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
              <h5 class="card-title"><?php echo "بيانات الأصناف";?></h5>
             

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?php echo " إسم القسم";?></th>
                    <th scope="col"><?php echo " ايقونة القسم";?></th>
                    <th scope="col"><?php echo "حول العارض";?></th>
                    <th scope="col"><?php echo "حالة العرض";?></th>
                    <th scope="col"><?php echo "تحديث العرض";?></th>
                    <th scope="col"><?php echo "تحديث البيانات";?></th>
                    </tr>
                </thead>
                <tbody>
<?php 
$sql = "SELECT\n"

    . "    `ID`,\n"

    . "    `Name`,\n"

    . "    `Image`,\n"

    . "    `about`,\n"

    . "    `Status`\n"

    . "FROM\n"

    . "    `tblcategory`\n"

    . "WHERE\n"

    . "    1;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{ 
   
?>  
                                                <tr>
                                                        <td><?php echo htmlentities($cnt);?></td>
                                                        <td><?php echo htmlentities($result->Name);?></td>
                                                        <td><?php 
  
if($result->Image){
       echo"<img class='img-file' class=rounded-circle  src='".$DirUPLOADIN_Uploads_File_Category.htmlentities($result->Image)."'>"."</img>";
}else{
       echo "<i class='bi bi-image'>"."</i>";
} 
    
                                                        ?></td>
                                                       <td><?php echo htmlentities($result->about);?></td>
                                                       <td><?php 
if($result->Status == '1'){
    echo"يتم عرضه في الموقع";
}else{
    echo"لا يتم عرضه في الموقع";
}

    
                                                        ?></td>
                                                            <td>
                                                                <a href="Edit-Category.php?catid=<?php echo htmlentities($result->ID);?>"><i class="bi bi-pencil-fill" title="<?php echo "تحديث المنتج";?>"></i> </a>
                                                            </td>
<?php if($result->Status == '1'){ ?>                                               
                                                    
                                                        <td>
                                                            <a href="Category.php?block=<?php echo htmlentities($result->ID);?>"><i class="bi bi-check-lg" title="<?php echo "تحديث السجل";?>" onClick="return confirm('<?php echo "هل انت متأكد!";?>');"></i> </a>
                                                        </td>
<?php }else{ ?>                                                  
                                                    
                                                    
                                                        <td>
                                                            <a href="Category.php?unblock=<?php echo htmlentities($result->ID);?>"><i class="bi bi-x" title="<?php echo "تحديث السجل";?>" onClick="return confirm('<?php echo "هل انت متأكد!";?>');"></i> </a>
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

</body>

</html>
<?php } ?>