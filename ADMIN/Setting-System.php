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
         
        if(isset($_POST['SubmitFormIcon']))
        {
             $target_dir=$DirassetsImage;
            
             // file logo
             $target_file= $target_dir . basename($_FILES["Image"]["name"]);
             $logofile=$_FILES["Image"]["name"];
             move_uploaded_file($_FILES["Image"]["tmp_name"], $target_file);
            //file icon
             $target_file= $target_dir . basename($_FILES["Icon"]["name"]);
             $iconfile=$_FILES["Icon"]["name"];
             move_uploaded_file($_FILES["Icon"]["tmp_name"], $target_file);
            
            if($logofile != '' ) {
                    $sql="UPDATE tblcompnydata SET logo='$logofile' WHERE id=1 ";
                     $query = $dbh->prepare($sql);
                     $query->execute();
                     if($query){
                        $msg="تم تحديث لوجو النظام بنجاح";  
                     }else{
                        $erorr="المعذرة، يرجى المحاولة مرة أخرى"; 
                     }
            }elseif($iconfile != '' ) {
                    $_SESSION['ICONSYSTEM']=$iconfile;
                    $sql="UPDATE tblcompnydata SET icon='$iconfile' WHERE id=1 ";
                     $query = $dbh->prepare($sql);
                     $query->execute();
                     if($query){
                        $msg="تم تحديث ايقونة النظام بنجاح";  
                      }else{
                        $erorr="المعذرة، يرجى المحاولة مرة أخرى"; 
                     }
            }else{
                $erorr="المعذرة، يرجى تحديد ملف  واعادة المحاولة مرة أخرى"; 

             }//end if checked fond Logo
           
         }//End If Submit Logo and Icons
        
        if(isset($_POST['SubmitFormOne']))
        {
       
            $PName=$_POST['Name'];    
            $PAddress=$_POST['Address'];   
            $PMAP=$_POST['MAP'];   
            $PMetaTitleHome=$_POST['MetaTitleHome'];   
            $PMetaKeywordHome=$_POST['MetaKeywordHome'];   
            $PMetaDescriptionHome=$_POST['MetaDescriptionHome'];   
            $PShortDescHero=$_POST['ShortDescHero']; 
            $PShortDesc=$_POST['ShortDesc']; 
            $Pabout=$_POST['about'];   
            $Pgoal=$_POST['goal'];   
            $PDomain=$_POST['Domain'];
            $Pphone1=$_POST['phone1'];
            $Pphone2=$_POST['phone2'];
            $PcommNum=$_POST['CommercialNumber'];
            $PEmail=$_POST['Email'];       
            $sql="UPDATE tblcompnydata SET Name=:Name,Address=:Address,map=:MAP,MetaTitleHome=:MetaTitleHome,MetaKeywordHome=:MetaKeywordHome,MetaDescriptionHome=:MetaDescriptionHome,ShortDescHero=:ShortDescHero,ShortDesc=:ShortDesc,about=:about,goal=:goal,Domain=:Domain,CommercialNumber=:CommercialNumber,phone1=:phone1,phone2=:phone2,Email=:Email WHERE id=1 ";
            $query = $dbh->prepare($sql);
            $query->bindParam(':Name',$PName,PDO::PARAM_STR);
            $query->bindParam(':Address',$PAddress,PDO::PARAM_STR);
            $query->bindParam(':MAP',$PMAP,PDO::PARAM_STR);
            $query->bindParam(':MetaTitleHome',$PMetaTitleHome,PDO::PARAM_STR);
            $query->bindParam(':MetaKeywordHome',$PMetaKeywordHome,PDO::PARAM_STR);
            $query->bindParam(':MetaDescriptionHome',$PMetaDescriptionHome,PDO::PARAM_STR);
            $query->bindParam(':ShortDescHero',$PShortDescHero,PDO::PARAM_STR);
            $query->bindParam(':ShortDesc',$PShortDesc,PDO::PARAM_STR);
            $query->bindParam(':about',$Pabout,PDO::PARAM_STR);
            $query->bindParam(':goal',$Pgoal,PDO::PARAM_STR);
            $query->bindParam(':Domain',$PDomain,PDO::PARAM_STR);
            $query->bindParam(':phone1',$Pphone1,PDO::PARAM_STR);
            $query->bindParam(':phone2',$Pphone2,PDO::PARAM_STR);
            $query->bindParam(':CommercialNumber',$PcommNum,PDO::PARAM_STR);
            $query->bindParam(':Email',$PEmail,PDO::PARAM_STR);
            $query->execute();
            if($query){
                
             $_SESSION['NAMESYSTEM']=$PName;
              $msg="تم تحديث بيانات النظام بنجاح";  
            }else{
                $erorr="المعذرة، يرجى المحاولة مرة أخرى"; 
            }
            
        }//end submit one
        
        
        if(isset($_POST['SubmitFormTow']))
        {
            
        
            $PFacebook=$_POST['Facebook'];     
            $PTwitter=$_POST['Twitter'];
            $PLinkedIn=$_POST['LinkedIn'];      
            $PPinterest=$_POST['Pinterest'];     
            $PYouTube=$_POST['YouTube'];
            $PInstagram=$_POST['Instagram'];     
            $PSnapchat=$_POST['Snapchat']; 
            $PWhatsApp=$_POST['WhatsApp']; 
            if(isset($_POST['Facebook'])){
            $sql="UPDATE `tblsocial` SET `social_url`='$PFacebook' WHERE  social_id=1";
            $query = $dbh->prepare($sql);
            $query->execute();
            }
            if(isset($_POST['Twitter'])){
            $sql="UPDATE `tblsocial` SET `social_url`='$PTwitter' WHERE  social_id=2";
            $query = $dbh->prepare($sql);
            $query->execute();
            }
            if(isset($_POST['LinkedIn'])){
            $sql="UPDATE `tblsocial` SET `social_url`='$PLinkedIn' WHERE  social_id=3";
            $query = $dbh->prepare($sql);
            $query->execute();
            }
            if(isset($_POST['Pinterest'])){
            $sql="UPDATE `tblsocial` SET `social_url`='$PPinterest' WHERE  social_id=5";
            $query = $dbh->prepare($sql);
            $query->execute();
            }
            if(isset($_POST['YouTube'])){
            $sql="UPDATE `tblsocial` SET `social_url`='$PYouTube' WHERE  social_id=6";
            $query = $dbh->prepare($sql);
            $query->execute();
            }
            if(isset($_POST['Instagram'])){
            $sql="UPDATE `tblsocial` SET `social_url`='$PInstagram' WHERE  social_id=7";
            $query = $dbh->prepare($sql);
            $query->execute();
            }
            if(isset($_POST['Snapchat'])){
            $sql="UPDATE `tblsocial` SET `social_url`='$PSnapchat' WHERE  social_id=8";
            $query = $dbh->prepare($sql);
            $query->execute();
            }
            if(isset($_POST['WhatsApp'])){
            $sql="UPDATE `tblsocial` SET `social_url`='$PWhatsApp' WHERE  social_id=9";
            $query = $dbh->prepare($sql);
            $query->execute();
            }
            if(isset($_POST['Tiktok'])){
            $sql="UPDATE `tblsocial` SET `social_url`='{$_POST['Tiktok']}' WHERE  social_id=13";
            $query = $dbh->prepare($sql);
            $query->execute();
            }
            if(isset($_POST['Pinterest'])){
            $sql="UPDATE `tblsocial` SET `social_url`='{$_POST['Pinterest']}' WHERE  social_id=14";
            $query = $dbh->prepare($sql);
            $query->execute();
            }
            
            if($query){
              $msg="تم تحديث بيانات المدرس بنجاح";  
            }else{
                $erorr="المعذرة، يرجى المحاولة مرة أخرى"; 
            }
            
        }//end submit Tow



?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="description">
  <meta content="" name="keywords">
  <title> <?php echo $CNAME." || "."    إدارة ضبط التطبيق  "; ?> </title>
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
    <div class="pagetitle">
      <h1><?php echo "ضبظ بيانات التطبيق ";?> </h1>
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
    <section class="section profile">
      <div class="row">
        <div class="col-xl-8" style="width:80%;">
          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered">
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-icon">ايقونات النظام</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">معلومات النظام الاساسية</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-Socil">حسابات التواصل الاجتماعي</button>
                </li>
                <li class="nav-item">
                  <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-link">الروابط والتنقلات</button>
                </li>
              </ul>
              <div class="tab-content pt-2">
                <div class="tab-pane fade show active pt-3" id="profile-icon">

                  <!-- Settings Form -->
                  <form method="post" action="" enctype="multipart/form-data">
<?php
$sql = "SELECT logo,icon FROM `tblcompnydata` limit 1;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>            
                    <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label"> عارض موقع النظام</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="<?php echo $DirassetsImage.htmlentities($result->logo);?>" alt="Profile" width="160" height="200">
                        <div class="pt-2">
                          <input class="form-control" type="file" id="formFile" name="Image" >
                        </div>
                      </div>
                    </div>
                     <div class="row mb-3">
                      <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">ايقونة النظام</label>
                      <div class="col-md-8 col-lg-9">
                        <img src="<?php echo $DirassetsImage.htmlentities($result->icon);?>" alt="Profile" width="160" height="200">
                        <div class="pt-2">
                          <input class="form-control" type="file" id="formFile" name="Icon" >
                        </div>
                      </div>
                    </div>
<?php }} ?>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="SubmitFormIcon">حفظ التحديث</button>
                    </div>
                  </form><!-- End settings Form -->
                </div><!--End profile-icon -->
                <div class="tab-pane fade  profile-edit pt-3" id="profile-edit">

                  <!-- Profile Edit Form -->
                  <form method="post" action="" enctype="multipart/form-data">
                      
<?php
$sql = "SELECT * FROM `tblcompnydata` limit 1;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>


                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">إسم النظام</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="Name" type="text" class="form-control" id="company" value="<?php echo htmlentities($result->Name);?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">  (الترويسة) نبذة مختصرة</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="ShortDescHero" type="text" class="form-control" id="company" value="<?php echo htmlentities($result->ShortDescHero);?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="company" class="col-md-4 col-lg-3 col-form-label">  (تحت الترويسة) نبذة مختصرة</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="ShortDesc" type="text" class="form-control" id="company" value="<?php echo htmlentities($result->ShortDesc);?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label  for="inputText" class="col-md-4 col-lg-3 col-form-label"> <?php echo "حول النظام "; ?></label>
                      <div class="col-md-8 col-lg-9" >
                          <textarea class="form-control" name="about" rows="15" >
                               <?php echo htmlentities($result->about); ?>
                          </textarea>
                      </div>
                    </div> 
                    <div class="row mb-3">
                      <label for="Job" class="col-md-4 col-lg-3 col-form-label">الاهداف</label>
                        <div class="col-md-8 col-lg-9">
                       <did class="textarea">
                       <textarea class="tinymce-editor" name="goal"  >
                        <?php echo htmlentities($result->goal);?>
                       </textarea>
                       </did>
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Address" class="col-md-4 col-lg-3 col-form-label">العنوان</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="Address" type="text" class="form-control" id="Address" value="<?php echo htmlentities($result->Address);?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">رقم الهاتف 1</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone1" type="text" class="form-control" id="Phone" value="<?php echo htmlentities($result->phone1);?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Phone" class="col-md-4 col-lg-3 col-form-label">رقم الهاتف آخر 2</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="phone2" type="text" class="form-control" id="Phone" value="<?php echo htmlentities($result->phone2);?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="CommercialNumber" class="col-md-4 col-lg-3 col-form-label">  رقم الغرفة التجارية </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="CommercialNumber" type="text" class="form-control" id="CommercialNumber" value="<?php echo htmlentities($result->CommercialNumber);?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">البريد الالكتروني</label>
                      <div class="col-md-8 col-lg-9">
                        <input name="Email" type="email" class="form-control" id="Email" value="<?php echo htmlentities($result->Email);?>">
                      </div>
                    </div>
                    <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label">عنوان الموقع الالكتروني </label>
                      <div class="col-md-8 col-lg-9">
                        <input name="Domain" type="text" class="form-control"  value="<?php echo htmlentities($result->Domain);?>">
                      </div>
                    </div>
                     <div class="row mb-3" >
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label"> <?php echo "رابط الموقع على الخارطة "; ?></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="MAP" type="text" class="form-control" style="height:150%;"   value="<?php echo htmlentities($result->map);?>">
                       </div>
                    </div><br>

                   <div class="row mb-3">
                      <label for="Email" class="col-md-4 col-lg-3 col-form-label"> <?php echo "Meta title (seo) "; ?></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="MetaTitleHome" type="text" class="form-control"  value="<?php echo htmlentities($result->MetaTitleHome);?>">
                       </div>
                    </div>
                    <div class="row mb-3">
                      <label for="inputText" class="col-md-4 col-lg-3 col-form-label"> <?php echo "Meta Keyword (seo) "; ?></label>
                      <div class="col-md-8 col-lg-9">
                          <textarea class="form-control" name="MetaKeywordHome" rows="5" >
                              <?php echo htmlentities($result->MetaKeywordHome);?> 
                          </textarea>
                      </div>
                    </div> 
                    <div class="row mb-3">
                      <label  for="inputText" class="col-md-4 col-lg-3 col-form-label"> <?php echo "Meta Description (seo) "; ?></label>
                      <div class="col-md-8 col-lg-9" >
                          <textarea class="form-control" name="MetaDescriptionHome" rows="5" >
                               <?php echo htmlentities($result->MetaDescriptionHome);?>
                          </textarea>
                      </div>
                    </div> 

<?php }} ?>
                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="SubmitFormOne">حظ التحديثات</button>
                    </div>
                  </form><!-- End Profile Edit Form -->
                </div><!--End profile-edit -->
                <div class="tab-pane fade pt-3" id="profile-Socil">

                  <!-- Settings Form -->
                  <form method="post" action="" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">حسابات التواصل الاجتماعي</label>
                      <div class="col-md-8 col-lg-9">
<?php
$sql = "SELECT social_name,social_url,social_icon FROM `tblsocial`;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>
             
                    <div class="row mb-3">
                      <label for="Whatsapp" class="col-md-4 col-lg-3 col-form-label"><?php echo htmlentities($result->social_name);?></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="<?php echo htmlentities($result->social_name);?>" type="text" class="form-control" id="" value="<?php echo htmlentities($result->social_url);?>">
                      </div>
                    </div>
            
<?php }} ?>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="SubmitFormTow">حفظ التحديث</button>
                    </div>
                  </form><!-- End settings Form -->

                </div><!--End profile-Socil -->
                <div class="tab-pane fade pt-3" id="profile-link">

                  <!-- Settings Form -->
                  <form method="post" action="" enctype="multipart/form-data">
                    <div class="row mb-3">
                      <label for="fullName" class="col-md-4 col-lg-3 col-form-label">إنشاء روابط وتنقلات</label>
                      <div class="col-md-8 col-lg-9">
<?php
$sql = "SELECT * FROM `tbllinks` ;";
$query = $dbh->prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{
foreach($results as $result)
{  ?>
             
                    <div class="row mb-3">
                      <label for="Whatsapp" class="col-md-4 col-lg-3 col-form-label"><?php echo htmlentities($result->LinkName);?></label>
                      <div class="col-md-8 col-lg-9">
                        <input name="<?php echo htmlentities($result->LinkName);?>" type="text" class="form-control" id="Link" value="<?php echo htmlentities($result->LinkUrl);?>">
                      </div>
                    </div>
            
<?php }}else{ ?>
                    <div class="row mb-3">
                      <div class="col-md-8 col-lg-9">
                      <h3>لا يوجد اي روابط</h3>
                      </div>
                    </div>
                          
<?php } ?>
                      </div>
                    </div>

                    <div class="text-center">
                      <button type="submit" class="btn btn-primary" name="#SubmitFormLinks">حفظ التحديث</button>
                    </div>
                  </form><!-- End settings Form -->

                </div><!--End profile-link -->
              </div><!-- End Bordered Tabs -->
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