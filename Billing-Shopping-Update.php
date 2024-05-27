<?php

require_once('Links/Setting.php');
// Check if the customer is logged in or not
if(!isset($_SESSION['customer'])) {
    header('location: logout.php');
    exit;
} else {
    // If customer is logged in, but admin make him inactive, then force logout this user.
    $statement = $dbh->prepare("SELECT * FROM tblcustomer WHERE cust_id=? AND cust_status=?");
    $statement->execute(array($_SESSION['customer']['cust_id'],0));
    $total = $statement->rowCount();
    if($total) {
        header('location: logout.php ');
        exit;
    }
}

if (isset($_POST['form1'])) {


    // update data into the database
    $statement = $dbh->prepare("UPDATE tblcustomer SET 
                            cust_b_name=?, 
                            cust_b_cname=?, 
                            cust_b_phone=?, 
                            cust_b_country=?, 
                            cust_b_address=?, 
                            cust_b_city=?, 
                            cust_b_state=?
                            
                        
                            WHERE cust_id=?");
    $statement->execute(array(
                            strip_tags($_POST['cust_b_name']),
                            strip_tags($_POST['cust_b_cname']),
                            strip_tags($_POST['cust_b_phone']),
                            strip_tags($_POST['cust_b_country']),
                            strip_tags($_POST['cust_b_address']),
                            strip_tags($_POST['cust_b_city']),
                            strip_tags($_POST['cust_b_state']),
                 
                            $_SESSION['customer']['cust_id']
                        ));  
   
    $success_message = "تم التحديث بنجاح";

    $_SESSION['customer']['cust_b_name'] = strip_tags($_POST['cust_b_name']);
    $_SESSION['customer']['cust_b_cname'] = strip_tags($_POST['cust_b_cname']);
    $_SESSION['customer']['cust_b_phone'] = strip_tags($_POST['cust_b_phone']);
    $_SESSION['customer']['cust_b_country'] = strip_tags($_POST['cust_b_country']);
    $_SESSION['customer']['cust_b_address'] = strip_tags($_POST['cust_b_address']);
    $_SESSION['customer']['cust_b_city'] = strip_tags($_POST['cust_b_city']);
    $_SESSION['customer']['cust_b_state'] = strip_tags($_POST['cust_b_state']);
    
     echo "<script>alert('".$success_message."')</script>";
     echo "<script type='text/javascript'> document.location = 'checkout.php'; </script>";

}

    
?><!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo htmlentities($MetaTitleHome);?></title>
  <meta content="<?php echo htmlentities($MetaDescriptionHome);?>" name="description">
  <meta content="<?php echo htmlentities($MetaKeywordHome);?>" name="keywords">
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Variables CSS Files. Uncomment your preferred color scheme -->
  <?php include("Links/Setup-Color-Page.php");  ?>
  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <link href="assets/css/style-arabic.css" rel="stylesheet">
  <style>
 
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 
    {
      font-family: 'Cairo';  
    }
      .flex-shrink-0{
          margin-left: 5%;
      }
      .badge-number{
          width: 50%;
      } 
      
</style>
</head>
<body>

  <!-- ======= Header ======= --> 
    <?php include("Links/header-Section.php"); ?>
  <!-- End Header -->
  <main id="main">
    <!-- ======= Blog Section ======= -->
    <section class="inner-page">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>تحديث البيانات</h2>
          <p> تحديث بيانات الشحن</p>
          <p> بيانات الشحن الأفتراضية الخاصة بك..</p>
        </div>
        <div class="section-header">
        <section id="contact" class="contact">
      <div class="container">

        <div class="section-header">
          <div class="col-lg-8">
            <form action="" method="post"  class="form">
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="cust_b_name" class="form-control" id="name" placeholder="إسمك" value="<?php echo $_SESSION['customer']['cust_b_name']; ?>" required>
                </div>
                 <br><br>
                <div class="col-md-6 form-group">
                  <input type="text"  class="form-control" id="name" placeholder="اسم النشاط" name="cust_b_cname" value="<?php echo $_SESSION['customer']['cust_b_cname']; ?>" >
                </div>
              </div>
            <br>
             <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" class="form-control"  id="phone" placeholder="رقم هانفك " name="cust_b_phone" value="<?php echo $_SESSION['customer']['cust_b_phone']; ?>" maxlength="9" >
                </div>
                  <br><br>
                 <div class="col-md-6 form-group">
                   <select name="cust_b_country" class="form-control"><?php
                                        $statement = $dbh->prepare("SELECT * FROM tblcountry WHERE ID=2");
                                        $statement->execute();
                                        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                                        foreach ($result as $row) {
                                            ?>
                                            <option value="<?php echo $row['ID']; ?>" <?php if($row['ID'] == $_SESSION['customer']['cust_s_country']) {echo 'selected';} ?>><?php echo $row['Name']; ?></option>
                <?php }
                                       
                                    
                     ?> </select>
                </div>
                
              </div>
               
              <div class="form-group mt-3">
                 <input type="text" class="form-control" name="cust_b_city" value="<?php echo $_SESSION['customer']['cust_b_city']; ?>" placeholder="المدينة">
              </div>
              <div class="form-group mt-3">
                 <input type="text" class="form-control" name="cust_b_state" value="<?php echo $_SESSION['customer']['cust_b_state']; ?>" placeholder="الحي">
              </div>
              <div class="form-group mt-3">
                <textarea name="cust_b_address" class="form-control" cols="30" rows="10" style="height:100px;"><?php if($_SESSION['customer']['cust_b_address']) {
                    echo $_SESSION['customer']['cust_b_address']; 
                    }else{
                      echo "معلومات وتفاصيل أخرى لمنزل المستلم";
                    }
                    ?></textarea>
              </div>  
     
              <div class="d-grid gap-2 mt-3">
                <button class="btn " type="submit" name="form1"  style=" background-color: var(--color-primary);" >تحديث البانات</button>
              </div>
            </form>
        
          </div><!-- End Contact Form -->

        </div>

      </div>
     </section>
            
            
        </div>
      </div>
    </section><!-- End Inner Page -->
  

  </main><!-- End #main -->

 <!-- ======= Header ======= --> 
    <?php include("Links/footer-Section.php"); ?>
  <!-- End Header -->
  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>