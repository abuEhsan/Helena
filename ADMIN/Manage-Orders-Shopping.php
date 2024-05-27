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
        
          

?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <title> <?php echo $CNAME." || "."    إدارة الطلبات  " ?> </title>
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
      <h1><?php echo "طلبات مشتريات التسوق";?> </h1>
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
              <h5 class="card-title"><?php echo "بيانات الطلبات";?></h5>
             

              <!-- Table with stripped rows -->
              <table class="table table-striped table-bordered datatable" dir="rtl" border="2">
                <thead>
			    <tr>
			        <th scope="col">#</th>
                    <th scope="col">الزبون</th>
			        <th scope="col">تفاصيل المنتج</th>
                    <th scope="col">
                    	معلومات الدفع
                    </th>
                    <th scope="col">المبلغ المدفوع</th>
                    <th scope="col">حالة الدفع</th>
                    <th scope="col">حالة الشحن والتوصيل</th>
<!--			        <th scope="col">تحديث</th>-->
			    </tr>
			</thead>
            <tbody>
            	<?php
            	$i=0;
            	$statement = $dbh->prepare("SELECT * FROM tblpayment ORDER by id DESC");
            	$statement->execute();
            	$result = $statement->fetchAll(PDO::FETCH_ASSOC);							
            	foreach ($result as $row) {
            		$i++;
            		?>
					<tr class="<?php if($row['payment_status']=='Pending'){echo 'bg-r';}else{echo 'bg-g';} ?>">
	                    <td scope="row"><?php echo $i; ?></td>
	                    <td>
                            <b>الزبون:</b><?php echo $row['customer_name']; ?><br>
                            <b>هاتف الزبون:</b><?php 
                                        $sql = "SELECT cust_phone FROM tblcustomer WHERE cust_email='{$row['customer_email']}'";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results=$query->fetch();
                                        echo $results['cust_phone'];                      
                            ?> <i class="bi bi-whatsapp"></i><br>
                            <b>بريد الزبون:</b><?php echo $row['customer_email']; ?><br>
                        </td>
                        <td>
                           <?php
                           $statement1 = $dbh->prepare("SELECT * FROM tblorder WHERE payment_id=?");
                           $statement1->execute(array($row['payment_id']));
                           $result1 = $statement1->fetchAll(PDO::FETCH_ASSOC);
                           foreach ($result1 as $row1) {
                                echo '<b>المنتج:</b> '.$row1['product_name'];
                                echo '<br><b>الكمية: </b> '.$row1['quantity'];
                                echo '<br><b>وحدة السعر:</b> '.$row1['unit_price'].'';
                                echo '<br><br>';
                           }
                           ?>
                        </td>
                        <td>
                        	<?php if($row['payment_method'] == 'PayPal'): ?>
                        		<b>وسيلة الدفع:</b> <?php echo '<span style="color:red;"><b>'.$row['payment_method'].'</b></span>'; ?><br>
                        		<b>رقم الطلب:</b> <?php echo $row['payment_id']; ?><br>
                        		<b>تاريخ الدفع:</b> <?php echo $row['payment_date']; ?><br>
                        		<b> رقم الحوالة:</b> <?php echo $row['txnid']; ?><br>
                        	<?php elseif($row['payment_method'] == 'Stripe'): ?>
                        		<b>وسيلة الدفع:</b> <?php echo '<span style="color:red;"><b>'.$row['payment_method'].'</b></span>'; ?><br>
                        		<b>معرف الدفع:</b> <?php echo $row['payment_id']; ?><br>
								<b>تاريخ الدفع:</b> <?php echo $row['payment_date']; ?><br>
                        		<b>معررف الحوالة:</b> <?php echo $row['txnid']; ?><br>
                        		<b>رقم البطاقة:</b> <?php echo $row['card_number']; ?><br>
                        		<b>Card CVV:</b> <?php echo $row['card_cvv']; ?><br>
                        		<b>Expire Month:</b> <?php echo $row['card_month']; ?><br>
                        		<b>Expire Year:</b> <?php echo $row['card_year']; ?><br>
                        	<?php elseif($row['payment_method'] == 'Bank Deposit'): ?>
                        		<b>وسيلة الدفع:</b> <?php echo '<span style="color:red;"><b>'.$row['payment_method'].'</b></span>'; ?><br>
                        		<b>معرف الدفع:</b> <?php echo $row['payment_id']; ?><br>
								<b>تاريخ الدفع:</b> <?php echo $row['payment_date']; ?><br>
                        		<b>معلومات الحوالة:</b> <br><?php echo $row['bank_transaction_info']; ?><br>
                        	<?php endif; ?>
                        </td>
                        <td><?php echo $row['paid_amount']; ?></td>
                        <td><?php 
                            
                                
                                 if($row['payment_status']=='Pending' ){
                                        $msg="هل أنت متأكد؟";
                                        echo "جارِ التحقق من الدفع "."<br>";
                                        echo"<a href='order-change-status.php?id={$row['id']}&task=Completed' class='btn btn-outline-success' style='margin-bottom:1px;' onClick='return confirm('".$msg."');' '>تأكيد الدفع </a>";
                                    }else if($row['payment_status']=='Completed'){
                                    echo "تم  التحقق  "."<br>";
                                    }else{
                                        echo " يوجد خطأ ..يرجى مراجعة العملية "."<br>";
                                   }
                             
                            ?>
                        </td>
                         <td>
                            <?php 
                            
                                if($row['payment_status']=='Completed') {
                                    if($row['payment_status']=='Completed' && $row['shipping_status']=='Pending'){
                                        $msg="هل أنت متأكد؟";
                                        echo "قيد الشحن والتوصيل"."<br>";
                                        echo"<a href='shipping-change-status.php?id={$row['id']}&task=Completed' class='btn btn-outline-success' style='margin-bottom:1px;' onClick='return confirm('{$msg}');' '>تأكيد الشحن والتوصيل</a>";
                                    }else if($row['payment_status']=='Completed' && $row['shipping_status']=='Completed'){
                                    echo "تم الشحن والتوصيل"."<br>";
                                    }else{
                                        echo " يوجد خطأ ..يرجى مراجعة العملية "."<br>";
                                   }
                                }else{
                                    echo ""."<br>";
                                }
                            ?>
                        </td>

<!--
	                    <td>
                            <a href="#" class="btn btn-danger btn-xs" data-href="order-delete.php?id=<?php echo $row['id']; ?>" data-toggle="modal" data-target="#confirm-delete" style="width:100%;">Delete</a>
	                    </td>
-->
	                </tr>
            		<?php
            	}
            	?>
            </tbody>
              
              </table>
              <!-- End Table with stripped rows -->

            </div>
          </div>

        </div>
      </div>
    </section>
<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Delete Confirmation</h4>
            </div>
            <div class="modal-body">
                Sure you want to delete this item?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <a class="btn btn-danger btn-ok">Delete</a>
            </div>
        </div>
    </div>
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
<?php } ?>