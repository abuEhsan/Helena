<?php
//session_start();
include('Link/error-reporting.php');
        include('Link/config.php');
        include('Link/Setting.php');
        include("Link/Dir.php"); 
        include("Link/Favicons.php");
 

    
    
    
     if(isset($_POST['login']))
    { 
        //CHEACKED FROM ERORR INPUT DATA
         $ERORR = array();

        // Define variables and initialize with empty values
        $username = $password = "";
        $username_err = $password_err = $login_err = "";

        // Processing form data when form is submitted
        if($_SERVER["REQUEST_METHOD"] == "POST"){

            // Check if username is empty
            if(empty(trim($_POST["username"]))){
                $ERORR[] = "الرجاء كتابة بريدك الالكتروني";
            } else{
                $username = trim($_POST["username"]);
            }

            // Check if password is empty
            if(empty(trim($_POST["password"]))){
                $ERORR[] = "الرجاء كتابة كلمة المرور";
            } else{
                $password = trim($_POST["password"]);
            }

            // Validate credentials
            if(empty($username_err) && empty($password_err)){
                // Prepare a select statement
                 $sql ="SELECT ID,type,UserName,Password,AdminName,profile FROM tbladmin WHERE UserName=:username AND Status=1; ";

                if($stmt = $dbh->prepare($sql)){
                    // Bind variables to the prepared statement as parameters
                    $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

                    // Set parameters
                    $param_username = trim($_POST["username"]);

                    // Attempt to execute the prepared statement
                    if($stmt->execute()){
                        // Check if username exists, if yes then verify password
                        if($stmt->rowCount() == 1){
                            if($row = $stmt->fetch()){
                                $AID = $row["ID"];
                                $ATYPE = $row["type"];
                                $AUSERNAME = $row["UserName"];
                                $ANAME = $row["AdminName"];
                                $APROFILE = $row["profile"];
                                $hashed_password = $row["Password"];
                                if(password_verify($password, $hashed_password)){
                                    // Password is correct, so start a new session
                                    session_start();

                                    // Store data in session variables
                                    $_SESSION["ADMIN_LOGGED_IN"] = true;
                                    $_SESSION['ADMIN_ID']=$AID;
                                    $_SESSION['ADMIN_USERNAME']= $AUSERNAME;
                                    $_SESSION['ADMIN_NAME']= $ANAME;  
                                    $_SESSION['ADMIN_PROFILE']= $APROFILE; 
                                   //Whene Admin Root
                                     if($ATYPE && $AUSERNAME == "tariqbaobied_subport"){
                                      $_SESSION['ADMIN_ROOT']="on";   
                                      }

                                    // On Line
                                     $sqlUpdate="UPDATE tbladmin SET  OnLine='1',totallog=totallog+'1',TimeLogin=CURRENT_TIMESTAMP WHERE  ID='$AID' ";
                                     $queryUpdate = $dbh->prepare($sqlUpdate);
                                     $queryUpdate->execute();
                                    // Redirect user to welcome page
//                                    $ms_us="مرحبا : ". session_id();
//                                    echo "<script type='text/javascript'> alert('".$ms_us."') </script>";
                                   echo "<script type='text/javascript'> document.location = 'dashboard.php'; </script>";
                                } else{
                                    // Password is not valid, display a generic error message
                                    $login_err = "تحقق من كلمة المرور!";
                                    $ERORR[] = "تحقق من صحة البيانات";
                                    
                                }
                            }
                        } else{
                            // Username doesn't exist, display a generic error message
                            $ERORR[] = "تحقق من صحة البيانات";
                        }
                    } else{
                        $ERORR[]= "المعذرة، احيانا تحدث اخطاء ..الرجاء المحاولة مرة اخرى!";
                    }

                    // Close statement
                    unset($stmt);
                }
            }

            // Close connection
        //    unset($dbh);

        }


     }

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
  <link href="assets/css/style.css" rel="stylesheet">
</head>

<body dir="rtl">

  <main>
   <div class="container" style="font-family: 'Cairo';">
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
  
?>  
              <div class="d-flex justify-content-center py-4">
                <a href="login.php" class="logo d-flex align-items-center w-auto">
                  <span class="d-none d-lg-block" style="font-family: 'Cairo';"><?php echo htmlentities($CNAME);?> </span>
                    <span > <img src="<?php echo $DirassetsImage.htmlentities($ICON);?>" alt="<?php echo htmlentities($CNAME);?>"></span>
                </a>
              </div><!-- End Logo -->
<?php }} ?>
              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2" >
                    <h5 class="card-title text-center pb-0 fs-4" style="font-family: 'Cairo';"><?php echo $LANG->WORD49; ?> </h5>
                    <p class="text-center small">ادخل أسم المستخدم وكلمة المرور لتأكيد العضوية</p>
                  </div>
              <?php if(!empty($ERORR) || !empty($erorr)){ ?>


                   <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-octagon me-1"></i>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

                   <?php

                    foreach($ERORR as $errorAlert){
                        echo $errorAlert ."<br>";
                    }

                    echo $erorr;


                    ?>


                  </div>
                  <?php } ?>
                  <form class="row g-3 needs-validation" method="post" action="" >

                   <div class="col-12">
                      <label for="yourUsername" class="form-label">أسم المستخدم</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend"><i class="bi bi-person"></i></span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">المعذرة، يرجى ادخال بيانات اسم المستخدم</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">كلمة المرور</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">المعذرة، يرجى ادخال بيانات كلمة المرور </div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="true" id="rememberMe">
                        <label class="form-check-label" for="rememberMe">تذكيري بكلمة المرور</label>
                      </div>
                    </div>
                    <div class="col-12">
                      <button class="btn btn-primary w-100" type="submit" name="login">تسجيل الدخول</button>
                    </div>
                    <div class="col-12">
                      <p class="small mb-0">هل نسيت كلمة المرور ؟ <a href="Forget-Password.php">إعادة تعين كلمة المرور</a></p>
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
