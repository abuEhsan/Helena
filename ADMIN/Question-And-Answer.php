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
        if(isset($_POST['insert']))
        {

            $PQU=$_POST['QU'];    
            $PAN=$_POST['AN']; 


            $sql="INSERT INTO tblquesandans(questiontext,answertext) VALUES (:QU,:AN);";    
            $query = $dbh->prepare($sql);
            $query->bindParam(':QU',$PQU,PDO::PARAM_STR);
            $query->bindParam(':AN',$PAN,PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if($lastInsertId)
            {
                $msg="تم إضافة البيانات بنجاح";  
            }else{
                $erorr="المعذرة، أحيانا تحدث أخطاء.. الرجاء المحاولة مجددا!"; 
            }

        }
        
      //delete Question
            if(isset($_GET['qid']))
            {
            $id=intval($_GET['qid']);
            $sql="delete from tblquesandans where id=:qid ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':qid',$id,PDO::PARAM_INT);
            $query->execute();
            if($query){
              $msg="تم حذف السجل بنجاح";  
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
  <title> <?php echo $CNAME." || "."    إدارة الاسئلة الشائعة  " ?> </title>
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
      <h1> <?php echo " إدارة الاسئلة الشائعة"; ?> </h1>
    </div><!-- End Page Title -->

    <section class="section" >
      <div class="row" style=" width:150%;">
        <div class="col-lg-6">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">  <?php echo "أدخل البيانات"; ?> </h5>

              <!-- General Form Elements -->
              <form method="post" action="" enctype="multipart/form-data">
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label"> <?php echo " محتوى السؤوال "; ?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="QU" placeholder="مثلا: إين يقع المركز الرئيسي" required >
                  </div>
                </div>    
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label"> <?php echo " محتوى الاجابة "; ?></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="AN" placeholder="مثلا: يقم المقر الرئيسي في الحديدة - الحي التجاري" required >
                  </div>
                </div> 
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label"></label>
                  <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="insert">     <?php echo "إتمام"; ?></button>
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
              <h5 class="card-title"><?php echo "بيانات الاسئلة الشائعة";?></h5>
             

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?php echo "محتوى السؤوال";?></th>
                    <th scope="col"><?php echo "محتوى الاجابة";?></th>
                    <th scope="col"><?php echo "تاريخ رفع البيانات";?></th>
                    <th scope="col"> <?php echo "تحديث";?></th>
                    <th scope="col"> <?php echo "حذف";?></th>
                    </tr>
                </thead>
                <tbody>
<?php $sql = "SELECT * FROM `tblquesandans` ORDER BY CreateDate DESC;";
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
                                                        <td><?php echo htmlentities($result->questiontext);?></td>
                                                        <td><?php echo htmlentities($result->answertext);?></td>
                                                        <td><?php echo htmlentities($DR);?></td>
                                                        <td>
                                                            <a href="Edit-QandA.php?id=<?php echo htmlentities($result->id);?>"><i class="bi bi-pencil-fill" title="<?php echo "تحديث السجل";?>"></i> </a>
                                                        </td>
                                                         <td>
                                                            <a href="Question-And-Answer.php?qid=<?php echo htmlentities($result->id);?>"><i class="bi bi-trash-fill" title="<?php echo "حذف السجل";?> "  onClick="return confirm('<?php echo "هل أنت متأكد من الحذف!";?>');"></i> </a>

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

</body>

</html>
<?php } ?>