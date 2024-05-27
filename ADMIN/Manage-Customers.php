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
        
           // Update Customer  Block 
             if(isset($_GET['block']))
            {
 
                $pra=$_GET['block'];
                $sql="update tblcustomer  set cust_status=0 where cust_id=:block "; 
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
                $sql="update tblcustomer  set cust_status=1 where cust_id=:unblock "; 
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
  <meta content="" name="description">
  <meta content="" name="keywords">
  <title> <?php echo $CNAME." || "."    إدارة المشتركين  "; ?> </title>
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
 <?php // include("Link/sidebar-old.php"); ?>
    <!-- End Sidebar-->

 
  <main id="main" class="main">

    <div class="pagetitle">
      <h1><?php echo "إدارة المشتركين";?> </h1>
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
              <h5 class="card-title"><?php echo "تفاصيل بيانات المشترك";?></h5>
       

              <!-- Table with stripped rows -->
              <table class="table datatable">
                <thead>
                  <tr>
                    <th scope="col">#</th>
                    <th scope="col"><?php echo "رقم المشترك ";?></th>
                    <th scope="col"><?php echo "إسم الحساب ";?></th>
                    <th scope="col"><?php echo "بيانات الاتصال ";?></th>
                    <th scope="col"><?php echo "العنوان ";?></th>
                    <th scope="col"><?php echo "تاريخ التسجيل";?></th>
                    <th scope="col"><?php echo "حالة الحساب";?></th>
                    <th scope="col"><?php echo "تحديث الحساب";?></th>
                      
                      

                    </tr>
                </thead>
                <tbody>
<?php 
$sql = "SELECT\n"

    . "    `cust_id`,\n"

    . "    `cust_name`,\n"

    . "    `cust_cname`,\n"

    . "    `cust_email`,\n"

    . "    `cust_phone`,\n"

    . "    `cust_country`,\n"

    . "    `cust_address`,\n"

    . "    `cust_city`,\n"

    . "    `cust_state`,\n"

    . "    `cust_zip`,\n"

    . "    `cust_b_name`,\n"

    . "    `cust_b_cname`,\n"

    . "    `cust_b_phone`,\n"

    . "    `cust_b_country`,\n"

    . "    `cust_b_address`,\n"

    . "    `cust_b_city`,\n"

    . "    `cust_b_state`,\n"

    . "    `cust_b_zip`,\n"

    . "    `cust_s_name`,\n"

    . "    `cust_s_cname`,\n"

    . "    `cust_s_phone`,\n"

    . "    `cust_s_country`,\n"

    . "    `cust_s_address`,\n"

    . "    `cust_s_city`,\n"

    . "    `cust_s_state`,\n"

    . "    `cust_s_zip`,\n"

    . "    `cust_password`,\n"

    . "    `cust_token`,\n"

    . "    `cust_datetime`,\n"

    . "    `cust_timestamp`,\n"

    . "    `cust_status`\n"

    . "FROM\n"

    . "    `tblcustomer`\n"

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
    $DateResult=$result->cust_datetime;
    $currentDate = new DateTime($DateResult);
    $DR=$currentDate->format('Y-M-j');
    
?>  
                                                <tr>
                                                        <td><?php echo htmlentities($cnt);?></td>
                                                        <td><?php echo htmlentities($result->cust_id);?></td>
                                                        <td><?php echo htmlentities($result->cust_name);?></td>
                                                        <td><?php echo htmlentities($result->cust_phone)."<br>".htmlentities($result->cust_email);?></td>
                                                        <td><?php echo htmlentities($result->cust_s_address)." - ".htmlentities($result->cust_s_city)." - ".htmlentities($result->cust_s_city);?></td>
                                                        <td><?php echo htmlentities($DR);?></td>
                                                        <td><?php 
if($result->cust_status == '1'){
    echo"الحساب نشط";
}else{
    echo"الحساب محجوب";
}

    
                                                        ?></td>
<?php if($result->cust_status == '1'){ ?>                                               
                                                    
                                                        <td>
                                                            <a href="Manage-Customers.php?block=<?php echo htmlentities($result->cust_id);?>"><i class="bi bi-x" title="<?php echo "حظر الحساب";?>" onClick="return confirm('<?php echo "هل انت متاكد!";?>');" style="font-size: 25px;"></i>   </a>
                                                        </td>
<?php }else{ ?>                                                  
                                                    
                                                    
                                                        <td>
                                                            <a href="Manage-Customers.php?unblock=<?php echo htmlentities($result->cust_id);?>"><i class="bi bi-check-lg" title="<?php echo "رفع الحظر";?>" onClick="return confirm('<?php echo "هل انت متاكد!";?>');" style="font-size: 25px;"></i>   </a>
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